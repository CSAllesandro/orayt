<?php
class BikeDelivery extends DeliveryMode {
    public function processDelivery() {
        echo "Delivering by bike in $this->delivery_time minutes.<br>";
    }
}