{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Le mie suites</h1>
  {{-- Cicliamo le suites del database per stampare le suite create dall'utente loggato --}}
  @if (is_array($my_suites))
    <h4>Questi sono i tuoi appartamenti</h4>
    <table border="1" class="text-center">
      <tr>
        <th>Copertina</th>
        <th>Titolo</th>
        <th>Indirizzo</th>
        <th>Prezzo</th>
      </tr>
    @foreach ($my_suites as $my_suite)
      <tr>
        <td>
          @if (strpos($my_suite->main_image, 'lorempixel') == false)
         <img src="{{asset('storage').'/'.$my_suite->main_image}}" alt="{{$my_suite->title}}">
         @else
         <img src="{{ $my_suite->main_image }}" alt="{{ $my_suite->title }}">
        @endif
        </td>
        <td><a href="{{route('suites.show', $my_suite)}}">{{$my_suite->title}}</a></td>
        <td>{{$my_suite->address}}</td>
        <td>{{$my_suite->price}}</td>
      </tr>
    @endforeach
    </table>
    <div>
      <a href="{{ route("suites.index")}}"> Torna a Index</a>
    </div>
  @else
    <h4>Non hai appartamenti registrati</h4>
  @endif
@endsection
