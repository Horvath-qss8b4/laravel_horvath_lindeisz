@auth
    @if(optional(Auth::user())->role_id >= 3)
        <li><a href="#">Admin</a></li>
    @endif

    @if(optional(Auth::user())->role_id >= 2)
        <li><a href="#">Üzenetek</a></li>
    @endif

    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-link text-white">Kijelentkezés</button>
        </form>
    </li>
@else
    <li><a href="{{ route('login') }}">Belépés</a></li>
    <li><a href="{{ route('register') }}">Regisztráció</a></li>
@endauth