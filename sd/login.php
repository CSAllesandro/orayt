<?php
session_start();
include_once('config/Database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $database = new Database();
    $db = $database->getConnection();

   
    $query = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $db->prepare($query);

    
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    
    if ($stmt->execute()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

      
        if ($user && password_verify($password, $user['password'])) {
          
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
           
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Error: " . $stmt->errorInfo()[2]; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<h1>Login</h1>

<?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

<form action="login.php" method="POST">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
    </div>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="registration.php">Register here</a></p>

</body>
</html>
