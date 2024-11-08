<?php

class CreditCard extends PaymentMethod {
    private $card_number;
    private $expiry_date;

    public function __construct($amount, $card_number, $expiry_date) {
        parent::__construct($amount);
        $this->card_number = $card_number;
        $this->expiry_date = $expiry_date;
    }

    public function processTransaction() {

        echo "Processing credit card payment of $$this->amount<br>";
        echo "Card number: $this->card_number, Expiry: $this->expiry_date<br>";
    }
}