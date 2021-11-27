<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Bag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PicPay extends Controller
{
	private $payment = null;
	private $url = 'https://appws.picpay.com/ecommerce/public/payments';
	private $urlCallBack = 'http://alternativestore.com.br';
	private $urlReturn = 'http://alternativestore.com.br';
	private $x_picpay_token = '';
	private $x_seller_token = '';

	private $referenceId;
	private $customer;
	private $value = 0;

	public function __construct()
	{
		$this->x_picpay_token = env('PICPAY_TOKEN');
		$this->x_seller_token = env('PICPAY_SELLER_TOKEN');
	}

	public function payment()
	{
		$products = Bag::products();

		foreach ($products as $p) {
			$this->value += $p->price * $p->quantity;
		}

		$this->referenceId = rand(1000, 99999);

		$this->customer = [
			'firstName' => Auth::user()->name,
			'lastName' => '',
			'document' => User::cpf(Auth::user()->cpf),
			'email' => Auth::user()->email,
			'phone' => Auth::user()->telephone,
		];

		$this->payment = $this->requestPayment();
		return $this->response();
	}

	private function response()
	{
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

	/**
	 * Faz requisição para a API do PicPay, abre uma transação e
	 * retorna um objeto com os dados retornados
	 *
	 * @see https://studio.picpay.com/produtos/e-commerce/checkout/resources/api-reference
	 *
	 * @return object
	 */
	private function requestPayment()
	{
		$data = [
			'referenceId' => $this->referenceId,
			'callbackUrl' => $this->urlCallBack,
			'returnUrl' => $this->urlReturn,
			'value' => $this->value,
			'expiresAt' => '2022-05-01T16:00:00-03:00',
			'buyer' => $this->customer,
		];

		$client = new \GuzzleHttp\Client();

		$response = $client->request('POST', $this->url, [
			'headers' => [
				'x-picpay-token' => $this->x_picpay_token,
			],
			'json' => $data
		]);

		return (object) json_decode((string) $response->getBody());
	}

	/**
	 * Rota para buscar status da transação
	 *
	 * @return mixed
	 */
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
