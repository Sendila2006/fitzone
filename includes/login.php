<?php 
session_start();
include('dbconnect.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('/gym/pic/login.jpeg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 3px;
            font-weight: bold;
        }
        input[type="text"], 
        input[type="password"] {
            width: calc(100% - 20px); 
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        p {
            text-align: center;
        }
        a {
            color: #007bff;
        }
    </style>
</head>
<body>


    <form action="" method="POST">
        <h2>Customer Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit" name="log">Login</button>
        <br>
        <br>
        <p>Click here to <a href="register.php">Register</a></p>
        <p>Admin? <a href="admin.php">Login here</a></p>
        <p>Staff? <a href="staff.php">Login here</a></p>
        <p>Click here <a href="../index.php">Back to Home</a></p>
        
    </form>
<br>
<?php
if (isset($_POST["log"])) {
    $usern = $_POST["username"];
    $passw = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE username=? AND role='customer'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usern);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row && password_verify($passw, $row['pwd'])) {
        $_SESSION['user_id'] = $row['user_id']; 
        $_SESSION['username'] = $row['username']; 
        
        echo '<script>
            alert("You have successfully logged in as a Customer!");
            window.location.href = "../index.php";
        </script>';
    } else {
        echo "<p style='color: red; text-align: center;'>Invalid login. Only customers can log in.</p>";
        echo "<p style='color: red; text-align: center;'>Or check your username and password.</p>";
    }
    
    $stmt->close();
}
$conn->close();
?>




 <center>
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>About FitZone</h5>
                <p>Your ultimate destination for fitness, health, and wellness. Join us today and transform your life!</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5><center>Quick Links</center></h5>
                <ul class="list-unstyled"><center>
                    <li><a href="../index.php" class="text-white">Home</a></li>
                    <li><a href="aboutus.php" class="text-white">About</a></li>
                    <li><a href="service.php" class="text-white">Services</a></li>
                    <li><a href="contact.php" class="text-white">Contact</a></li></center>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><a href="mailto:support@fitzone.com" class="text-white">support@fitzone.com</a></li>
                    <li><a href="tel:+123456789" class="text-white">+1 234 567 89</a></li>
                    <li>No.20, FitZone Ave, Kurunagala, Sri Lanka</li>
                </ul>
            </div>
        </div>
        <hr class="border-light">
        <div class="row text-center">
            <div class="col-12">
                <p class="mb-0">&copy; 2025 FitZone. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
