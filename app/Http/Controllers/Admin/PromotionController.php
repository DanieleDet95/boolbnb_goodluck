<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Suite;
use App\Highlight;
use Braintree\Gateway;
use Carbon\Carbon;

class PromotionController extends Controller
{
  // ----------------------------------------- INDEX -----------------------------------------------
  public function index(Suite $suite)
    {
      // Ottenere tutti gli highlights
      $highlights = Highlight::all();

      // Ottenere la data odierna
      $now = Carbon::now();
      $data_scadenza = false;
      $time_ending = false;

      // Se esistono suite con gli highlights
      if (count($suite->highlights) != 0) {

        // Ciclare per ogni Highlight
        foreach ($suite->highlights as $highlight) {
          $time_ending = $highlight->pivot->end;

          // Se la data di scadenza é superiore alla data odierna eliminare l'Highlight
          if ($time_ending < $now) {
            $apartment->highlights()->detach($highlight);
          }
        }

        // Se l'Highlight non é scaduto,cambiare il dato in carbon con il formato
        $carbon_time_ending = new Carbon($time_ending);
        $data_scadenza = $carbon_time_ending->format('d-m-y');
      }

      // Implementare il Gateway per avere l'accesso al pagamento
      $gateway = new Gateway([
          'environment' => config('services.braintree.environment'),
          'merchantId' => config('services.braintree.merchantId'),
          'publicKey' => config('services.braintree.publicKey'),
          'privateKey' => config('services.braintree.privateKey')
      ]);

      // Ricavare il token univoco per ogni cliente
      $token = $gateway->ClientToken()->generate();

      return view('admin.suites.promotion', compact('token', 'suite', 'highlights', 'data_scadenza' , 'now' ,'time_ending'));
    }

  // --------------------------------------- CHECKOUT --------------------------------------------
  public function checkout(Request $request, Suite $suite)
  {
    // Implementare il Gateway per avere l'accesso al pagamento
    $gateway = new Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    // Calcolo del prezzo in base alla promozione
    if ($request->type == '24') {
      $costo = 2.99;
    }elseif ($request->type == '72') {
      $costo = 5.99;
    }else {
      $costo = 9.99;
    }
    $amount = $costo;

    // Metodo di pagamento
    $nonce = $request->payment_method_nonce;

    $highlight = $request->type;

    // Prendere il primo Highlight con il tipo passato
    $this_highlight = Highlight::where('type', $highlight)->first();

    // Passare tutti i dati relativi al pagamento
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    // Se la transazione ha avuto successo
    if ($result->success || !is_null($result->transaction)) {
        $transaction = $result->transaction;

      if (isset($highlight)) {

        // Creazione del database Highlight
        $start = Carbon::now('Europe/Rome');
        if ($highlight == '24') {
          $suite->highlights()->attach(1,
            [
              'start' => $start,
              'end' => $end = Carbon::now()->addHours(24)
            ]);
        }elseif ($highlight == '72') {
          $suite->highlights()->attach(2,
            [
              'start' => $start,
              'end' => $end = Carbon::now()->addHours(72)
            ]);
        }else {
          $suite->highlights()->attach(3,
            [
              'start' => $start,
              'end' => $end = Carbon::now()->addHours(144)
            ]);
        }

      }

      return redirect()->route('admin.transaction', compact('suite'));
    }
    else {
      $errorString = "";

      foreach($result->errors->deepAll() as $error) {
          $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
      }
      return redirect()->route('admin.transaction', $result->message);
    }
  }

  // --------------------------------------- TRANSACTION -------------------------------------------
  public function transaction(Suite $suite)
  {
    return view('admin.suites.transaction', compact('suite'));
  }
}
