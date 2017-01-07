<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <title>Snippets</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">

</head>

<body>
<div id="app">
<nav class="nav">
    <div class="nav-left">
        <h1 class="title is-1">
            <a class="nav-item is-brand" href="{{ url('/') }}">
                GitBits
            </a>
        </h1>
    </div>

    <div class="nav-center">
        <a class="nav-item" href="#">
            <span class="icon">
            <i class="fa fa-github"></i>
            </span>
        </a>
        <a class="nav-item" href="#">
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
            <a class="button is-info" href="#" data-target="#modal" data-route="{{ Route::currentRouteName() }}" id="register">
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
                <a href="/">Snippets</a>
            </h1>

            <h2 class="subtitle">
                A tutorial from the friendly folk at Laracasts.com.
            </h2>

            <p>
                <a href="/snippets/create" class="button">Create Snippet</a>
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
    <div class="modal {{ $errors->has('password')||$errors->has('email')||$errors->has('name') ? ' is-active' : '' }}" id="modal">
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
<script>
    $('#register').click(function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        var route = $(this).data('route');

        if (route != 'register')
        {
            $('html').addClass('is-clipped');
        }
        $(target).addClass('is-active');
    });
    $('.modal-background, .modal-close').click(function() {
        $('html').removeClass('is-clipped');
        $(this).parent().removeClass('is-active');
    });

    hljs.initHighlightingOnLoad();
</script>

@if (isset($footer))
    {{ $footer }}
@endif
</body>
</html>