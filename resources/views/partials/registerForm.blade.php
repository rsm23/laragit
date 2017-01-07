<form role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    {{--//Name Field--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label">Name</label>
        </div>
        <div class="control is-grouped">
            <p class="control is-expanded{{ $errors->has('name') ? ' has-icon has-icon-right' : '' }}">
                <input class="input{{ $errors->has('name') ? ' is-danger' : '' }} is-large" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <i class="fa fa-warning"></i>
                    <span class="help is-danger">{{ $errors->first('name') }}</span>
                @endif
            </p>
        </div>
    </div>

    {{--//Email Field--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label">Email</label>
        </div>
        <div class="control is-grouped">
            <p class="control is-expanded{{ $errors->has('email') ? ' has-icon has-icon-right' : '' }}">
                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }} is-large" type="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <i class="fa fa-warning"></i>
                    <span class="help is-danger">{{ $errors->first('email') }}</span>
                @endif
            </p>
        </div>
    </div>

    {{--//Password Fields--}}
    <div class="control is-horizontal">
        <div class="control-label">
            <label class="label">Password</label>
        </div>
        <div class="control is-grouped">
            <p class="control is-expanded{{ $errors->has('password') ? ' has-icon has-icon-right' : '' }}">
                <input class="input{{ $errors->has('password') ? ' is-danger' : '' }} is-large" type="password" placeholder="Password" name="password" required>
                @if ($errors->has('password'))
                    <i class="fa fa-warning"></i>
                    <span class="help is-danger">{{ $errors->first('password') }}</span>
                @endif
            </p>
            <p class="control is-expanded{{ $errors->has('password') ? ' has-icon has-icon-right' : '' }}">
                <input class="input{{ $errors->has('password') ? ' is-danger' : '' }} is-large" type="password" placeholder="Repeat password" name="password_confirmation" required>
                @if ($errors->has('password'))
                    <i class="fa fa-warning"></i>
                    <span class="help is-danger">{{ $errors->first('password') }}</span>
                @endif
            </p>
        </div>
    </div>

    {{--//Submit Button--}}
    <p class="control has-text-centered">
        <button class="button is-large is-primary" type="submit">Submit</button>
    </p>
</form>