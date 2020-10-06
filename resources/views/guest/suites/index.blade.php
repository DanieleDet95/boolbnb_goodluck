{{-- Guest/index.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Jumbotron --}}
  <section class="jumbotron p-0 jumbotron-fluid text-xl-left text-center jumbo_custom">

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
        <div class="col-12 col-xl-6">
          <div class="jumbo_title">
            <h1 class="jumbo_top_title">Discover Italy</h1>
            <p class="jumbo_sub_title">Change the picture. Discover nearby accommodations to enjoy, for work or leisure.</p>
          </div>
        </div>
      </div>

      {{-- Jumbotron Search input --}}
      <div class="row">
        <div class="col-12 col-xl-6">
          <div class="input-group">
            <input type="text" class="form-control rounded-0" placeholder="Where do you want to go?" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary rounded-0" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      {{-- end Jumbotron Search input --}}

    </div>
  </section>
  {{-- end Jumbotron --}}


  {{-- Suites cards --}}
  <section class="section_suites_cards">
    <div class="container">
<<<<<<< HEAD
      <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 p-3">

=======
      <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 p-3  justify-content-center">
>>>>>>> master
      {{-- Foreach suite with a promotion --}}
      @foreach ($highlights_suites_active as $highlight_suite_active)
        <a class="link_card" href={{ route("suites.show", $highlight_suite_active->id)}}>
          <div class="example-row item">
<<<<<<< HEAD
            <div class="example-content-main mx-3 polaroid">

=======
            <div class="example-content-main mx-3 polaroid d-flex flex-column justify-content-beetween">
>>>>>>> master
              {{-- cambio path della main_image a seconda dalla provenienza(faker o storage)  --}}
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
  </section>
  {{-- end Suites cards --}}
@endsection
