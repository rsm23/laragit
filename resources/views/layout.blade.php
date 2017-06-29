<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <title>{{ $title ?? env('APP_TITLE', 'LaraGit') }} - A handy snippets application with Laravel</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">

</head>

<body>
<div id="app">
    <nav class="nav">
        <div class="nav-left">
            <h1 class="title is-1">
                <a class="is-brand" href="{{ url('/') }}">
                    LaraGit
                </a>
            </h1>
        </div>

        <div class="nav-center">
            <a class="nav-item" href="https://github.com/rsm23/laragit">
            <span class="icon">
            <i class="fa fa-github"></i>
            </span>
            </a>
            <a class="nav-item" href="https://www.twitter.com/urtechshield">
            <span class="icon">
            <i class="fa fa-twitter"></i>
            </span>
            </a>
        </div>

        <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
    </span>

        <div class="nav-right nav-menu">
        <span class="nav-item">
        @if(Auth::guest())
                <a class="button is-primary" href="/login">
                <span class="icon">
                <i class="fa fa-sign-in"></i>
                </span>
                <span>Login</span>
            </a>
                <a class="button is-info" href="#" data-target="#modal" data-route="{{ Route::currentRouteName() }}"
                   id="register">
                <span class="icon">
                <i class="fa fa-user-o"></i>
                </span>
                <span>Resgiter</span>
            </a>
            @else
                <a class="button" href="{{ url('/snippets')  }}">
                <span class="icon">
                <i class="fa fa-home"></i>
                </span>
                <span>My Snippets</span>
            </a>
                <a class="button is-white">{{ Auth::user()->name }}</a>
                <a class="button is-danger" href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                <span class="icon">
                <i class="fa fa-sign-out"></i>
                </span>
            </a>
            @endif
    </span>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </nav>
    <section class="hero is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    <a href="/">LaraGit</a>
                </h1>

                <h2 class="subtitle">
                    Laragit is a takeoff of Laracasts's Create a Snippets Application screencasts, with many
                    improvements and additional features bult with Laravel and VueJS
                </h2>

                <p>
                    <a href="/snippets/create" class="button is-primary is-large">Create Snippet</a>
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            {{ $slot }}
        </div>
    </section>
    @if (Route::currentRouteName() != 'register')
        <div class="modal {{ $errors->has('password')||$errors->has('email')||$errors->has('name') ? ' is-active' : '' }}"
             id="modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    @include('partials.registerForm')
                </div>
            </div>
            <button class="modal-close"></button>
        </div>
    @endif
</div>
<script src="/js/app.js"></script>
<script src="/js/libs.js"></script>
<script src="/js/hljs.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
@if(Auth::guest())
    <script>
        $('#register').click(function (e) {
            e.preventDefault();
            var target = $(this).data('target');
            var route = $(this).data('route');

            if (route != 'register') {
                $('html').addClass('is-clipped');
            }
            $(target).addClass('is-active');
        });
        $('.modal-background, .modal-close').click(function () {
            $('html').removeClass('is-clipped');
            $(this).parent().removeClass('is-active');
        });
    </script>
@endif

@if (isset($footer))
    {{ $footer }}
@endif
</body>
</html>