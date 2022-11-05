<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;

class Paymob
{
    protected $authToken;
    protected $order;
    protected $order_id;
    protected $amount;

    public function authenticate()
    {
        $res = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => env('PAYMOB_API_KEY'),
        ]);

        $this->authToken = $res->object()->token;

        return $this;
    }

    public function registerOrder($order_id , $total , $data=[])
    {
        $this->data = $data;
        $this->order_id = $order_id;
        $this->total = $total*100 ;
        $res = Http::post('https://accept.paymob.com/api/ecommerce/orders', [
            'auth_token'        => $this->authToken,
            'delivery_needed'   => true,
            'amount_cents'      => (int) ceil($this->total) ,
            "currency"          => "EGP",
            'items'             => [],
            'merchant_order_id' => $order_id,
        ]);

        $this->order = $res->object();
//        dd($this->order);
        return $this;
    }

    public function generatePaymentKey()
    {
        $data = [
            'auth_token'     => $this->authToken,
            'expiration'     => 600,
            'order_id'       => $this->order->id,
            'amount_cents'   => $this->total ,
            'currency'       => 'EGP',
            'integration_id' => env('PAYMOB_INTEGRATION_ID'),
            'billing_data'   => [
                "first_name"      => $this->FisrtName(),
                "last_name"       => $this->LastName(),
                "email"           => $this->data['email'],//auth('api')->user()->email ?? auth()->user()->email,
                "phone_number"    => $this->data['phone'],//auth('api')->user()->mobile ?? auth()->user()->mobile,
                "apartment"       => "NA",
                "floor"           => "NA",
                "street"          => "NA",
                "building"        => "NA",
                "shipping_method" => "NA",
                "postal_code"     => "NA",
                "city"            => "NA",
                "country"         => "NA",
                "state"           => "NA",
            ],
        ];

        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        $this->paymentKey = $response->object()->token;

        return $this;
        dd($response);
        return $response->object()->token;
    }

    public function getPaymentKey()
    {
        return $this->paymentKey;
    }

    /**
     * Check whether the response by the payment gateway is secure or not
     */
    public function isSecure($data)
    {
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];

        $connectedString = '';

        foreach ($array as $element) {
            if (array_key_exists($element, $data)) {
                $connectedString .= $data[$element];
            }
        }

        $hashed = hash_hmac('sha512', $connectedString, env('PAYMOB_HMAC'));

        if ($hashed == ($data['hmac'] ?? null)) {
            return true;
        } else {
            // The data sent was manipulated by a third-party.
            return false;
        }
    }

    private function FisrtName()
    {
        return $this->data['first_name'];// = "kiro";
        $name = explode (" ", $name);
        return $name[0];
    }

    private function LastName()
    {
        return $this->data['last_name'];
        $name = explode (" ", $name);
        return $name[1] ?? 'aloha';
    }
}
