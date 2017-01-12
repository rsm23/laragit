<?php

namespace App\Http\Controllers;
use App\Traits\CaptchaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Snippet;
use App\SnippetLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SnippetsController extends Controller
{
    use CaptchaTrait;

    /**
     * List all of the snippets.
     *
     * @return \Response
     */
    public function index()
    {
        $snippets = Snippet::latest()->with('owner')->paginate(10);
        $likes = SnippetLike::select('snippet_id')->orderBy(DB::raw('count(snippet_id)'), 'DESC')->groupBy('snippet_id')->limit(6)->get();

        $ids = $likes->pluck('snippet_id')->toArray();
        $snippetsOrder = collect();
        foreach ($ids as $id) {
            $snippetsOrder->push(Snippet::where('id', $id)->get());
        }
        return view('snippets.index', compact('snippets', 'snippetsOrder'));
    }

    /**
     * Display All snippets of a particular user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        $snippets = Auth::user()->snippets;

        return view('snippets.user', compact('snippets'));
    }

    /**
     * Show a page to create a new snippet.
     *
     * @param Snippet $snippet
     * @return \Response
     */
    public function create(Snippet $snippet)
    {
        return view('snippets.create', compact('snippet'));
    }

    /**
     * Show a single snippet.
     *
     * @param Snippet $snippet
     * @return \Illuminate\View\View
     */
    public function show(Snippet $snippet)
    {
        return view('snippets.show', compact('snippet'));
    }

    /**
     * Store a new snippet in the database.
     * @param Request $request
     * @return \RedirectResponse
     */
    public function store(Request $request)
    {
        $request['recqptcha'] = $this->captchaCheck();
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'g-recaptcha-response'  => 'required'
        ]);

        $userId = Auth::check() ? Auth::id() : null;

        $slug = Snippet::where('slug', str_slug(request('title')))->exists() ? str_slug(request('title') . str_random(4)) : str_slug(request('title'));

        Snippet::create([
            'user_id' => $userId,
            'title' => request('title'),
            'slug' => $slug,
            'body' => request('body'),
            'forked_slug' => request('forked_slug')
        ]);

        return redirect()->home();
    }

    /**
     * Check if the current user has already liked the snippet
     * @param $id
     * @return array
     */
    public function check($id)
    {
        if (!Auth::check())
        {
            return ['status' => 'Anonymous'];
        }
        $snippet = Snippet::where('id', $id)->first();
        if (SnippetLike::whereUserId(Auth::id())->whereSnippetId($snippet->id)->exists()){
            return ['status' => 'Liked'];
        }
        return ['status' => 'notLiked'];
    }

    /**
     * Get the count of likes for a specific snippet
     * @param $id
     * @return array
     */
    public function likesCount($id)
    {
        $snippet = SnippetLike::whereSnippetId($id)->get();

        return ['likes' => count($snippet)];
    }

    /**
     * Perform the like action if not already liked
     * or unlike if already liked
     * @param $snippet
     * @return array
     */
    public function like($snippet)
    {
        $existing_like = SnippetLike::whereSnippetId($snippet)->whereUserId(Auth::id())->first();

        if (Auth::check())
        {
            $id = Auth::id();
        }
        else
        {
            return ['status' => 'Anonymous'];
        }
        if (is_null($existing_like)) {
            SnippetLike::create([
                'snippet_id' => $snippet,
                'user_id' => $id
            ]);

            return ['status' => 'Liked'];
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                return ['status' => 'notLiked'];
            } else {
                $existing_like->restore();
                return ['status' => 'Liked'];
            }
        }
    }
}
