@component('layout')
<div class="box">
    <article class="media">
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ $snippet->title }}</strong> <small>{{ '@'.$snippet->owner->slug.' - ' }}</small> <small>{{ $snippet->created_at->diffForHumans() }}</small>
                    <br>
                <pre>
                        <code>{{ $snippet->body }}</code>
                    </pre>
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

    <p>
        <a href="/">Back</a>
    </p>

    @if ($snippet->isAFork())
        <hr>
        
        <h3 class="title is-3">
            Forked From
            <a href="/snippets/{{ $snippet->originalSnippet->slug }}">
                {{ $snippet->originalSnippet->title }}
            </a>
        </h3>
    @endif

    @if ($snippet->forks->count())
        <hr>

        <h3 class="title is-3">Forks</h3>

        <ul>
            @foreach ($snippet->forks as $fork)
                <li>
                    <a href="/snippets/{{ $fork->slug }}">
                        {{ $fork->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endcomponent