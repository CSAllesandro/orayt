<?php


abstract class DeliveryMode {
    protected $delivery_time;

    public function __construct($delivery_time) {
        $this->delivery_time = $delivery_time;
    }

    abstract public function processDelivery();
}