@extends('layouts.app')

@section('content')
<div class="container-fluid p-5 mb-5 bg-dark text-secondary">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="bg-dark p-4 rounded border border-secondary">
        <h2 class="text-light mb-4">Bejelentkezés</h2>
        <form method="POST" action="{{ url('/login') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label text-secondary">Email</label>
            <input type="email" name="email" class="form-control bg-dark text-light border-secondary" required>
            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
          </div>
          <div class="mb-4">
            <label class="form-label text-secondary">Jelszó</label>
            <input type="password" name="password" class="form-control bg-dark text-light border-secondary" required>
            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
          </div>
          <button class="btn btn-primary px-4">Belépés</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
