<?php

namespace Omnipay\PayOp\Message;

class CompletePurchaseResponse extends PurchaseResponse
{
	public function isSuccessful ()
	{
		return ( $this->getStatus() == '200' );
	}

	public function getMessage ()
	{
		$status = $this->getStatus();
		if ( ! is_null( $status ) ) {
			return $status;
		}
		return ( !is_null( $this->code ) ) ? $this->data : null;
	}

	public function getStatus ()
	{
		return ( isset( $this->data->transaction->status ) ) ? ( string ) $this->data->transaction->status : null;
	}

	public function getTransactionId ()
	{
		return ( isset( $this->data->transaction->transaction_id ) ) ? ( string ) $this->data->transaction->transaction_id : false;
	}
}
