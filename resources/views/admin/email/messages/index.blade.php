{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h2>Mail arrivate per i tuoi appartamenti:</h2>
  @foreach ($messages as $message)
    @php
      dd($message->suite->user_id);
    @endphp
    @if ($message->suite->user_id == $user->id)
      <table border="1" class="mt-3 m-1">
        <tr>
          <td>Nome</td>
          <td>Mail</td>
          <td>Messaggio</td>
        </tr>
        <tr>
          <td>{{$message->name ? $message->name : $message->email }}</td>
          <td>{{$message->email}}</td>
          <td>{{ $message->body }}</td>
        </tr>
      </table>
    @endif

  @endforeach
@endsection
