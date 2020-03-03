<?php

namespace Omnipay\PayOp\Message;

use Omnipay\Common\PaymentMethod;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;

/**
 * FetchPaymentMethodsResponse class - it should contain a list of fetched PaymentMethods.
 *
 * @author Martin Schipper martin@cardgate.com
 */
class FetchPaymentMethodsResponse extends BaseAbstractResponse implements FetchPaymentMethodsResponseInterface 
{
    
    public function isSuccessful() 
    {
        return isset( $this->data->billing_options );
    }

    public function getPaymentMethods() 
    {
        $methods = array();
        if ( isset( $this->data->billing_options ) ) {
            foreach ( $this->data->billing_options->billing_option as $billing_option ) {
                $methods[] = new PaymentMethod( ( string ) $billing_option->id, ( string ) $billing_option->name );
            }
        }
        return $methods;
    }
    
}
