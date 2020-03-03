<?php

namespace Omnipay\PayOp\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends BaseAbstractResponse {

    public function __construct( RequestInterface $request, $data ) 
    {
        parent::__construct( $request, $data );
        if ( isset( $this->data->error ) ) {
            $this->code = ( string ) $this->data->error->code;
            $this->data = ( string ) $this->data->error->message;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage() 
    {
        return $this->isSuccessful() ? null : $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->isSuccessful() ? null : $this->code;
    }

}
