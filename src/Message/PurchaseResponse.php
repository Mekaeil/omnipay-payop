<?php

namespace Omnipay\PayOp\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface 
{
    public function isSuccessful() 
    {
        return false;
    }

    public function isRedirect() 
    {
        return $this->data->payment->issuer_auth_url != '';
    }

    public function isPending() 
    {
        return $this->data->payment->action == 'pending';
    }

    public function getRedirectUrl() 
    {
        return  ( string ) $this->data->payment->issuer_auth_url;
    }

    public function getRedirectMethod() 
    {
        return 'GET';
    }

    public function getRedirectData() 
    {
        return null;
    }

    public function getTransactionId()
    {
        if ( isset( $this->data->payment ) && isset( $this->data->payment->transaction_id ) ) {
            return ( string ) $this->data->payment->transaction_id;
        }
        return false;
    }
}
