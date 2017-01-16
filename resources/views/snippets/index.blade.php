@component('layout')
<div class="columns" id="content">
    <div class="column is-three-quarters-desktop is-full-tablet">
        @forelse ($snippets as $snippet)
            <div class="box">
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><a href="{{ url('snippets/'.$snippet->slug) }}">{{ $snippet->title }}</a></strong>
                                <br>
                                <small>{{ 'By : @'.$snippet->owner->slug.' - ' }}</small> <small>{{ $snippet->created_at->diffForHumans() }}</small>
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
        {{ $snippets->links() }}
    </div>
    <div class="column is-one-quarter-desktop is-full-tablet">
        <div class="tile is-parent" id="most-liked">
            <aside class="tile is-child notification is-success" id="sidebar">
                <div class="content">
                    <p class="title">Most Liked</p>
                    <div class="content">
                        @forelse($snippetsOrder as $snippets)
                            @foreach($snippets as $snippet)
                                <div class="box">
                                    <article class="media">
                                        <div class="media-content">
                                            <div class="content">
                                                <p>
                                                    <strong><a href="{{ url('snippets/'.$snippet->slug) }}" id="snippet-title">{{ $snippet->title }}</a></strong>
                                                    <br>
                                                    <small style="color:#4A4A4A;">{{ 'By : @'.$snippet->owner->slug }}</small>
                                                </p>
                                            </div>
                                            <nav class="level">
                                                <div class="level-left">
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
                            @endforeach
                        @empty
                            Nothing to be shown here
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endcomponent
