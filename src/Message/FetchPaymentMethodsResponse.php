<?php

namespace Omnipay\PayOp\Message;

use Omnipay\Common\PaymentMethod;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;

class FetchPaymentMethodsResponse extends BaseAbstractResponse implements FetchPaymentMethodsResponseInterface 
{
    
    public function isSuccessful() 
    {
        return $this->data['status'] == 1;
    }

    public function getPaymentMethods() 
    {
        $methods = array();
 
        if ( isset( $this->data )  ) {
            foreach ( $this->data['data'] as $billing_option ) {
                $methods[] = new PaymentMethod( ( string ) $billing_option['identifier'], ( string ) $billing_option['title'] );
            }
        }
        return $methods;
    }
    
}
