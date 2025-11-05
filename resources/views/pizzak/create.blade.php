@extends('layouts.app')

@section('content')
<div class="container py-4 text-light">
  <h3 class="mb-4">➕ Új pizza hozzáadása</h3>

  <form action="{{ route('pizzak.store') }}" method="POST" class="bg-dark p-4 rounded">
    @csrf

    <div class="mb-3">
      <label class="form-label">Név</label>
      <input type="text" name="nev" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Kategória</label>
      <select name="kategoria_id" class="form-select" required>
        <option value="">Válassz...</option>
        @foreach($kategoriak as $k)
          <option value="{{ $k->id }}">{{ $k->nev }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Vegetáriánus?</label>
      <select name="vegetarianus" class="form-select" required>
        <option value="0">Nem</option>
        <option value="1">Igen</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Mentés</button>
    <a href="{{ route('pizzak.index') }}" class="btn btn-secondary">Mégse</a>
  </form>
</div>
@endsection
