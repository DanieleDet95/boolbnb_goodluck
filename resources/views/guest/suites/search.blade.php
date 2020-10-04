{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Pagina ricerca</h1>


  <div class="main-content">

    {{-- è consigliato non utilizzare il tag form
    per evitare che la pagina venga refreshata --}}
    <div class="search-wrapper">
      {{-- l'input search deve contenere l'id address-input
      per renderlo disponibile a places.js
      i data-att sono contengono le informazioni sulla latitudine e longitudine--}}
      <input type="search" id="address-input" data-lat="" data-lng="{{old('searchbar')}}" placeholder="Where are we going?" />

      <input id="range" type="number" name="range" value="" placeholder="Range in Km">
      <input  id="rooms" type="number" name="rooms" value="" placeholder="Stanze">
      <input  id="beds" type="number" name="beds" value="" placeholder="Letti">
      <input  id="baths" type="number" name="baths" value="" placeholder="Bagni">
      <input  id="square_m" type="number" name="square_m" value="" placeholder="Metri quadri">

      <label>Prezzo</label>
      <select id="price" name="price">
        <option value="0" selected="selected"> --- </option>
        <option value="30"> < 30€ </option>
        <option value="60"> < 60€ </option>
        <option value="90"> < 90€ </option>
        <option value="120"> < 120€ </option>
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
    </div>

    {{-- la classe del div serve ad identificare il punto di aggancio in cui riprodurre il template Handlebars
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <div class="suites-cards">

    </div>

    {{-- l'id dello script serve ad identificare il template dalla funzione ajax in search.js
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <script id="suite-cards-template" type="text/x-handlebars-template">
      <div class="entry">
        <img src="@{{main_image}}" alt="@{{title}}">
        <div class="body">
          <h1>@{{title}}</h1>
          <h1>@{{address}}</h1>
          <h1>@{{price}}€</h1>
        </div>
      </div>
    </script>

  </div>

@endsection
