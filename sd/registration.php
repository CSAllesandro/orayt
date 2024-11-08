<?php
session_start();
include_once('config/Database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

   
    if ($password != $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $database = new Database();
        $db = $database->getConnection();

       
        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $db->prepare($query);

      
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful. You can now log in.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->errorInfo()[2];  
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="assets/css/registration.css">
</head>
<body>

<h1>User Registration</h1>

<?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

<form action="registration.php" method="POST">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
    </div>

    <button type="submit">Register</button>

    <p class="account-link">Already have an account? <a href="login.php">Login here</a></p> 
</form>

</body>
</html>
