@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="text-center text-light mb-4">Beérkezett üzenetek</h2>

  @if($messages->isEmpty())
    <p class="text-center text-secondary">Még nincs üzenet az adatbázisban.</p>
  @else
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle">
        <thead class="table-primary text-center">
          <tr>
            <th>ID</th>
            <th>Név</th>
            <th>Email</th>
            <th>Üzenet</th>
            <th>Küldés ideje</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $msg)
            <tr>
              <td>{{ $msg->id }}</td>
              <td>{{ $msg->name }}</td>
              <td>{{ $msg->email }}</td>
              <td>{{ $msg->message }}</td>
              <td>{{ $msg->created_at->format('Y.m.d H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
