<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <title>Pizza Beadandó</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Emblema+One&family=Poppins:wght@400;600&display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Chefer libs -->
  <link href="{{ asset('chefer/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('chefer/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

  <!-- Chefer CSS -->
  <link href="{{ asset('chefer/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('chefer/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-dark text-secondary">

  {{-- Felső navigáció --}}
  <div class="container-fluid bg-dark px-0">
    <nav class="navbar navbar-expand-lg navbar-dark p-3 px-lg-5" style="background:#111111;">
      <a href="{{ url('/') }}" class="navbar-brand">
        <h1 class="m-0 display-6 text-primary text-uppercase">Chefer</h1>
      </a>

      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="navMain" class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Főoldal</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/adatbazis') }}">Adatbázis</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('diagram') }}">Diagram</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/kapcsolat') }}">Kapcsolat</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('pizzak.index') }}">CRUD</a></li>

          @auth

            {{-- Bejelentkezett felhasználó neve --}}
            <li class="nav-item">
              <span class="nav-link text-info">
                <i class="fa fa-user"></i> {{ optional(Auth::user())->name }}

              </span>
            </li>

            {{-- Jogosultság szerinti menük --}}
            @if(optional(Auth::user())->role_id >= 2)
              <li class="nav-item"><a class="nav-link" href="{{ url('/uzenetek') }}">Üzenetek</a></li>
            @endif

            @if(optional(Auth::user())->role_id === 3)
              <li class="nav-item">
                <a class="nav-link text-warning" href="{{ url('/admin') }}">
                  <i class="fa fa-crown"></i> Admin
                </a>
              </li>
            @endif

            {{-- Kijelentkezés --}}
            <li class="nav-item ms-lg-2">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Kijelentkezés</button>
              </form>
            </li>

          @else
            {{-- Ha nincs bejelentkezve --}}
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Belépés</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Regisztráció</a></li>
          @endauth
        </ul>
      </div>
    </nav>
  </div>

  {{-- Tartalom --}}
  <main>
    @yield('content')
  </main>

  {{-- Lábléc --}}
  <div class="container-fluid bg-dark text-secondary px-5 mt-5">
    <div class="text-center mt-4 py-4">
      &copy; {{ date('Y') }} Pizza Beadandó – Laravel + Chefer Horváth László Lindeisz Henrik
    </div>
  </div>

  <!-- JS könyvtárak -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('chefer/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('chefer/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('chefer/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('chefer/lib/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('chefer/lib/owlcarousel/owl.carousel.min.js') }}"></script>

  <!-- Chefer main -->
  <script src="{{ asset('chefer/js/main.js') }}"></script>
</body>

</html>