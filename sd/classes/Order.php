
<?php

include_once 'PaymentMethod.php';
include_once 'MenuItem.php';



class Order {
    private $customerName;
    private $deliveryAddress;
    private $paymentMethod;
    private $deliveryMethod;
    private $menuItems = [];
    private $totalAmount = 0;

    public function __construct($customerName, $deliveryAddress, $paymentMethod, $deliveryMethod) {
        $this->customerName = $customerName;
        $this->deliveryAddress = $deliveryAddress;
        $this->paymentMethod = $paymentMethod;
        $this->deliveryMethod = $deliveryMethod;
    }

    public function addMenuItem($menuItem, $quantity) {
        $this->menuItems[] = ['menuItem' => $menuItem, 'quantity' => $quantity];
        $this->totalAmount += $menuItem->getPrice() * $quantity;
    }

    public function saveOrder($conn) {
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, delivery_address, total_amount) VALUES (?, ?, ?)");
        $stmt->execute([$this->customerName, $this->deliveryAddress, $this->totalAmount]);
        $orderId = $conn->lastInsertId();
        
        foreach ($this->menuItems as $item) {
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$orderId, $item['menuItem']->getId(), $item['quantity']]);
        }

        echo "Order saved with ID: " . $orderId . "<br>";
    }

    public function processPayment() {
        $this->paymentMethod->processTransaction();
    }

    public function processDelivery() {
        $this->deliveryMethod->deliver();
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }
}
