@php echo ""; @endphp


<!-- Spinner Start -->
<div id="spinner"
  class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
  <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
</div>
<!-- Spinner End -->

<!-- Header Start -->
<div class="container-fluid bg-dark px-0">
  <div class="row gx-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="col-lg-3 bg-primary d-none d-lg-block">
      <a href="{{ url('/') }}"
        class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
        <h1 class="m-0 display-4 text-white text-uppercase">Chefer</h1>
      </a>
    </div>
    <div class="col-lg-9">

      {{-- ⚡ Ezt az egész blokkot csak ADMIN láthatja --}}
      @auth
        @if(optional(Auth::user())->role_id === 3)
          <div class="row gx-0 d-none d-lg-flex bg-dark">
            <div class="col-6 px-5 text-start">
              <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                <i class="fa fa-envelope text-primary me-2"></i>
                <p class="mb-0">Ez az admin menü, mivel a feladat nem kérte nincs funkció hozzákapcsolva csak a <b
                    style="color: orange;">User lista</b> működik</p>
              </div>
            </div>
            <div class="col-6 px-5 text-end">
              <div class="h-100 d-inline-flex align-items-center py-2">
                <i class="fa fa-phone-alt text-primary me-2"></i>
                <p class="mb-0">+012 345 6789</p>
              </div>
            </div>
          </div>

          <nav class="navbar navbar-expand-lg navbar-dark p-3 p-lg-0 px-lg-5" style="background: #111111;">
            <a href="{{ url('/') }}" class="navbar-brand d-block d-lg-none">
              <h1 class="m-0 display-4 text-primary text-uppercase">Chefer</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
              <div class="navbar-nav mr-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Főoldal</a>
                <a href="{{ url('/admin') }}" class="nav-item nav-link">User lista</a>
                <a href="#" class="nav-item nav-link">Lekérdezések</a>
                <a href="#" class="nav-item nav-link">Statisztikák</a>
                <a href="#" class="nav-item nav-link">Site database</a>
                <a href="#" class="nav-item nav-link">Kapcsoaltok</a>
              </div>
            </div>
          </nav>
        @endif
      @endauth
      {{-- ⚡ VÉGE az admin-only résznek --}}
    </div>
  </div>
</div>
<!-- Header End -->


<!-- Hero Start -->
<div class="container-fluid p-5 mb-5 bg-dark text-secondary">
  <div class="row g-5 py-5">
    <div class="col-12">
      <h1 class="display-1 text-secondary text-center mb-0">Chefer Laravel</h1>
    </div>
    <div class="col-lg-4">
      <img class="img-fluid rounded mb-3" src="{{ asset('chefer/img/hero-2.jpg') }}">
    </div>
    <div class="col-lg-4">
      <img class="img-fluid rounded mb-3" src="{{ asset('chefer/img/hero-1.jpg') }}">
    </div>
    <div class="col-lg-4">
      <img class="img-fluid rounded mb-3" src="{{ asset('chefer/img/hero-3.jpg') }}">
    </div>
  </div>
</div>
<!-- Hero End -->

<!-- Company Intro Start -->
<div class="container my-5">
  <div class="card bg-dark border-primary shadow-lg">
    <div class="card-body text-light p-5">
      <h2 class="card-title text-primary mb-4 text-center">Üdvözlünk a Chefer Laravel Pizza Beadandó Étteremnél!</h2>

      <h4 class="text-warning mb-3">Minőség és szenvedély minden szeletben</h4>
      <p class="mb-4">
        A Chefer Laravel egy fiatal, lendületes csapat, amely hisz abban, hogy a pizza nemcsak étel, hanem élmény.
        Célunk, hogy minden szeletben érezd a minőséget, a friss alapanyagokat és a szenvedélyt, amivel készítjük.
        Kínálatunkban klasszikus olasz ízek és különleges, egyedi kombinációk is megtalálhatók – mindezt gyors
        kiszolgálással és szeretettel tálalva.
        Mert számunkra a pizza nem munka, hanem hivatás.
      </p>

      <h4 class="text-success mb-3">Kézműves pizzák, friss alapanyagokkal</h4>
      <p>
        Minden pizzánkat kézzel készítjük, válogatott alapanyagokból és eredeti olasz recept alapján.
        A tésztát naponta frissen gyúrjuk, a szósz házilag készül, a feltéteket pedig gondosan válogatjuk, hogy minden
        falatban érezd a különbséget.
      </p>
    </div>
  </div>
</div>
<!-- Company Intro End -->

<!-- Feature Example Section -->
<div class="container-fluid feature position-relative p-5 pb-0 mt-5">
  <div class="row g-5 gb-5">
    <div class="col-lg-4 col-md-6">
      <div class="feature-item rounded text-center p-5">
        <img class="img-fluid bg-white rounded-circle" src="{{ asset('chefer/img/feature-1.png') }}"
          style="width: 150px; height: 150px;">
        <h3 class="my-4">Best Chef</h3>
        <p class="text-light">Laravel + Bootstrap 5 integrált sablon</p>
        <p class="text-light">Reszponzív és teljesen működő elrendezés</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="feature-item rounded text-center p-5">
        <img class="img-fluid bg-white rounded-circle" src="{{ asset('chefer/img/feature-2.png') }}"
          style="width: 150px; height: 150px;">
        <h3 class="my-4">Modern Design</h3>
        <p class="text-light">Kapcsolat üzenet, bejelentkezve listázható</p>
        <p class="text-light">Adatbázis lekérdezések, diagram</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="feature-item rounded text-center p-5">
        <img class="img-fluid bg-white rounded-circle" src="{{ asset('chefer/img/feature-3.png') }}"
          style="width: 150px; height: 150px;">
        <h3 class="my-4">Pizzás CRUD</h3>
        <p class="text-light">Adatbázis, pizza tábla CRUD szerkeszthetősége</p>
        <p class="text-light">Autentikáció, admin menü</p>
      </div>
    </div>
  </div>
</div>
<!-- Feature End -->

<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary px-5 mt-5">
  <div class="row gx-5">
    <div class="col-lg-6">
      <h4 class="text-light mb-3">Kapcsolat</h4>
      <p><i class="fa fa-map-marker-alt text-primary me-2"></i> Szolnok, Magyarország</p>
      <p><i class="fa fa-phone-alt text-primary me-2"></i> +36 30 000 0000</p>
      <p><i class="fa fa-envelope text-primary me-2"></i> info@pizzabeadando.hu</p>
    </div>
    <div class="col-lg-6 text-end">
      <h4 class="text-light mb-3">Kövess minket</h4>
      <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="#"><i class="fab fa-facebook-f"></i></a>
      <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="#"><i class="fab fa-instagram"></i></a>
      <a class="btn btn-outline-secondary btn-square rounded-circle ms-2" href="#"><i class="fab fa-twitter"></i></a>
    </div>
  </div>
</div>
<!-- Footer End -->
{{-- EOF marker --}}