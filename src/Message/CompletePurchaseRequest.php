<?php

namespace Omnipay\PayOp\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;


class CompletePurchaseRequest extends PurchaseRequest
{
	protected $endpoint = '/rest/v1/transactions/';

	public function getData ()
	{
		$this->validate( 'transactionId' );
		return [
			'id' => $this->getTransactionId() 
		];
	}

	public function sendData ( $data )
	{		
		try {
			$response = $this->httpClient->request('GET', ($this->getUrl() . $this->endpoint . $this->getTransactionId()), [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer '. $this->getToken(),
			], http_build_query($data));
			 
			$httpResponse = simplexml_load_string($response->getBody()->getContents());

			$httpResponse = $request->send();
		} 
		catch (Exception $e) {

			if ( $this->getTestMode() ) {
				throw new InvalidResponseException('PayOp RESTful API gave : ' . $e->getMessage(), $e->getCode() );
			} 
			else {
				throw $e;
			}
        }
		
		return new CompletePurchaseResponse( $this, $httpResponse->xml() );
	}
}
