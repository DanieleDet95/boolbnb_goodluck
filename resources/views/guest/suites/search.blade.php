{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Bootstrap --}}
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-10">

        {{-- Search Wrapper --}}
        <div class="search_wrapper common_form">

          {{-- Form title --}}
          <div class="form_title text-center">
            <div class="top_title">
              <h4>Search suites</h4>
            </div>

            <div class="sub_title">
              <h3>Search for your suites</h3>
            </div>
          </div>
          {{-- end Form Title --}}

        {{-- Search bar --}}
        <div class="row d-flex justify-content-center">
          <div class="common_form search_location col-12">
            <div id="search_box" class="input_box">
              @if (isSet($key))
                <input class="form-control rounded-0" type="search" id="address_input" data-lat="{{$lat}}" data-lng="{{$lng}}" placeholder="Where are we going?" value="{{$key}}">
              @else
                <input class="form-control rounded-0" type="search" id="address_input" data-lat="" data-lng="" placeholder="Where are we going?" />
              @endif
            </div>
          </div>
        </div>
        {{-- end Search bar --}}

        {{-- Others inputs --}}
          <div class="common_form d-flex justify-content-lg-between flex-wrap">
            <div class="input_box p-0 mt-3 col-lg-2 pr-lg-3 pl-lg-0 mt-lg-3 col-md-6 pr-md-2 pl-md-0 mt-md-3 col-sm-12 mt-sm-3">
              <input class="form-control rounded-0" id="range" type="number" min="0" name="range" value="" placeholder="Km Distance">
            </div>
            <div class="input_box p-0 mt-3 col-lg-2 pl-lg-0 pr-lg-3 mt-lg-3 col-md-6 pl-md-2 pr-md-0 mt-md-3 col-sm-12 mt-sm-3">
              <input class="form-control rounded-0" id="rooms" type="number" min="1" name="rooms" value="" placeholder="Rooms">
            </div>
            <div class="input_box p-0 mt-3 col-lg-2 pl-lg-0 pr-lg-3 mt-lg-3 col-md-6 pl-md-0 pr-md-2 mt-md-3 col-sm-12 p-sm-0 mt-sm-3">
              <input id="bed" class="form-control rounded-0" id="beds" min="1" type="number" name="beds" value="" placeholder="Beds">
            </div>
            <div class="input_box p-0 mt-3 col-lg-2 pl-lg-0 mt-lg-3 pr-lg-3 col-md-6 pl-md-2 pr-md-0 mt-md-3 col-sm-12 p-sm-0 mt-sm-3">
              <input class="form-control rounded-0" id="baths" type="number" min="1" name="baths" value="" placeholder="Baths">
            </div>
            <div class="input_box p-0 mt-3 col-lg-2 pl-lg-0 pr-lg-3 mt-lg-3 col-md-6 pl-md-0 pr-md-2 mt-md-3 col-sm-12 p-sm-0 mt-sm-3">
              <input class="form-control rounded-0" id="square_m" type="number" min="15" name="square_m" value="" placeholder="Square Meters">
            </div>
            <div class="input_box p-0 mt-3 col-lg-2 pl-lg-0 pr-lg-0 mt-lg-3 col-md-6 pl-md-2 pr-md-0 mt-md-3 col-sm-12 p-sm-0 mt-sm-3">
              <select class="custom-select rounded-0" id="price" name="price">
                <option value="0" selected="selected"> Price </option>
                <option value="30"> < 30€ </option>
                <option value="60"> < 60€ </option>
                <option value="90"> < 90€ </option>
                <option value="120"> < 120€ </option>
              </select>
            </div>
          </div>
        {{-- Others inputs --}}

        <hr class="mt-3 mb-3">

          {{-- Services --}}
          <div class="search_services row">
            <div class="col-12">
              <div class="checkbox">
                <div class="row">

                  {{-- Checkbox --}}
                  @foreach ($services as $service)
                  <div class="col-4 col-lg-2 text-center d-flex justify-content-center">
                    <label class="container_checkbox d-flex align-items-middle" title="{{ $service->supplements }}"><i class="{{ $service->icon }}"></i>
                      <input id="{{ $service->supplements }}" type="checkbox" name="{{ $service->supplements }}" value="false">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  @endforeach
                  {{-- end Checkbox --}}

                </div>
              </div>
            </div>
          </div>
          {{-- end Services --}}

          {{-- Submit --}}
          <div class="row d-flex justify-content-center">
            <div class="col-12 text-center">
              <div class="btn_search">
                <input class="input_search" id="submit" type="submit" value="Search">
              </div>
            </div>
          </div>
          {{-- Submit --}}

        </div>
        {{-- end Search Wrapper --}}

      </div>
    </div>
  </div>
  {{-- end Bootstrap --}}

  {{-- Bootsrap --}}
   <div class="container-fluid container_suites_cards mb-5">
     <div class="row d-flex justify-content-center">
      <div class="col-10 mt-5">
        <div class="row">

          {{-- Suites Cards --}}
          <div class="col-lg-6 col-12 suites_cards">

            {{-- div per le card in evidenza --}}
            <div class="suites_cards_promo bg-light"></div>

            {{-- div per le card non in evidenza --}}
            <div class="suites_cards_noPromo"></div>

          </div>
          {{-- end Suites Cards --}}

          {{-- Mappa --}}
          <div class="d-none d-lg-block col-lg-6 d-xl-block col-xl-6 my_maps">
            <div id="map"></div>
          </div>
          {{-- end Mappa --}}

        </div>
      </div>
     </div>
   </div>
  {{-- end Bootsrap --}}

   <div class="modal"><!-- Place at bottom of page --></div>

   {{-- l'id dello script serve ad identificare il template dalla funzione ajax in search.js
   se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
   <script id="suite-cards-template" type="text/x-handlebars-template">
     <a href="{{route('suites.handle.show')}}/@{{id}}">
       <div class="entry py-3 col-12 d-flex align-items-center flex-column flex-sm-row">
         <div class="image_main_card col-12 col-sm-6">

           @if (strpos("@{{main_image}}", 'lorempixel') == false)
             <img
             src="{{ asset('storage') }}/@{{main_image}}"
             class="d-block w-100" alt="@{{title}}">
            @else
            <img src="@{{main_image}}" class="d-block w-100" alt="@{{title}}">
           @endif

         </div>
         <div class="body_card d-flex flex-column align-items-start col-12 col-sm-6">
           <h6>@{{title}}</h6>
           <p>@{{address}}</p>
           <h6>@{{price}} €/night</h6>

         </div>
       </div>
       <hr class="my-0">
     </a>
   </script>

@endsection
