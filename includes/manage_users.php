<?php
session_start();
include('dbconnect.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['cancel'])) {
    $userID = trim($_POST['user_id']); // Corrected input name

    // Validate input
    if (empty($userID) || !is_numeric($userID)) {
        echo "<script>alert('Please enter a valid User ID.'); window.location.href='manage_users.php';</script>";
        exit();
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Delete user
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        echo "<script>alert('User removed successfully.'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('No user found for the given ID.'); window.location.href='manage_users.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | FitZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/gym/pic/muser.jpg');
            background-size: cover;
            background-position: center;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }
        .form-title {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-cancel {
            display: block;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
footer a {
    color: #ffffff !important;
    text-decoration: none;
}
footer a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="form-title">Manage Users</h2>
                <form method="POST">
                    <div class="mb-4">
                        <label for="user_id" class="form-label">Enter User ID</label>
                        <input type="number" class="form-control form-control-lg" id="user_id" name="user_id" placeholder="e.g., 12345" required>
                    </div>
                    <button type="submit" name="cancel" class="btn btn-danger btn-lg btn-cancel">Manage User</button>
                    <br>
                    <center> <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashbboard</a> </center>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>

<!-- Footer -->
<footer class="bg-dark text-white py-4">
        <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>About FitZone</h5>
                <p>Your ultimate destination for fitness, health, and wellness. Join us today and transform your life!</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="../index.php" class="text-white">Home</a></li>
                    <li><a href="aboutus.php" class="text-white">About</a></li>
                    <li><a href="service.php" class="text-white">Services</a></li>
                    <li><a href="contact.php" class="text-white">Contact</a></li>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
