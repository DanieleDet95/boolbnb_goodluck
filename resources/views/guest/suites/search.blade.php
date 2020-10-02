{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Sono la ricerca</h1>
  <input type="text" name="" value="">

  {{-- Suites cards --}}
  <section class="section_suites_cards">
    <div class="container">
      <div class="row row-cols-md-3 p-3 m-3">
      {{-- Foreach suite --}}
      @foreach ($suites as $suite)
        <div class="container">
          <a href={{ route("suites.show", $suite->id)}}>
            <div class="example-row p-3 m-3">
              {{-- Main Image --}}
              <div class="example-content-main">
                {{-- cambio path della main_image a seconda dalla provenienza(faker o storage)  --}}
                @if (isset($suite->main_image))
                  @if (strpos($suite->main_image, 'lorempixel') == false)
                    <img src="{{ asset('storage') . "/" . $suite->main_image}}" alt="{{$suite->title}}">
                   @else
                   <img src="{{$suite->main_image}}" alt="{{$suite->title}}">
                  @endif
                @endif
              </div>
              {{-- End Main Image --}}
              <div class="example-content-secondary">
                <h5>{{$suite->title}}</h5>
                <p>{{$suite->address}}</p>
              </div>
            </div>
          </a>
        </div>
      @endforeach
      </div>
    </div>
  </section>
  {{-- end Suites cards --}}

  <div>
    <a href="{{ route("suites.index")}}"> Torna a Index</a>
  </div>
@endsection
