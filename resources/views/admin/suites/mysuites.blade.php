{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Le mie suites</h1>
  {{-- Cicliamo le suites del database per stampare le suite create dall'utente loggato --}}
  @if (is_array($my_suites))
    <h4>Questi sono i tuoi appartamenti</h4>
    @foreach ($my_suites as $my_suite)
      <ul>
        <li>
          <a href="{{route('suites.show', $my_suite)}}">{{$my_suite['title']}}</a>
        </li>
      </ul>
    @endforeach
    <div>
      <a href="{{ route("suites.index")}}"> Torna a Index</a>
    </div>
  @else
    <h4>Non hai appartamenti registrati</h4>
  @endif
@endsection
