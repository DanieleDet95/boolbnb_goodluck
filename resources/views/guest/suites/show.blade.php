{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <div class="container-fluid container-md">
    {{-- Row Title Images --}}
    <div class="row flex-column flex-nowrap row_title_img">
      {{-- Prima riga fatta da titolo e indirizzo --}}
      <div class="title_show">
        <h2>{{$suite->title}}</h2>
        <h6>{{$suite->address}}</h6>
      </div>
      <hr>
      {{-- Seconda riga fatta dalle immagini e dalla main image --}}
      <div class="img_show d-flex flex-wrap">
        {{-- Immagine copertina --}}
        <div class="main_image_show col-5">
          @if (isset($suite->main_image))
            @if (strpos($suite->main_image, 'lorempixel') == false)
              <img class="rounded mx-auto d-block" src="{{ asset('storage') . "/" . $suite->main_image}}" alt="{{$suite->title}}">
             @else
             <img class="rounded mx-auto d-block" src="{{ $suite->main_image }}" alt="{{ $suite->title }}">
            @endif
          @endif
        </div>
        {{-- Immagini di supporto --}}
        <div class="images_show d-flex flex-wrap col-7">
          @foreach ($suite->images as $image)
            <div class="col-6">
              @if (isset($image->path))
                @if (strpos($image->path, 'lorempixel') == false)
                  <img class="rounded mx-auto d-block" src="{{ asset('storage') . "/" . $image->path}}" alt="{{$suite->title}}">
                 @else
                  <img class="rounded mx-auto d-block" src="{{ $image->path }}" alt="{{ $suite->title }}">
                @endif
              @endif
            </div>
          @endforeach
        </div>
      </div>
      {{-- Fine seconda riga di immagini --}}
      <hr>
    </div>
    {{-- Fine Row Tile Images --}}
    {{-- Row Details --}}
    <div class="row row_info">
      <div class="description_suite">
        <p>{{$suite->description}}</p>
      </div>
    </div>
    {{-- Fine Row Details --}}
  </div>
  <ul>
    @if (!empty($suite->user->name))
      <li>Nome: {{$suite->user->name}}</li>
    @endif
    @if (!empty($suite->user->lastname))
      <li>Cognome: {{$suite->user->lastname}}</li>
    @endif
    <li>Email: {{$suite->user->email}}</li>
    <li>Stanze: {{$suite->rooms}}</li>
    <li>Letti: {{$suite->beds}}</li>
    <li>Bagni: {{$suite->baths}}</li>
    <li>Metri quadri: {{$suite->square_m}}</li>
    <li>Prezzo: {{$suite->price}}</li>
    {{-- <li>Latitudine: {{$suite->latitude}}</li>
    <li>Longitudine: {{$suite->longitude}}</li>
    <li>id: {{$suite->id}}</li> --}}
    @if (!$suite->services->isEmpty())
      <h3>Servizi disponibili:</h3>
      @foreach ($suite->services as $service)
        <li><i class="{{ $service->icon }}"></i> {{ $service->supplements }}</li>
      @endforeach
    @endif
    <li>
      {{-- cambio path della main_image a seconda dalla provenienza(faker o storage)  --}}

    </li>
  </ul>

  {{-- cambio path delle immagini della tabella images a seconda dalla provenienza(faker o storage)  --}}


  {{-- l'admin può inviare un messaggio quando NON è proprietario dell'appartamento selezionato --}}

  @if (!is_null($user))

    @if (!($suite->user_id === $user->id))

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div>
        <form action="{{route("suites.store_message", $suite)}}" method="post">
          @csrf
          @method("POST")

          <div class="mail">
            <label>Inserisci Mail</label>
            <input type="email" name="email" value="{{ old("email") }}">
          </div>
          <div class="name">
            <label>Inserisci il nome</label>
            <input type="text" name="name" value="{{ old("name") }}">
          </div>
          <div class="body">
            <label>Inserisci Contenuto</label>
            <textarea name="body" rows="8" cols="80">{{ old("body") }}</textarea>
          </div>
          <div class="mail">
            <label>Inserisci Mail</label>
            <input type="submit" value="submit">
          </div>
        </form>
      </div>

    @endif

  @else

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div>
        <form action="{{route("suites.store_message", $suite)}}" method="post">
          @csrf
          @method("POST")

          <div class="mail">
            <label>Inserisci Mail</label>
            <input type="email" name="email" value="{{ old("email") }}">
          </div>
          <div class="name">
            <label>Inserisci il nome</label>
            <input type="text" name="name" value="{{ old("name") }}">
          </div>
          <div class="body">
            <label>Inserisci Contenuto</label>
            <textarea name="body" rows="8" cols="80">{{ old("body") }}</textarea>
          </div>
          <div class="mail">
            <label>Inserisci Mail</label>
            <input type="submit" value="submit">
          </div>
        </form>
      </div>

  @endif

@endsection
