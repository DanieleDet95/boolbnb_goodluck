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
  public function index(Suite $suite)
    {
        $highlights = Highlight::all();

        $now = Carbon::now();
        $data_scadenza = false;
        $time_ending = false;
        if (count($suite->highlights) != 0) {

            foreach ($suite->highlights as $highlight) {
              $time_ending = $highlight->pivot->end;
              if ($time_ending < $now) {
                $apartment->highlights()->detach($highlight);
              }
            }

            $carbon_time_ending = new Carbon($time_ending);
            $data_scadenza = $carbon_time_ending->format('d-m-y');
        }


        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $token = $gateway->ClientToken()->generate();

        return view('admin.suites.promotion', compact('token', 'suite', 'highlights', 'data_scadenza' , 'now' ,'time_ending'));
    }


    public function checkout(Request $request, Suite $suite)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $amount = $request->type;
        $nonce = $request->payment_method_nonce;

        $highlight = $request->type;

        $this_highlight = Highlight::where('type', $highlight)->first();

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success || !is_null($result->transaction)) {
            $transaction = $result->transaction;

            if (isset($highlight)) {
                
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
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return redirect()->route('admin.transaction', $result->message); //da testare
        }
    }

    public function transaction(Suite $suite)
    {
        return view('admin.suites.transaction', compact('suite'));
    }
}
