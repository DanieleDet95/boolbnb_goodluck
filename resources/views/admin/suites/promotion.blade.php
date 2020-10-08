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
    <form id="payment-form" action="{{ route('admin.checkout', $suite) }}" method="post">
      @csrf
      @method("POST")
      <h3>Scegli la modalitá di sponsorizzazione:</h3>
      <table border="1" class="text-center">
        <tr>
          <th>Tipo</th>
          <th>Prezzo</th>
          <th>Ore</th>
          <th>Seleziona</th>
        </tr>

          @foreach ($highlights as $highlight)
          <tr>
            <td>{{$highlight->name}}</td>
            <td>{{$highlight->price}}</td>
            <td>{{$highlight->type}}</td>
            <td><input type="radio" name="type" value="{{$highlight->type}}"></td>
          </tr>
          @endforeach

      </table>

      <div class="col-sm-12 col-md-12 col-lg-6">

        {{-- Tabella pagamento --}}
        <div id="bt-dropin"></div>

        <input id="nonce" name="payment_method_nonce" type="hidden"/>

        <div>
          <button class="left-side" type="submit">
            <div class="card">
              <div class="btn standard">Paga ora</div>
            </div>
          </button>
        </div>

      </div>
    </form> <?php
  }
  ?>
  </main>

  <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
  <script>
      var form = document.querySelector('#payment-form');
      var client_token = "{{ $token }}";
      braintree.dropin.create({
              authorization: client_token,
              selector: '#bt-dropin',
          },
          function (createErr, instance) {
              if (createErr) {
                  console.log('Create Error', createErr);
                  return;
              }
              form.addEventListener('submit', function (event) {
                  event.preventDefault();
                  instance.requestPaymentMethod(function (err, payload) {
                      if (err) {
                          console.log('Request Payment Method Error', err);
                          return;
                      }
                      // Add the nonce to the form and submit
                      document.querySelector('#nonce').value = payload.nonce;
                      form.submit();
                  });
              });
          });
      // istruzioni per forzare il refresh della pagina quando si preme il tasto indietro del browser
      window.addEventListener("pageshow", function (event) {
          var historyTraversal = event.persisted ||
              (typeof window.performance != "undefined" &&
                  window.performance.navigation.type === 2);
          if (historyTraversal) {
              // Handle page restore.
              window.location.reload();
          }
      });
  </script>

@endsection
