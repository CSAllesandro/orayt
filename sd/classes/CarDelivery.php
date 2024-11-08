<?php

class CarDelivery extends DeliveryMode {
    public function processDelivery() {
        echo "Delivering by car in $this->delivery_time minutes.<br>";
    }
}