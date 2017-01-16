@component('layout')
    @forelse($snippets as $snippet)
        <div class="box">
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>{{ $snippet->title }}</strong> <small>{{ '@'.Auth::user()->slug.' - ' }}</small> <small>{{ $snippet->created_at->diffForHumans() }}</small>
                            <br>
                        <pre>
                        <code>{{ $snippet->body }}</code>
                    </pre>
                        </p>
                    </div>
                    <nav class="level">
                        <div class="level-left">
                            @if(Auth::id() === $snippet->owner->id)
                                <a class="level-item button is-warning" href="/snippets/{{ $snippet->slug }}/edit">
                                    <span class="icon is-small"><i class="fa fa-pencil"></i></span>
                                </a>
                            @endif
                            <a class="level-item button is-primary">
                                <span class="icon is-small"><i class="fa fa-share-alt"></i></span>
                            </a>
                            <a class="level-item button is-info" href="/snippets/{{ $snippet->slug }}/fork">
                                <span class="icon is-small"><i class="fa fa-code-fork"></i></span>
                            </a>
                            <like :snippet_id="{{ $snippet->id }}"></like>
                        </div>
                    </nav>
                </div>
            </article>
        </div>
    @empty
        <a href="/snippets/create" class="button is-large is-primary">Create Snippet</a>
    @endforelse
@endcomponent