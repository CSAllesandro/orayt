<?php


abstract class PaymentMethod {
    protected $amount;

    public function __construct($amount) {
        $this->amount = $amount;
    }

    abstract public function processTransaction();
}