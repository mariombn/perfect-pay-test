<?php

namespace App\Http\Controllers;

use App\Services\MercadoPagoPaymentService;
use Illuminate\Http\Request;
use MercadoPago;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('creditcard', ['publicKey' =>  env('MP_PUBLIC_KEY')]);
    }

    public function processPaymentTicket(
        Request $request,
        MercadoPagoPaymentService $mercadoPagoPaymentService
    ) {
        try {
            $data = $request->all();
            $ticketMercadoPagoUrl = $mercadoPagoPaymentService->ticketPayment($data);

            return view('ticket', ['ticketMLUrl' => $ticketMercadoPagoUrl]);
        } catch (\Exception $exception) {
            return view('error', ['exception' => $exception]);
        }
    }

    public function processPaymentCard(
        Request $request,
        MercadoPagoPaymentService $mercadoPagoPaymentService
    ) {
        try {
            $data = $request->all();
            $statusPayment = $mercadoPagoPaymentService->creditCardPayment($data);

            return response()->json($statusPayment);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage()
            ]);
        }
    }
}
