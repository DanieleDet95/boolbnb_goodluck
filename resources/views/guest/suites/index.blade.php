{{-- Guest/index.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  {{-- Jumbotron --}}
  <section class="jumbotron jumbotron-fluid my_jumbotron py-0 mb-0">
    <img src="{{asset('img/sfondo-jumbo-1081.jpg')}}" alt="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-5 col-md-8 title_jumbo">
          <h2>Riscopri l'Italia</h2>
          <p>Cambia quadro. Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</p>
        </div>
      </div>
    </div>

  </section>
  {{-- end Jumbotron --}}


  {{-- Suites cards --}}
  <section class="section_suites_cards">
    <div class="container">
      <div class="row row-cols-md-3 p-3">
      {{-- Foreach suite with a promotion --}}
      @foreach ($highlights_suites_active as $highlight_suite_active)
        <div class="container">
          <a href={{ route("suites.show", $highlight_suite_active->id)}}>
            <div class="example-row item p-3 m-3">
              {{-- Main Image --}}
              <div class="example-content-main polaroid">
                {{-- cambio path della main_image a seconda dalla provenienza(faker o storage)  --}}
                @if (isset($highlight_suite_active->main_image))
                  @if (strpos($highlight_suite_active->main_image, 'lorempixel') == false)
                    <img src="{{ asset('storage') . "/" . $highlight_suite_active->main_image}}" alt="{{$highlight_suite_active->title}}">
                   @else
                   <img src="{{$highlight_suite_active->main_image}}" alt="{{$highlight_suite_active->title}}">
                  @endif
                @endif
                <div class="example-content-secondary caption">
                  <h5>{{$highlight_suite_active->title}}</h5>
                  <p>{{$highlight_suite_active->address}}</p>
                </div>
              </div>
              {{-- End Main Image --}}

            </div>
          </a>
        </div>
      @endforeach
      </div>
    </div>
  </section>
  {{-- end Suites cards --}}
  {{-- PROVA --}}
  <div class="item">
    <div class="polaroid">
      <img src="https://image.ibb.co/b8UJBc/administration_architecture_big_ben_221166.jpg">
      <div class="caption">
        I Miss London
      </div>
    </div>
  </div>

@endsection
