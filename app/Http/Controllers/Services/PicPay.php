<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PicPay extends Controller
{
	private $payment = null;
	private $url = 'https://appws.picpay.com/ecommerce/public/payments';
	private $urlCallBack = 'http://alternativestore.com.br';
	private $urlReturn = 'http://alternativestore.com.br';
	private $x_picpay_token = '';
	private $x_seller_token = '';

	private $product = [];
	private $customer = [];

	public function __construct()
	{
		$this->product = (object) [
			'ref' => rand(1000, 99999),
			'nome' => 'Trono de ferro',
			'valor' => 100.00,
		];

		$this->customer = (object) [
			'nome' => 'Daenerys',
			'sobreNome' => 'Targaryen',
			'cpf' => '000.000.000-00',
			'email' => 'email@provedor.com',
			'telefone' => '11999999999',
		];

		$this->x_picpay_token = env('PICPAY_TOKEN');
		$this->x_seller_token = env('PICPAY_SELLER_TOKEN');
	}

	public function payment()
	{
		$this->payment = $this->requestPayment();
		return $this->response();
	}

	private function response()
	{
		dd($this->payment);

		if (isset($this->payment->message)) {
			return response()->json([
				'message' => $this->payment->message,
			], 202);
		}

		return response()->json([
			'link' => $this->payment->paymentUrl,
			'qrCode' => $this->payment->qrcode->base64,
		], 200);
	}

	private function requestPayment()
	{
		/* $data = [
			'referenceId' => $this->product->ref,
			'callbackUrl' => $this->urlCallBack,
			'returnUrl' => $this->urlReturn,
			'value' => $this->product->valor,
			'expiresAt' => '2022-05-01T16:00:00-03:00',
			'buyer' => [
				'firstName' => $this->customer->nome,
				'lastName' => $this->customer->sobreNome,
				'document' => $this->customer->cpf,
				'email' => $this->customer->email,
				'phone' => $this->customer->telefone
			],
		]; */
		$data = [
			"referenceId" => "102030",
			"callbackUrl" => "http://www.sualoja.com.br/callback",
			"returnUrl" => "http://www.sualoja.com.br/cliente/pedido/102030",
			"value" => 20.51,
			"expiresAt" => "2022-05-01T16:00:00-03:00",
			"buyer" => [
				"firstName" => "João",
				"lastName" => "Da Silva",
				"document" => "0",
				"email" => "teste@picpay.com",
				"phone" => "+55 27 12345-6789"
			]
		];

		/**
		 * @see https://studio.picpay.com/produtos/e-commerce/checkout/guides/accepting-payments#funcionamento-b%C3%A1sico
		 */

		$response = Http::withOptions([
			'debug' => true,
		])->withBody(
			json_encode($data), 'application/json'
		)->withHeaders([
			'x-picpay-token' => $this->x_picpay_token,
			'Accept' => '*/*',
			'Content-Type' => 'application/json',
			'Accept-Encoding' => 'gzip, deflate, br',
			'Connection' => 'keep-alive'
		])->post($this->url/* , $data */);

		return $response;
	}

	private function notificationPayment()
	{
		$content = trim(file_get_contents('php://input'));
		$payBody = json_decode($content);

		if (!isset($payBody->authorizationId)) {
			return false;
		}

		$referenceId = $payBody->referenceId;

		$curl = curl_init("$this->url/$referenceId/status");

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ["x-picpay-token: $this->x_picpay_token"]);

		$response = curl_exec($curl);

		curl_close($curl);

		$notification = json_decode($response);

		$notification->referenceId = $payBody->referenceId;
		$notification->authorizationId = $payBody->authorizationId;

		return $notification;
	}
}
