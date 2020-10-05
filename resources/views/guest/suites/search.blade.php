{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  {{-- inizio pagina ricerca --}}
  <div class="container">
    <div class="row col-12">
      {{-- l'input search deve contenere l'id address-input
      per renderlo disponibile a places.js
      i data-att sono contengono le informazioni sulla latitudine e longitudine--}}
      <input class="form-control" type="search" id="address-input" data-lat="" data-lng="{{old('searchbar')}}" placeholder="Where are we going?">
    </div>

    <div class="row">
      {{-- <div class="text-center"> --}}
        <div class="col-2">
          <input class="form-control" id="range" type="number" name="range" value="" placeholder="Distance in Km">
        </div>
        <div class="col-2">
          <input class="form-control" id="rooms" type="number" name="rooms" value="" placeholder="Rooms">
        </div>
        <div class="col-2">
          <input class="form-control" id="beds" type="number" name="beds" value="" placeholder="Beds">
        </div>
        <div class="col-2">
          <input class="form-control" id="baths" type="number" name="baths" value="" placeholder="Baths">
        </div>
        <div class="col-2">
          <input class="form-control" id="square_m" type="number" name="square_m" value="" placeholder="Square Meters">
        </div>
      {{-- </div> --}}
      <div class="col-2">
        {{-- <label>Price</label> --}}
        <select class="custom-select" id="price" name="price">
          <option value="0" selected="selected"> Price </option>
          <option value="30"> < 30€ </option>
          <option value="60"> < 60€ </option>
          <option value="90"> < 90€ </option>
          <option value="120"> < 120€ </option>
        </select>
      </div>
    </div>

    <div class="row form-check">
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
    </div>

    {{-- è consigliato non utilizzare il tag form
    per evitare che la pagina venga refreshata --}}
    {{-- <div class="search-wrapper">
    </div> --}}

    {{-- la classe del div serve ad identificare il punto di aggancio in cui riprodurre il template Handlebars
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <div class="row suites-cards">
    </div>

    {{-- l'id dello script serve ad identificare il template dalla funzione ajax in search.js
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <script id="suite-cards-template" type="text/x-handlebars-template">
      <div class="offset-2 col-3 entry d-flex flex-column">
        <div>
          <img src="@{{main_image}}" alt="@{{title}}">
        </div>
        <div class="body flex-grow-1">
          <h2>@{{title}}</h2>
          <h3>@{{address}}</h3>
          <h3>@{{price}}€</h3>
        </div>
      </div>
    </script>

  </div>
@endsection
