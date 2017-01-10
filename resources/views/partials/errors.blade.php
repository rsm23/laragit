@if (count($errors) > 0)
    <div class="notification is-danger">
        <a href="#" class="delete"></a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif