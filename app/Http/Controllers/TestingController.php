<?php

namespace App\Http\Controllers;

use MercadoPago;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function show()
    {
        $acces_token = "TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077";
        MercadoPago\SDK::setAccessToken($acces_token);
        $preference = new MercadoPago\Preference();
        $preference->back_urls = array(
            "success" => "http://localhost:3000/carrito-de-compras/pago/aceptado",
            "failure" => "http://localhost:3000/fallo",
            "pending" => "http://localhost:3000/pendiente",
        );

        $productos = [];
        $item = new MercadoPago\Item();
        $item->quantity = 1;
        $item->unit_price = 50;
        array_push($productos, $item);
        $preference->items = $productos;
        $preference->save();
        return $preference->id;
    }

    public function create(
        Request $request
    )
    {
        $acces_token = "TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077";

        MercadoPago\SDK::setAccessToken($acces_token);
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float) $request->transactionAmount;
        $payment->token = $request->token;
        $payment->description = $request->description;
        $payment->installments = (int) $request->installments;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->issuer_id = (int) $request->issuer;

        $payer = new MercadoPago\Payer();
        $payer->email = $request->email;
        $payer->identification = array(
            "number" => $request->identificationNumber
        );
        $payment->payer = $payer;
        $payment->save();
        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        echo json_encode($response);
        return $response;
    }
    public function createClient()
    {
        $acces_token = "TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077";
        MercadoPago\SDK::setAccessToken($acces_token);

        $customer = new MercadoPago\Customer();
        $customer->email = "test_payer_12345@testuser.com";
        $customer->save();
      
        $card = new MercadoPago\Card();
        $card->token = "9b2d63e00d66a8c721607214cedaecda";
        $card->customer_id = $customer->id();
        $card->issuer = array("id" => "3245612");
        $card->payment_method = array("id" => "debit_card");
        $card->save();
    }

    public function showCardsByCostumer()
    {
        $acces_token = "TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077";
        MercadoPago\SDK::setAccessToken($acces_token);
        $customer = MercadoPago\Customer::find_by_id("800196786-UQzoeK5ore8lCT");
        $cards = $customer->cards();
        return $cards;

    }

    public function paymentMethods()
    {
        $acces_token = "TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077";
        MercadoPago\SDK::setAccessToken($acces_token);
        $payment_methods = MercadoPago::get("/v1/payment_methods");

    }


    public function cardProccess(Request $request)
    {
        //Se agrega el token de acceso
        MercadoPago\SDK::setAccessToken("TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077");
        //Se guardan todas los datos del formulario
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float) 100;//$request->transactionAmount;
        $payment->token = $request->token;
        $payment->description = null;
        $payment->installments = (int)$request->installments;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->issuer_id = (int)$request->issuer;
        //Se guardan todaos los datos del comprador
        
        $payer = new MercadoPago\Payer();
        $payer->email = $request->email;
        $payer->identification = array(
            "number" => null
        );
    
        $payment->payer = $payer;
        $payment->save();
        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id,
            'TOKEN'=>$request->token
            
        );
        return json_encode($response);
    }
    public function showClient(){
        $acces_token = "TEST-8834052227535285-113019-a2acd661ac02190b395613a1d951305d-1251414077";
        MercadoPago\SDK::setAccessToken($acces_token);
        $filters = array(
            "id"=>"1252400955-O9gm6r4MGSXcxH"
          );
        
          $customers = MercadoPago\Customer::search($filters);
          return $customers;
    }
}