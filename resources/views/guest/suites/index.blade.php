{{-- Guest/index.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Jumbotron --}}
  <section class="jumbotron mb-0 p-0 jumbotron-fluid text-lg-left text-center jumbo_custom">

    {{-- Carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>

      {{-- Background Images Carousel--}}
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset("img/florence.jpg") }}" class="d-block w-100" alt="Background image">
        </div>
        <div class="carousel-item">
          <img src="{{ asset("img/tuscany.jpg") }}" class="d-block w-100" alt="Background image">
        </div>
        <div class="carousel-item">
          <img src="{{ asset("img/grand-canal.jpg") }}" class="d-block w-100" alt="Background image">
        </div>
      </div>
      {{-- end Background Images Carousel--}}

      {{-- Next --}}
      <a class="carousel-control-next d-none d-xl-flex" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      {{-- end Next --}}

    </div>
    {{-- end Carousel --}}

    <div class="container jumbo_container">

      {{-- Jumbotron Title --}}
      <div class="row d-flex justify-content-lg-start justify-content-center">
        <div class="col-12 col-md-12 col-xl-6">
          <div class="jumbo_title">
            <h1 class="jumbo_top_title">Discover Italy</h1>
            <p class="jumbo_sub_title">Change the picture. Discover nearby accommodations to enjoy, for work or leisure.</p>
          </div>
        </div>
      </div>

      {{-- Jumbotron Search input --}}
      <div class="row d-flex justify-content-lg-start justify-content-center">
        <div class="col-12 col-md-12 col-xl-6">
          <form class="form_search_bar form" action="{{ route('suites.search.submit') }}" method="post">
            @csrf
            @method('get')

              {{-- Input group search bar --}}
              <div id="algolia_form" class="input-group">

                {{-- Algolia input --}}
                <input type="search" id="home_search" class="form-control border-0 rounded-0" placeholder="Where do you want to go?" aria-label="Recipient's username" aria-describedby="button-addon2">
                <input id="key" type="text" name="key" class="form-control rounded-0 border-0 d-none">
                <input id="latitude" type="text" name="latitude" class="form-control rounded-0 border-0 d-none">
                <input id="longitude" type="text" name="longitude" class="form-control rounded-0 border-0 d-none">
                {{-- end Algolia input --}}

                {{-- Button --}}
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary rounded-0" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
                {{-- end Button --}}

              </div>
              {{-- end Input group search bar --}}

          </form>
        </div>
      </div>
      {{-- end Jumbotron Search input --}}

    </div>
  </section>
  {{-- end Jumbotron --}}


  {{-- Suites cards --}}
  <section class="suites_cards">

    {{-- Bootsrap --}}
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10 p-0">

          {{-- Suites Cards title --}}
          <div class="main_title text-center">
            <div class="top_title">
              <h4>Highlights Suites</h4>
            </div>

            <div class="sub_title">
              <h3>Choose your suite</h3>
            </div>
          </div>
          {{-- end Suites Cards Title --}}

          <div class="row">

            {{-- Foreach suite with a promotion --}}
            @foreach ($highlights_suites_active as $highlight_suite_active)
              {{-- Card --}}
              <div class="col-lg-4 col-md-6 col-sm-12 pb-2 p-2">
                <div class="card-deck">
                  <div class="card single_card border-0 rounded-0">

                    {{-- Change Main Image path If Faker Or Storage --}}
                    @if (isset($highlight_suite_active->main_image))
                      @if (strpos($highlight_suite_active->main_image, 'lorempixel') == false)

                        {{-- Main Image storage --}}
                        <img
                          class="card-img-top border-0 rounded-0"
                          src="{{ asset('storage') . "/" . $highlight_suite_active->main_image }}"
                          alt="{{ $highlight_suite_active->title }}">
                        {{-- end Main Image storage --}}

                       @else

                         {{-- Main Image faker --}}
                         <img
                           class="card-img-top"
                           src="{{ $highlight_suite_active->main_image }}"
                           alt="{{ $highlight_suite_active->title }}">
                         {{-- end Main Image faker --}}

                      @endif
                    @endif
                    {{-- end Change Main Image path If Faker Or Storage --}}

                    {{-- Card Text --}}
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                      <div class="title_address">
                        <h5 class="card-title">{{ $highlight_suite_active->title }}</h5>
                        <p class="card-text">{{ $highlight_suite_active->address }}</p>
                      </div>

                      {{-- Services --}}
                      <div class="services d-flex justify-content-start">
                        @foreach ($suites as $suite)
                          @if ($suite->id === $highlight_suite_active->id)
                            @if (empty($suite->services))
                              <i class="fas fa-not-equal"></i>
                            @else
                              @foreach ($suite->services as $suite_service)
                                <i class="{{ $suite_service->icon }} pr-3"></i>
                              @endforeach
                            @endif
                          @endif
                        @endforeach
                      </div>
                      {{-- end Services --}}

                      {{-- Price & Show button --}}
                      <div class="price_show d-flex justify-content-between align-items-center">
                        <div class="price d-flex justify-content-start">
                          <span>{{ $highlight_suite_active->price }} $</span>
                        </div>
                        <div class="suite_show_link">
                          <a href="{{ route("suites.show", $highlight_suite_active->id) }}" class="badge badge-primary border-0 rounded-0">
                            <span>Show</span>
                          </a>
                        </div>
                      </div>
                      {{-- Price & Show button --}}

                    </div>
                    {{-- end Card Text --}}

                  </div>
                </div>
              </div>
            {{-- end Card --}}
            @endforeach

          </div>
        </div>
      </div>
    </div>
    {{-- end Bootsrap --}}

  </section>
  {{-- end Suites cards --}}
@endsection
