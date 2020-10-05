{{-- Guest/index.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Jumbotron --}}
  <section class="jumbotron jumbotron-fluid my_jumbotron py-0 mb-0">
    <div class="container-fluid p-0">
      <img src="{{asset('img/sfondo-jumbo-1082.jpg')}}" alt="">
      <div class="row">
        <div class="col-12 col-lg-5 col-md-8 d-none d-lg-block d-xl-block title_jumbo">
          <h2>Riscopri l'Italia</h2>
          <p>Cambia quadro. Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</p>
        </div>
        <div class="input-group input-group-lg input_jumbo">
          <input type="search" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Dove vuoi andare?">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search-location"></i></button>
          </div>
        </div>
      </div>
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
