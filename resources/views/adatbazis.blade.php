@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2 class="text-center text-light mb-5">🍕 Adatbázis tartalom (3 tábla – ORM)</h2>

  {{-- KATEGÓRIÁK --}}
  <div class="card bg-dark border-0 shadow-lg mb-5">
    <div class="card-header bg-primary text-white fw-bold fs-5">
      <i class="bi bi-tags"></i> Kategóriák -> 2007.01.19 napi adatok
    </div>
    <div class="table-responsive">
      <table class="table table-dark table-hover align-middle mb-0">
        <thead class="table-primary text-dark">
          <tr>
            <th>Név</th>
            <th class="text-end">Ár (Ft)</th>
            <th class="text-end">Pizzák száma</th>
          </tr>
        </thead>
        <tbody>
          @foreach($kategoriak as $k)
            <tr>
              <td class="fw-semibold">{{ $k->nev }}</td>
              <td class="text-end">{{ number_format($k->ar, 0, ',', ' ') }}</td>
              <td class="text-end">{{ $k->pizzak_count }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- PIZZÁK --}}
  <div class="card bg-dark border-0 shadow-lg mb-5">
    <div class="card-header bg-success text-white fw-bold fs-5">
      <i class="bi bi-pizza"></i> Pizzák (15 minta)
    </div>
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle mb-0">
        <thead class="table-success text-dark">
          <tr>
            <th>Név</th>
            <th>Kategória</th>
            <th class="text-center">Vegetáriánus</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pizzak as $p)
            <tr>
              <td>{{ $p->nev }}</td>
              <td>{{ $p->kategoria->nev ?? '-' }}</td>
              <td class="text-center">
                @if($p->vegetarianus)
                  <span class="badge bg-success">Igen</span>
                @else
                  <span class="badge bg-danger">Nem</span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- RENDELÉSEK --}}
  <div class="card bg-dark border-0 shadow-lg mb-5">
    <div class="card-header bg-warning text-dark fw-bold fs-5">
      <i class="bi bi-cart-check"></i> Legutóbbi 15 rendelés
    </div>
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle mb-0">
        <thead class="table-warning text-dark">
          <tr>
            <th>Dátum</th>
            <th>Pizza</th>
            <th class="text-end">Mennyiség</th>
            <th>Felhasználó</th>
          </tr>
        </thead>
        <tbody>
          @foreach($rendelesek as $r)
            <tr>
              <td>{{ \Carbon\Carbon::parse($r->datum)->format('Y.m.d H:i') }}</td>
              <td>{{ $r->pizza->nev ?? '-' }}</td>
              <td class="text-end">{{ $r->mennyiseg }}</td>
              <td>{{ $r->user->name ?? '-' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Kis stílus finomhangolás --}}
<style>
  .card { border-radius: 1rem; }
  table tbody tr:hover { background-color: rgba(255,255,255,0.05) !important; }
</style>
@endsection
