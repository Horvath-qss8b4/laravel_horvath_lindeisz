@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="text-center text-light mb-4">Kapcsolatfelvétel</h2>

  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  <div class="card bg-dark text-light p-4 shadow">
    <form method="POST" action="{{ route('kapcsolat.store') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Név</label>
        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
      </div>
      <div class="mb-3">
        <label class="form-label">Üzenet</label>
        <textarea name="uzenet" rows="4" class="form-control @error('uzenet') is-invalid @enderror" placeholder="Írd ide az üzenetedet..." required></textarea>
        @error('uzenet')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary px-4">Küldés</button>
      </div>
    </form>
  </div>
</div>
@endsection
