{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
<<<<<<< HEAD
  {{-- inizio pagina ricerca --}}
  <div class="container-fluid container-md">
    <div class="row flex-column col-12">
=======

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

  <h1>Pagina ricerca</h1>
>>>>>>> master

      <div class="search_location col-12 mt-5 mb-3">
        <input class="col-12 form-control rounded-0" type="search" id="address-input" data-lat="" data-lng="{{old('searchbar')}}" placeholder="Where are we going?">
      </div>

      <div class="d-flex flex-column align-items-center align-items-lg-center justify-content-lg-around flex-lg-row col-12 my-3">
        <div class="input_box col-4 col-12-sm flex-fill mb-2">
          <input class="form-control rounded-0" id="range" type="number" name="range" value="" placeholder="Distance in Km">
        </div>
        <div class="input_box col-4 col-12-sm flex-fill my-2">
          <input class="form-control rounded-0" id="rooms" type="number" name="rooms" value="" placeholder="Rooms">
        </div>
        <div class="input_box col-4 col-12-sm flex-fill my-2">
          <input class="form-control rounded-0" id="beds" type="number" name="beds" value="" placeholder="Beds">
        </div>
        <div class="input_box col-4 col-12-sm flex-fill my-2">
          <input class="form-control rounded-0" id="baths" type="number" name="baths" value="" placeholder="Baths">
        </div>
        <div class="input_box col-4 col-12-sm flex-fill my-2">
          <input class="form-control rounded-0" id="square_m" type="number" name="square_m" value="" placeholder="Square Meters">
        </div>
        <div class="input_box col-4 col-12-sm flex-fill mt-2">
          <select class="custom-select rounded-0" id="price" name="price">
            <option value="0" selected="selected"> Price </option>
            <option value="30"> < 30€ </option>
            <option value="60"> < 60€ </option>
            <option value="90"> < 90€ </option>
            <option value="120"> < 120€ </option>
          </select>
        </div>
      </div>

      <div class="d-flex justify-content-around col-12 form-check my-3">
        <div class="checkbox col-2">
          <label class="container_checkbox">Pool
          <input id="pool" type="checkbox" name="pool" value="false">
          <span class="checkmark"></span>
          </label>
        </div>
        <div class="checkbox col-2">
          <label class="container_checkbox">WiFi
          <input id="wifi" type="checkbox" name="wifi" value="false">
          <span class="checkmark"></span>
          </label>
        </div>
        <div class="checkbox col-2">
          <label class="container_checkbox">Pets
          <input id="pet" type="checkbox" name="pet" value="false">
          <span class="checkmark"></span>
          </label>
        </div>
        <div class="checkbox col-2">
          <label class="container_checkbox">Parking
          <input id="parking" type="checkbox" name="parking" value="false">
          <span class="checkmark"></span>
          </label>
        </div>
        <div class="checkbox col-2">
          <label class="container_checkbox">Piano
          <input id="piano" type="checkbox" name="piano" value="false">
          <span class="checkmark"></span>
          </label>
        </div>
        <div class="checkbox col-2">
          <label class="container_checkbox">Sauna
          <input id="sauna" type="checkbox" name="sauna" value="false">
          <span class="checkmark"></span>
          </label>
        </div>
      </div>

      <div class="row justify-content-center mt-3 mb-5">
        {{-- non è importante il tipo di tag scelto ma deve contenere l'id #submit --}}
        <div class="submit_search">
          <input class="input_search" id="submit" type="submit" value="Ricerca">
        </div>
      </div>

      {{-- l'input search deve contenere l'id address-input
      per renderlo disponibile a places.js
      i data-att sono contengono le informazioni sulla latitudine e longitudine--}}
    </div>

<<<<<<< HEAD
    <div class="row">
      {{-- <div class="text-center"> --}}

    </div>

    <div class="row">

    </div>
  </div>


    {{-- è consigliato non utilizzare il tag form
    per evitare che la pagina venga refreshata --}}
    {{-- <div class="search-wrapper">
    </div> --}}

    {{-- la classe del div serve ad identificare il punto di aggancio in cui riprodurre il template Handlebars
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <div class="container-fluid cont_suites_cards">
      <div class="row">
        <div class="col-6 suites-cards">
        </div>
        <div class="col-6 my_maps">
=======
    {{-- map --}}
    {{-- è essenziale la classe del wrapper e l'id della mappa:
    assegnare l'altezza desisderata alla mappa (o scompare) ed eliminare lo stile dall'html --}}
    <div class="map-wrapper">
        <div id="map" style="height:250px"></div>
    </div>


    {{-- la classe del div serve ad identificare il punto di aggancio in cui riprodurre il template Handlebars
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <div class="suites-cards-promo text-primary">

    </div>


    <div class="suites-cards-noPromo">
>>>>>>> master

        </div>
      </div>
    </div>



    {{-- l'id dello script serve ad identificare il template dalla funzione ajax in search.js
    se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
    <script id="suite-cards-template" type="text/x-handlebars-template">
<<<<<<< HEAD
        <div class="entry col-12 d-flex">
          <div class="col-5">
            <img src="@{{main_image}}" alt="@{{title}}">
          </div>
          <div class="body col-7">
            <h2>@{{title}}</h2>
            <h3>@{{address}}</h3>
            <h3>@{{price}}€</h3>
          </div>
=======
      <div class="entry">
        <img src="@{{main_image}}" alt="@{{title}}">
        <div class="card-info" data-lat="@{{latitude}}" data-lng="@{{longitude}}">
          <h2>@{{title}}</h2>
          <h3>@{{address}}</h3>
          <h3>@{{price}}€</h3>
>>>>>>> master
        </div>
    </script>

@endsection
