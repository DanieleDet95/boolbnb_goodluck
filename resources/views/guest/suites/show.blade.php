{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>show generale</h1>

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
    <li>Indirizzo: {{$suite->address}}</li>
    <li>Metri quadri: {{$suite->square_m}}</li>
    <li>Prezzo: {{$suite->price}}</li>
    <li>Latitudine: {{$suite->latitude}}</li>
    <li>Longitudine: {{$suite->longitude}}</li>
    <li>Descrizione: {{$suite->description}}</li>
    <li>id: {{$suite->id}}</li>
    @if (!$suite->services->isEmpty())
      <h3>Servizi disponibili:</h3>
      @foreach ($suite->services as $service)
        <li><i class="{{ $service->icon }}"></i> {{ $service->supplements }}</li>
      @endforeach
    @endif
    <li>
      {{-- cambio path della main_image a seconda dalla provenienza(faker o storage)  --}}
      @if (isset($suite->main_image))
        @if (strpos($suite->main_image, 'lorempixel') == false)
          <img src="{{ asset('storage') . "/" . $suite->main_image}}" alt="{{$suite->title}}">
         @else
         <img src="{{ $suite->main_image }}" alt="{{ $suite->title }}">
        @endif
      @endif
    </li>
  </ul>

  {{-- cambio path delle immagini della tabella images a seconda dalla provenienza(faker o storage)  --}}
  @foreach ($suite->images as $image)
    <div>
      @if (isset($image->path))
        @if (strpos($image->path, 'lorempixel') == false)
          <img src="{{ asset('storage') . "/" . $image->path}}" alt="{{$suite->title}}">
         @else
          <img src="{{ $image->path }}" alt="{{ $suite->title }}">
        @endif
      @endif
    </div>
  @endforeach

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
