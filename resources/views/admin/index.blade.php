@extends('layouts.app')

@section('content')
<div class="container text-light py-5">
  <h2 class="mb-4 text-center">👑 Admin felület – Felhasználók listája</h2>

  <table class="table table-dark table-striped table-bordered align-middle">
    <thead class="table-primary text-dark">
      <tr>
        <th>ID</th>
        <th>Név</th>
        <th>Email</th>
        <th>Szerepkör</th>
        <th>Regisztrált</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $u)
        <tr>
          <td>{{ $u->id }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->role->name ?? '–' }}</td>
          <td>{{ $u->created_at->format('Y.m.d H:i') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
