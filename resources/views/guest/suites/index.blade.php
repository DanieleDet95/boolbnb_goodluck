{{-- Guest/index.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Jumbotron --}}
  <section class="jumbotron jumbotron-fluid text-xl-left text-center jumbo_custom">
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
            <input type="text" class="form-control rounded-0" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary rounded-0" type="button" id="button-addon2">Search</button>
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
      <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 p-3">

      {{-- Foreach suite with a promotion --}}
      @foreach ($highlights_suites_active as $highlight_suite_active)
        <a class="link_card" href={{ route("suites.show", $highlight_suite_active->id)}}>
          <div class="example-row item">
            <div class="example-content-main mx-3 polaroid">

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
              <div class="example-content-secondary caption">
                <h5>{{$highlight_suite_active->title}}</h5>
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
