<?php

class CashOnDelivery extends PaymentMethod {
    public function processTransaction() {
 
        echo "Processing cash on delivery payment of $$this->amount<br>";
    }
}