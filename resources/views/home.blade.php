@auth

<p>{{ Auth::user()->name }}</p>
<img src="{{ Auth::user()->photo }}" />
<a href="{{ route('logout') }}">Logout</a>

@else
<a href="{{ route('login') }}">Login</a>
@endauth
