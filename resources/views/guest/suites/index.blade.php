{{-- Guest/index.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Jumbotron --}}
  <section class="jumbotron mb-0 p-0 jumbotron-fluid text-lg-left text-md-center text-center jumbo_custom">

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
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      {{-- end Next --}}

    </div>
    {{-- end Carousel --}}

    <div class="container jumbo_container">

      {{-- Jumbotron Title --}}
      <div class="row">
        <div class="col-12 col-md-10 col-lg-6">
          <div class="jumbo_title">
            <h1 class="jumbo_top_title">Discover Italy</h1>
            <p class="jumbo_sub_title">Change the picture. Discover nearby accommodations to enjoy, for work or leisure.</p>
          </div>
        </div>
      </div>

      {{-- Jumbotron Search input --}}
      <div class="row">
        <div class="col-12 col-md-10 col-lg-6">
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

      {{-- Foreach suite with a promotion --}}
      @foreach ($highlights_suites_active as $highlight_suite_active)
        <a class="link_card" href={{ route("suites.show", $highlight_suite_active->id)}}>
          <div class="example-row item">
            <div class="example-content-main mx-3 polaroid d-flex flex-column justify-content-beetween">
              {{-- Change path della main_image a seconda dalla provenienza(faker o storage)  --}}
              {{-- Main Image --}}
              @if (isset($highlight_suite_active->main_image))
                @if (strpos($highlight_suite_active->main_image, 'lorempixel') == false)
                  <img src="{{ asset('storage') . "/" . $highlight_suite_active->main_image}}" alt="{{$highlight_suite_active->title}}">
                 @else
                 <img src="{{$highlight_suite_active->main_image}}" alt="{{$highlight_suite_active->title}}">
                @endif
              @endif

              {{-- End Main Image --}}
              <div class="example-content-secondary caption flex-grow-1 d-flex flex-column">
                <h5 class="flex-grow-1">{{$highlight_suite_active->title}}</h5>
                <p>{{$highlight_suite_active->address}}</p>
              </div>
            </div>
          </div>
        </a>
      @endforeach
      </div>
    </div>
    {{-- end Bootsrap --}}

  </section>
  {{-- end Suites cards --}}
@endsection
