<?php

namespace Omnipay\PayOp\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class FetchPaymentMethodsRequest extends AbstractRequest 
{
    protected $endpoint = '/v1/instrument-settings/payment-methods/available-for-user';

    public function getData() 
    {
        return array();
    }

    public function sendData( $data ) 
    {    
        try {
			$response = $this->httpClient->request('GET', ($this->getUrl() . $this->endpoint), [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer '. $this->getToken(),
			], http_build_query($data));
			 
			$httpResponse = json_decode($response->getBody()->getContents(), true);
        }
        catch (Exception $e) {

			if ( $this->getTestMode() ) {
				throw new InvalidResponseException('PayOp RESTful API gave : ' . $e->getMessage(), $e->getCode());
			} 
			else {
				throw $e;
			}
        }
      
        return $this->response = new FetchPaymentMethodsResponse( $this, $httpResponse);
    }

}