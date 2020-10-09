{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")

  <div class="container-fluid">
    <div class="faq-title-wrapper">
      <h2>Le domande più frequenti - FAQs</h2>
      <p>
        Eccoci qua! Sei confuso? Hai perso la strada? Consulta la nostra <a href="{{route('suites.search')}}">ricerca</a>! Non hai ancora trovato la risposta che cercavi?
        Dai un'occhiata alla lista delle domande più frequenti qui sotto.</br>

        Se nemmeno questo dovesse aiutarti ricorda che dove non arriviamo noi arriva Dio!
      </p>
    </div>
  </div>
    <div class="accordion" id="accordionExample">
      @foreach ($faqs as $faq)
        @if ($faq->id === 1)
          <div class="card rounded-0">
            <div class="card-header bg-white border-0" id="heading{{$faq->id}}">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                  {!!$faq->title!!}
                </a>
              </h2>
            </div>

            <div id="collapse{{$faq->id}}" class="collapse show" aria-labelledby="heading{{$faq->id}}" data-parent="#accordionExample">
              <div class="card-body">
                {!! $faq->description !!}
              </div>
            </div>
          </div>
        @else
          <div class="card rounded-0">
            <div class="card-header bg-white border-0" id="heading{{$faq->id}}">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                  {!!$faq->title!!}
                </a>
              </h2>
            </div>

            <div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="heading{{$faq->id}}" data-parent="#accordionExample">
              <div class="card-body">
                {!!$faq->description!!}
              </div>
            </div>
          </div>
        @endif

      @endforeach
    </div>



@endsection
