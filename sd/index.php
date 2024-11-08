<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once __DIR__ . '/config/Database.php';
include_once __DIR__ . '/classes/MenuItem.php';
include_once __DIR__ . '/classes/Order.php';
include_once __DIR__ . '/classes/PaymentMethod.php';
include_once __DIR__ . '/classes/CreditCard.php';
include_once __DIR__ . '/classes/CashOnDelivery.php';
include_once __DIR__ . '/classes/DeliveryMode.php';
include_once __DIR__ . '/classes/BikeDelivery.php';
include_once __DIR__ . '/classes/CarDelivery.php';

$database = new Database();
$conn = $database->getConnection();
$menu_items = MenuItem::getMenuItems($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $delivery_address = $_POST['delivery_address'];

    $payment_type = $_POST['payment_type'];
    $payment_method = $payment_type === 'credit_card'
        ? new CreditCard($_POST['total_amount'], $_POST['card_number'], $_POST['expiry_date'])
        : new CashOnDelivery($_POST['total_amount']);

    $delivery_type = $_POST['delivery_type'];
    $delivery_method = $delivery_type === 'bike'
        ? new BikeDelivery(30)
        : new CarDelivery(45);

    $total_amount = $_POST['total_amount'];


    $query = "INSERT INTO orders (customer_name, delivery_address, payment_method, delivery_method, total_amount)
              VALUES (:customer_name, :delivery_address, :payment_method, :delivery_method, :total_amount)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':customer_name', $customer_name);
    $stmt->bindParam(':delivery_address', $delivery_address);
    $stmt->bindParam(':payment_method', $payment_type);
    $stmt->bindParam(':delivery_method', $delivery_type);
    $stmt->bindParam(':total_amount', $total_amount);

    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error placing order!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Delivery</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1> 
    <a href="logout.php" class="logout-button">Logout</a> 

    <h2>Menu</h2>
    <form method="POST">
        <div class="menu-container">
            <?php

            foreach ($menu_items as $item): ?>
                <div class="menu-item">
                    <img src="assets/images/<?= $item->getId() ?>.jpg" alt="<?= $item->getName() ?>"> 
                    <h2><?= $item->getName() ?></h2>
                    <p><?= $item->getDescription() ?></p>
                    <p class="price">$<?= number_format($item->getPrice(), 2) ?></p>
                    <input type="checkbox" name="menu_items[<?= $item->getId() ?>]" value="1"> Add to order
                </div>
            <?php endforeach; ?>
        </div>

     
        <div class="form-container">
            <label for="customer_name">Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="delivery_address">Delivery Address:</label>
            <input type="text" id="delivery_address" name="delivery_address" required>

            <label for="payment_type">Payment Method:</label>
            <select name="payment_type" required>
                <option value="credit_card">Credit Card</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>

            <label for="card_number">Card Number (if Credit Card selected):</label>
            <input type="text" id="card_number" name="card_number">

            <label for="expiry_date">Expiry Date (if Credit Card selected):</label>
            <input type="text" id="expiry_date" name="expiry_date">

            <label for="delivery_type">Delivery Method:</label>
            <select name="delivery_type" required>
                <option value="bike">Bike</option>
                <option value="car">Car</option>
            </select>

            <label for="total_amount">Total Amount:</label>
            <input type="number" name="total_amount" required>

            <input type="submit" value="Place Order">
        </div>
    </form>
</body>
</html>
