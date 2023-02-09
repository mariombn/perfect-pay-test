<?php

namespace App\Services;

class MercadoPagoPaymentService
{
    /** @var string  */
    private $accessToken;

    public function __construct()
    {
        $this->accessToken = env('MP_ACCESS_TOKEN');
        \MercadoPago\SDK::setAccessToken($this->accessToken);
    }

    /**
     * Acessa a API do Mercado pago para gerar o boleto com os dados enviados
     * @param $purchaserData
     * @return mixed
     * @throws \Exception
     */
    public function ticketPayment($purchaserData)
    {
        $payment = new \MercadoPago\Payment();
        $payment->transaction_amount = $purchaserData['value'];
        $payment->token = $this->accessToken;
        $payment->description = "Um Livro";
        $payment->payment_method_id = "bolbradesco";
        $payment->payer = array(
            "email" => $purchaserData['email'],
            "first_name" => $purchaserData['name'],
            "last_name" => $purchaserData['lastname'],
            "identification" => array(
                "type" => 'cpf',
                "number" => $purchaserData['cpf']
            ),
            "address"=>  array(
                "zip_code" => $purchaserData['cep'],
                "street_name" => $purchaserData['streetName'],
                "street_number" => $purchaserData['streetNumber'],
                "neighborhood" => $purchaserData['neighborhood'],
                "city" => $purchaserData['city'],
                "federal_unit" => $purchaserData['federal_unit']
            )
        );

        $payment->save();

        $this->validPayment($payment);

        return $payment->transaction_details->external_resource_url;
    }

    /**
     * Acessa a API do mercado pago com o payload do mercadopago.js para efetuar a transação de cartão
     * @param $mpRawData
     * @return array
     * @throws \Exception
     */
    public function creditCardPayment($mpRawData)
    {
        $payment = new \MercadoPago\Payment();

        $payment->transaction_amount = $mpRawData['transactionAmount'];
        $payment->token = $mpRawData['token'];
        $payment->description = $mpRawData['description'];
        $payment->installments = $mpRawData['installments'];
        $payment->payment_method_id = $mpRawData['paymentMethodId'];
        $payment->issuer_id = $mpRawData['issuerId'];

        $payer = new \MercadoPago\Payer();
        $payer->email = $mpRawData['payer']['email'];
        $payer->identification = array(
            "type" => $mpRawData['payer']['identification']['type'],
            "number" => $mpRawData['payer']['identification']['number']
        );

        $payment->payer = $payer;

        $payment->save();

        $this->validPayment($payment);

        return [
            'id' => $payment->id,
            'status' => $payment->status,
            'detail' => $payment->status_detail
        ];
    }

    /**
     * Valida se houve algum erro após o payload ser salvo
     * @param $payment
     */
    private function validPayment($payment)
    {
        if($payment->id === null) {
            $errorMessage = 'Erro desconhecido';

            if($payment->error !== null) {
                $sdkErrorMessage = $payment->error->message;
                $errorMessage = $sdkErrorMessage !== null ? $sdkErrorMessage : $errorMessage;
            }

            throw new Exception($errorMessage);
        }
    }
}
