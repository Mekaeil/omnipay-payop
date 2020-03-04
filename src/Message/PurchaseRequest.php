<?php

namespace Omnipay\PayOp\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{
	protected $endpoint = '/v1/invoices/create';

	public function getData ()
	{
		$this->validate( 
			'token',
			'language',
			'publicKey',
			'secretKey',
			'resultUrl',
			'failPath',	
			'order',	
			'payer',	
			'testMode',
		);

		$data = [
			'token'	=> $this->getToken(),
			'language'	=> $this->getLanguage(),
			'publicKey'	=> $this->getPublicKey(),
			'secretKey'	=> $this->getSecretKey(),
			'signature'	=> $this->generateSignature($this->getOrder(), $this->getSecretKey()),
			'order' => $this->getOrder(),
			'payer' => $this->getPayer(),
			'resultUrl' => $this->getResultUrl(),
			'failPath' => $this->getFailPath(),
			'metadata' => $this->getMetadata(),
			'paymentMethod'	=> $this->getPayMethod(),
			'testMode'	=> $this->getTestMode(),
		];
		
		return $data;
	}
	
	public function sendData ( $data )
	{
		try {
			$response = $this->httpClient->request('POST', ($this->getUrl() . $this->endpoint), [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer '. $this->getToken(),
			], json_encode($data));
			
			$httpResponse = json_decode($response->getBody()->getContents());
		} 
		catch (Exception $e) {

			if ( $this->getTestMode() ) {
				throw new InvalidResponseException('PayOp RESTful API gave : ' . $e->getMessage(), $e->getCode());
			} 
			else {
				throw $e;
			}
        }
		
		return new PurchaseResponse( $this, $httpResponse );
	}


	private function generateSignature($orderInformation, $secretKey)
	{
		// $order_arr = json_decode($orderInformation, true);
		$order_arr = $orderInformation;

		if(array_key_exists('id', $order_arr) && array_key_exists('amount', $order_arr) && array_key_exists('currency', $order_arr)){
			$order['id'] = $order_arr['id'];
			$order['amount'] = $order_arr['amount'];
			$order['currency'] = $order_arr['currency'];
			
			ksort($order, SORT_STRING);
			$dataSet 	= array_values($order);
			$dataSet[] 	= $secretKey;
			return hash('sha256', implode(':', $dataSet));
		}

		throw new InvalidRequestException("The Order parameters are required. [id, amount, currency]"); 
	}
	
}
