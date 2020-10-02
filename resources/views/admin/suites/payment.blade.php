{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section("content")
  <h1>Sponsorizza la stanza: {{ $suite->title }}</h1>
  <?php

  // Se l'appartamento ha almeno un abbonamento
  if (isset($suite->highlights)) {
    $attivo = false;
    foreach ($suite->highlights as $highlight) {

      $oggi = date('Y-m-d H:i:s');
      // Se la sponsorizzazione é attiva
      if ( $oggi < $highlight->pivot['end']) {
        $attivo = true;
        $termine = $highlight->pivot['end'];
      }
    }
  }else{
    $attivo = true;
  }
  
  // Se la sponsorizzazione é attiva mostrare il messaggio altrimenti il form
  if ($attivo) { ?>
    <h3>Hai ancora l'abbonamento attivo fino alla data: {{ $termine }}</h3> <?php
  }else { ?>
    <form action="{{route("admin.suites.store_payment", $suite->id)}}" method="post">
      @csrf
      @method("POST")
      <h3>Scegli la modalitá di sponsorizzazione:</h3>
      <div>
        <input type="radio" name="type" value="24"> 2,99 per 24 ore di sponsorizzazione
      </div>
      <div>
        <input type="radio" name="type" value="72"> 5,99 per 72 ore di sponsorizzazione
      </div>
      <div>
        <input type="radio" name="type" value="144"> 9,99 per 144 ore di sponsorizzazione
      </div>
      <br>
      <div>
        <input type="submit" value="submit">
      </div>
    </form> <?php
  }
  ?>

  <div>
    <a href="{{ route("suites.index")}}"> Torna a Index</a>
  </div>

@endsection
