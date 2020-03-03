<?php

namespace Omnipay\PayOp\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{
	protected $endpoint = '/v1/invoices/create';

	public function sendData ( $data )
	{
		
		try {
			
			$response = $this->httpClient->request('POST', ($this->getUrl() . $this->endpoint), [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer '. $this->getToken(),
			], json_decode($data, true));
			 
			$httpResponse = simplexml_load_string($response->getBody()->getContents());
			
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
	
}
