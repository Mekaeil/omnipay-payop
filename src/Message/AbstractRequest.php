<?php

namespace Omnipay\PayOp\Message;

use \Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    public function getUrl()
    {
        return 'https://payop.com';
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

	public function getLanguage ()
	{
		return $this->getParameter('language');
	}

	public function setLanguage ( $value )
	{
		return $this->setParameter( 'language', $value );
	}

	public function getResultUrl ()
	{
		return $this->getParameter( 'resultUrl' );
	}

	public function setResultUrl ( $value )
	{
		return $this->setParameter( 'resultUrl', $value );
	}

	public function getFailPath ()
	{
		return $this->getParameter( 'failPath' );
	}

	public function setFailPath ( $value )
	{
		return $this->setParameter( 'failPath', $value );
	}

	public function getOrder ()
	{
		return $this->getParameter( 'order' );
	}	

	public function setOrder ( $value )
	{
		return $this->setParameter( 'order', $value );
	}

	public function getPayer ()
	{
		return $this->getParameter( 'payer' );
	}

	public function setPayer ( $value )
	{
		return $this->setParameter( 'payer', $value );
	}

	public function getMetadata ()
	{
		return $this->getParameter( 'metadata' );
	}

	public function setMetadata ( $value )
	{
		return $this->setParameter( 'metadata', $value );
	}

	public function getPayMethod ()
	{
		return $this->getParameter( 'paymentMethod' );
	}

	public function setPayMethod ( $value )
	{
		return $this->setParameter( 'paymentMethod', $value );
	}

}
