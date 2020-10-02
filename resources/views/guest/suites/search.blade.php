{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Pagina ricerca</h1>

  {{-- è consigliato non utilizzare il tag form
  per evitare che la pagina venga refreshata --}}
  <div class="main-content">

      {{-- l'input search deve contenere l'id address-input
      per renderlo disponibile a places.js --}}
    {{-- <form action="{{route('api.search')}}" method="get"> --}}


      <input type="search" id="address-input" placeholder="Where are we going?" />

      {{-- gli input latitude & longitude non devono risultare visibili/modificabili --}}
      <input id="latitude" type="text" name="latitude" value="" placeholder="Latitudine">
      <input id="longitude" type="text" name="longitude" value="" placeholder="Longitudine">

      <input  type="number" name="rooms" value="" placeholder="Stanze">
      <input  type="number" name="beds" value="" placeholder="Letti">
      <input  type="number" name="baths" value="" placeholder="Bagni">
      <input  type="number" name="square_m" value="" placeholder="Metri quadri">

      <label>Prezzo</label>
      <select name="price">
        <option value=""> <30 </option>
        <option value=""> <60 </option>
        <option value=""> <90 </option>
        <option value=""> <120 </option>
      </select>




      <label>Piscina</label>
      <input id="pool" type="checkbox" name="pool" value="false">
      <label>wifi</label>
      <input id="wifi" type="checkbox" name="wifi" value="false">
      <label>Animali</label>
      <input id="pet" type="checkbox" name="pet" value="false">
      <label>Parcheggio</label>
      <input id="parking" type="checkbox" name="parking" value="false">
      <label>Pianoforte</label>
      <input id="piano" type="checkbox" name="piano" value="false">
      <label>Sauna</label>
      <input id="sauna" type="checkbox" name="sauna" value="false">


      {{-- non è importante il tipo di tag scelto ma deve contenere l'id #submit --}}
      <input id="submit" type="submit" value="Ricerca">
    {{-- </form> --}}
  </div>

@endsection
