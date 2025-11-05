@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="text-light mb-4 text-center">🍕 Pizzák kezelése (CRUD)</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="text-end mb-3">
    <a href="{{ route('pizzak.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Új pizza
    </a>
  </div>

  <table class="table table-dark table-striped align-middle">
    <thead class="table-primary text-dark">
      <tr>
        <th>ID</th><th>Név</th><th>Kategória</th><th>Vega</th><th>Művelet</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pizzak as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->nev }}</td>
          <td>{{ $p->kategoria->nev ?? '-' }}</td>
          <td>{{ $p->vegetarianus ? 'Igen' : 'Nem' }}</td>
          <td>
            <a href="{{ route('pizzak.edit', $p->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
            <form action="{{ route('pizzak.destroy', $p->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Biztosan törlöd?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-5 d-flex flex-column align-items-center">
  {{-- Laravel pagination (egyetlen példány) --}}
  <div class="pagination-wrapper mt-3">
    {{ $pizzak->onEachSide(1)->links('pagination::bootstrap-5') }}
  </div>

  {{-- Saját info alá --}}
  @if ($pizzak->hasPages())
    <div class="text-secondary small mt-2">
      Showing {{ $pizzak->firstItem() }} to {{ $pizzak->lastItem() }} of {{ $pizzak->total() }} results
    </div>
  @endif
</div>

<style>
  /* ===== Laravel pagination finomított stílus ===== */

  /* fölösleges részek tiltása */
  nav[role="navigation"] > div:first-child,
  nav[role="navigation"] > svg,
  nav[role="navigation"] svg,
  nav[role="navigation"] p.small.text-muted,
  div[role="status"] p.small.text-muted,
  div.flex.justify-content-between.align-items-center p.small.text-muted,
  p.small.text-muted {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 0 !important;
  }

  /* paginator-gombok megjelenése */
  .pagination {
    margin: 0;
    gap: 4px;
  }
  .pagination .page-link {
    background-color: #111;
    color: #f8f9fa;
    border: 1px solid #444;
  }
  .pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
  }
  .pagination .page-link:hover {
    background-color: #333;
  }
</style>

</div>
@endsection
