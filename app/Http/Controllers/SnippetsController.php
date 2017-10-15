<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Snippet;
use App\SnippetLike;
use App\Traits\CaptchaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SnippetsController extends Controller {
	use CaptchaTrait;

	/**
	 * List all of the snippets.
	 *
	 * @return \Response
	 */
	public function index() {
		$snippets = Snippet::latest()->with( 'owner' )->paginate( 10 );
		$likes    = SnippetLike::mostLiked()->limit( 6 )->get();

		$ids           = $likes->pluck( 'snippet_id' )->toArray();
		$snippetsOrder = collect();
		foreach ( $ids as $id ) {
			$snippetsOrder->push( collect($snippets->where( 'id', $id)) );
		}

		return view( 'snippets.index', compact( 'snippets', 'snippetsOrder' ) );
	}

	/**
	 * Display All snippets of a particular user.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function user() {
		$snippets = Auth::user()->snippets;

		return view( 'snippets.user', compact( 'snippets' ) );
	}

	/**
	 * Show a page to create a new snippet.
	 *
	 * @param Snippet $snippet
	 *
	 * @return \Response
	 */
	public function create( Snippet $snippet ) {
		$channels = Channel::all();

		return view( 'snippets.create', [ 'snippet' => $snippet, 'channels' => $channels ] );
	}

	/**
	 * Show a single snippet.
	 *
	 * @param Snippet $snippet
	 *
	 * @return \Illuminate\View\View
	 */
	public function show( Snippet $snippet ) {
		return view( 'snippets.show', compact( 'snippet' ) );
	}

	/**
	 * Store a new snippet in the database.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store( Request $request ) {
		$request['recqptcha'] = $this->captchaCheck();
		$this->validate( request(), [
			'title'                => 'required',
			'body'                 => 'required',
			'channel'              => 'required|exists:channels,id',
			'g-recaptcha-response' => 'required',
		] );

		$userId = Auth::check() ? Auth::id() : null;

		$title       = request( 'title' );
		$slug_exists = Snippet::where( 'slug', str_slug( $title ) )->exists();
		$slug        = $slug_exists ? str_slug( $title . str_random( 4 ) ) : str_slug( $title );
		Snippet::create( [
			'user_id'     => $userId,
			'title'       => $title,
			'slug'        => $slug,
			'body'        => request( 'body' ),
			'channel_id'  => request( 'channel' ),
			'forked_slug' => request( 'forked_slug' ),
		] );

		return redirect()->home();
	}

	/**
	 * Edit a single Snippet.
	 *
	 * @param Snippet $snippet
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit( Snippet $snippet ) {
		$channels = Channel::all();

		return view( 'snippets.edit', [ 'snippet' => $snippet, 'channels' => $channels ] );
	}

	public function update( Request $request, $slug ) {
		$snippet = Snippet::findOrFail( $slug );

		$this->validate( $request, [
			'title'                => 'required',
			'body'                 => 'required',
			'channel'              => 'required|exists:channels,id',
			'g-recaptcha-response' => 'required',
		] );

		$snippet->fill( [
			'title'      => $request->title,
			'body'       => $request->body,
			'channel_id' => $request->channel,
		] )->save();

		return redirect()->back();
	}

	/**
	 * Check if the current user has already liked the snippet.
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public function check( $id ) {
		if ( ! Auth::check() ) {
			return [ 'status' => 'Anonymous' ];
		}
		$snippet = Snippet::where( 'id', $id )->first();
		if ( SnippetLike::whereUserId( Auth::id() )->whereSnippetId( $snippet->id )->exists() ) {
			return [ 'status' => 'Liked' ];
		}

		return [ 'status' => 'notLiked' ];
	}

	/**
	 * Get the count of likes for a specific snippet.
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public function likesCount( $id ) {
		$snippet = SnippetLike::whereSnippetId( $id )->get();

		return [ 'likes' => count( $snippet ) ];
	}

	/**
	 * Perform the like action if not already liked
	 * or unlike if already liked.
	 *
	 * @param $snippet
	 *
	 * @return array
	 */
	public function like( $snippet ) {
		$existing_like = SnippetLike::whereSnippetId( $snippet )->whereUserId( Auth::id() )->first();

		if ( !Auth::check() ) {
            return [ 'status' => 'Anonymous' ];
		}
        $id = Auth::id();

		if ( is_null( $existing_like ) ) {
			SnippetLike::create( [
				'snippet_id' => $snippet,
				'user_id'    => $id,
			] );

			return [ 'status' => 'Liked' ];
		} elseif ( is_null( $existing_like->deleted_at ) ) {
            $existing_like->delete();

            return [ 'status' => 'notLiked' ];
        } else {
            $existing_like->restore();

            return [ 'status' => 'Liked' ];
        }
	}
}
