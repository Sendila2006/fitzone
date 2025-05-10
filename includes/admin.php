<?php
session_start();


require_once 'dbconnect.php';


if (isset($_SESSION['username']) && ($_SESSION['role'] == 'admin')) {
    echo "<script>alert('You are already logged in. Redirecting to homepage...');</script>";
    header("Location: admin_dashboard.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $sql = "SELECT * FROM users WHERE username = ? AND role IN ('admin')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


        if (password_verify($password, $row['pwd'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            // Show a JavaScript popup message
            echo "<script>alert('You have successfully logged in as a Admin!');</script>";

            // Redirect to index.php after a short delay
            echo "<script>setTimeout(function(){ window.location.href = 'admin_dashboard.php'; }, 1000);</script>";
            exit();
        } else {
            $error_message = "Invalid password. Please try again.";
            echo "Error: " . $error_message; // Debugging password mismatch
        }
    } else {
        $error_message = "User not found or access denied.";
        echo "Error: " . $error_message; // Debugging user not found
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Staff Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('/gym/pic/adst.png');
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .login-container {
            max-width: 450px;
            margin: 100px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }
        .form-control {
            border-radius: 10px;
            box-shadow: none;
            font-size: 16px;
            padding: 12px;
            color: black;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
        }
        .btn:hover {
            background-color: #218838;
        }
        label {
            color: #333;
        }
        .alert {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #aaa;
        }
        footer a {
            color: #fff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

        /* Style for Customer Text */
        p {
            text-align: center;
            font-size: 16px;
            color: rgb(0, 0, 0); /* Color of the "Customer?" text */
        }

        a {
            color: #007bff; /* Color of the link text */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Mobile responsiveness */
        @media (max-width: 576px) {
            .login-container {
                margin: 30px 20px;
                padding: 25px;
            }

            .login-container h2 {
                font-size: 22px;
            }

            .form-control {
                font-size: 15px;
                padding: 10px;
            }

            .btn {
                font-size: 16px;
                padding: 10px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="admin.php">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <br>
        <br>
        
        <center><a href="../index.php">Back To Home</a></center>
        <p>Customer? <a href="login.php">Login here</a></p>
        <p>Staff? <a href="staff.php">Login here</a></p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
