<?php
/*
 * PayOp driver for Omnipay PHP payment processing library
 * https://payop.com/en
 *
 *
 */
namespace Omnipay\PayOp;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
	
	public function getName ()
	{
		return 'PayOp';
	}

	public function getDefaultParameters ()
	{
		return [
			'token' => '',		// required
			'language' => 'en',	// required
			'publicKey'	=> '',	// required
			'secretKey' => '',	// required
			'signature'	=> '',	// required
			'resultUrl' => '',	// required
			'failPath' => '',	// required
			'order' => "",		// required, JSON object 
			'payer' => "",		// required, JSON object 
			'paymentMethod' => '', 	// string
			'metadata' => "", 		// JSON object
			'testMode' => false
		];
	}
	
	public function getToken ()
	{
		return $this->getParameter('token');
	}

	public function setToken ( $value )
	{
		return $this->setParameter( 'token', $value );
	}

	public function getSecretKey ()
	{
		return $this->getParameter('secretKey');
	}

	public function setSecretKey ( $value )
	{
		return $this->setParameter( 'secretKey', $value );
	}

	public function getPublicKey ()
	{
		return $this->getParameter( 'publicKey' );
	}

	public function setPublicKey ( $value )
	{
		return $this->setParameter('publicKey', $value);
	}

	public function getReturnUrl ()
	{
		return $this->getParameter( 'resultUrl' );
	}

	public function setReturnUrl ( $value )
	{
		return $this->setParameter( 'resultUrl', $value );
	}

	public function getCancelUrl ()
	{
		return $this->getParameter( 'failPath' );
	}

	public function setCancelUrl ( $value )
	{
		return $this->setParameter( 'failPath', $value );
	}

	public function getLanguage ()
	{
		return $this->getParameter('language');
	}

	public function setLanguage ( $value )
	{
		return $this->setParameter( 'language', $value );
	}

	
    /*
    |--------------------------------------------------------------------------
    | REQUESTS
    |--------------------------------------------------------------------------
    |
    */
	
	public function fetchIssuers ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\PayOp\Message\FetchIssuersRequest', $parameters );
	}

	public function fetchPaymentMethods ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\PayOp\Message\FetchPaymentMethodsRequest', $parameters );
	}

	public function purchase ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\PayOp\Message\PurchaseRequest', $parameters );
	}

	public function completePurchase ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\PayOp\Message\CompletePurchaseRequest', $parameters );
	}
}
