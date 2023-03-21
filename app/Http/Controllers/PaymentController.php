<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Braintree\Transaction;
use App\Providers\AppServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Sponsor $sponsor, Apartment $apartment)
    {
        $customer = Auth::user();

        return view('payments.payment', [
            'braintree_customer_id' => $customer->braintree_customer_id,
            'sponsor' => $sponsor,
            'apartment' => $apartment
        ]);
    }
    public function process(Request $request)
    {


        $payload = $request->input('payload', false);

        // $status = new \Braintree\Transaction([
        // 'amount' => '50.00',
        // 'paymentMethodNonce' => $nonce,
        // 'options' => [
        //     'submitForSettlement' => True
        // ]
        // ]);

        // $result = $gateway->transaction()->sale([
        //     'amount' => '10.00',
        //     'paymentMethodNonce' => $nonceFromTheClient,
        //     'deviceData' => $deviceDataFromTheClient,
        //     'options' => [
        //       'submitForSettlement' => True
        //     ]
        //   ]);

        $data = $request->all();

        $sponsor = Sponsor::findOrFail($data['sponsor']);

        $apartment = Apartment::findOrFail($data['apartment']);

        $apartmentSponsorization = $apartment->sponsors->toArray();


        
        if (sizeof($apartmentSponsorization) > 0) {
            return redirect()->route("admin.apartments.show", $apartment->id)->with([
                "status" => "error",
                "message" => "Il tuo appartamento è gia sponsorizzato !",
            ]);
        } else {
            
            $gateway = new \Braintree\Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'm52fv2wvg4mdqvst',
                'publicKey' => '76j7d74x4rktsvf6',
                'privateKey' => '1d7c54269f95379ca7a350a731581f0d'
            ]);
    
            $result = $gateway->transaction()->sale([
                'amount' => $sponsor->price,
                'options' => ['submitForSettlement' => True],
                'paymentMethodNonce' => 'fake-valid-nonce',
            ]);
    
            if ($result->success === true) {
    
                $currentDateTime = Carbon::now();
                // data di fine, calcolata in base alla sponsorizzazione selezionata 
                $newDateTime = Carbon::now()->addHour($sponsor->hours);
                // creazione del record all'interno della tabella ponte 
                $apartment->sponsors()->attach($sponsor->id, ["start_date" => $currentDateTime, "end_date" => $newDateTime]);
    
                return redirect()->route("admin.apartments.show", $apartment->id)->with([
                    "status" => "success",
                    "message" => "Il tuo appartamento è stato sponsorizzato al costo di " . $sponsor->price . "€",
                ]);
            };

        }

    }
}
