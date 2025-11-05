@extends('layouts.app')

@section('content')
<div class="container py-4 text-light">
  <h3 class="mb-4">✏️ Pizza módosítása</h3>

  <form action="{{ route('pizzak.update', $pizza->id) }}" method="POST" class="bg-dark p-4 rounded">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Név</label>
      <input type="text" name="nev" value="{{ $pizza->nev }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Kategória</label>
      <select name="kategoria_id" class="form-select" required>
        @foreach($kategoriak as $k)
          <option value="{{ $k->id }}" @if($pizza->kategoria_id == $k->id) selected @endif>
            {{ $k->nev }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Vegetáriánus?</label>
      <select name="vegetarianus" class="form-select" required>
        <option value="0" @if(!$pizza->vegetarianus) selected @endif>Nem</option>
        <option value="1" @if($pizza->vegetarianus) selected @endif>Igen</option>
      </select>
    </div>

    <button type="submit" class="btn btn-warning">Mentés</button>
    <a href="{{ route('pizzak.index') }}" class="btn btn-secondary">Mégse</a>
  </form>
</div>
@endsection
