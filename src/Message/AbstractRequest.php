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
    
}
