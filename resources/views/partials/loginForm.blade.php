<form role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    {{--//Email Field--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label">Email</label>
        </div>
        <div class="control is-grouped">
            <p class="control is-expanded{{ $errors->has('email') ? ' has-icon has-icon-right' : '' }}">
                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }} is-large" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <i class="fa fa-warning"></i>
                    <span class="help is-danger">{{ $errors->first('email') }}</span>
                @endif
            </p>
        </div>
    </div>

    {{--//Password Field--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label">Password</label>
        </div>
        <div class="control is-grouped">
            <p class="control is-expanded{{ $errors->has('password') ? ' has-icon has-icon-right' : '' }}">
                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }} is-large" type="password" name="password" value="{{ old('password') }}" required>
                @if ($errors->has('password'))
                    <i class="fa fa-warning"></i>
                    <span class="help is-danger">{{ $errors->first('password') }}</span>
                @endif
            </p>
        </div>
    </div>

    {{--//Remember Me Field--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label">Remember Me</label>
        </div>
        <p class="control">
            <label class="checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
            </label>
        </p>
    </div>


    {{--//Submit Button, and Reset Password link--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label"></label>
        </div>
        <div class="control is-grouped">
            <p class="control has-text-centered">
                <button class="button is-large is-primary" type="submit">Submit</button>
            </p>
            <p class="control is-flex">
                <a href="{{ url('/password/reset') }}" class="flex">
                    Forgot Your Password?
                </a>
            </p>
        </div>
    </div>
</form>