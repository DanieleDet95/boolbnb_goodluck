{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Main wrapper search --}}
  <div class="main_wrapper_search">

    {{-- Bootstrap Container Search --}}
    <div class="container-fluid">

      {{-- Search bar Wrapper --}}
      <div class="row d-flex justify-content-center">
        <div class="col-10">
          <div id="search_wrapper" class="search_bar_wrapper common_form">

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
                  <input class="form-control rounded-0" type="search" id="algolia_input" data-lat="{{$lat}}" data-lng="{{$lng}}" placeholder="Where are we going?" value="{{$key}}">
                @else
                  <input class="form-control rounded-0" type="search" id="algolia_input" data-lat="" data-lng="" placeholder="Where are we going?" />
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
                      <label class="container_checkbox" title="{{ $service->supplements }}"><i class="{{ $service->icon }}"></i>
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
        </div>
      </div>
      {{-- end Search bar Wrapper --}}

      {{-- Cards --}}
      <div class="row d-flex justify-content-center">
        <div class="col-10 mt-5">
          <div class="row">

            {{-- Suites Cards --}}
            <div class="col-6">

            {{-- Database Highlights suites --}}
            <div class="suites_cards_promo">
            </div>
            {{-- end Database Highlights suites --}}

            {{-- Others suites --}}
            <div class="suites_cards_noPromo">
            </div>
            {{-- end Others suites --}}

            </div>
            {{-- end Suites Cards --}}

            {{-- Mappa --}}
            <div class="col-6 my_maps mb-3">
              <div id="map"></div>
            </div>
            {{-- end Mappa --}}

          </div>
        </div>
      </div>
      {{-- end Cards --}}

    </div>
    {{-- end Bootstrap Container Search --}}

  </div>
  {{-- end Main wrapper search --}}

{{-- Modal --}}
<div class="modal"><!-- Place at bottom of page --></div>

{{-- l'id dello script serve ad identificare il template dalla funzione ajax in search.js
se si rende necessario modificarlo, aggiornare il riferimento in search.js --}}
<script id="suite-cards-template" type="text/x-handlebars-template">
  <div class="card mb-3 border-0 rounded-0">
    <div class="row no-gutters">

      <!-- Images -->
      <div class="col-6 p-0 overflow-hidden">
        <div class="postion-relative img_container">
          <img src="@{{{main_image}}}" class="img-fake position-absolute" onerror="this.style.display='none'">
          <img src="{{ asset('storage') }}/@{{{main_image}}}" class="img-asset position-absolute" onerror="this.style.display='none'">
        </div>
      </div>
      <!-- end Images -->

      <!-- Text -->
      <div class="col-6 p-0 pl-2">
        <div class="card-body d-flex flex-column justify-content-between">
          <div class="title_address">
            <h6 class="card-title">@{{title}}</h6>
            <p class="card-text">@{{address}}</p>
          </div>

          {{-- Price & Show button --}}
          <div class="price_show d-flex justify-content-between align-items-center">
            <div class="price d-flex justify-content-start">
              <span>@{{price}}$</span>
            </div>
            <div class="suite_show_link">
              <a href="{{route('suites.handle.show')}}/@{{id}}" class="badge badge-primary border-0 rounded-0">
                <span>Show</span>
              </a>
            </div>
          </div>
          {{-- Price & Show button --}}

        </div>
      </div>
      <!-- end Text -->

    </div>
  </div>
</script>
@endsection
