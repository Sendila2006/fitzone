<?php
include('dbconnect.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<h2 class='text-center mt-5'>You must log in to add a membership plan.</h2>";
    echo "<div class='text-center'><a href='login.php' class='btn btn-primary mt-3'>Login</a></div>";
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $benefits = $_POST['benefits'];

    $sql = "INSERT INTO membership (full_name, plan_name, price, benefits) VALUES ('$full_name', '$plan_name', '$price', '$benefits')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Membership plan added successfully!'); window.location='membership.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile responsiveness -->
    <title>Add Membership Plan | FitZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/gym/pic/addm.jpg');
            background-size: cover;
            background-position: center;
        }
        .navbar {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-title {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #343a40;
            color: #ffffff;
        }

        @media screen and (max-width: 576px) {
            .form-container {
                padding: 20px;
                margin-top: 30px;
            }
            .form-title {
                font-size: 1.5rem;
            }
            footer {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">
            <img src="/gym/pic/logo.png" alt="FitZone Logo" width="40" height="40" class="d-inline-block align-text-top"><font style="bold">
            FitZone </font>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="appointment.php">Appointment</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-10 col-12">
            <div class="form-container">
                <h2 class="form-title">Add Membership Plan</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Select a Plan</label>
                        <select class="form-select" id="planSelector" onchange="fillPlanDetails()">
                            <option value="">-- Choose a Plan --</option>
                            <option value="Basic Plan|3000|Access to gym facilities, Locker room access, Free water bottle">Basic Plan</option>
                            <option value="Standard Plan|6000|Access to gym facilities, Locker room access, One personal training session per month, Free protein shake">Standard Plan</option>
                            <option value="Premium Plan|10000|Unlimited access to gym facilities, Locker room access, Weekly personal training session, Free nutrition consultation, Access to group fitness classes">Premium Plan</option>
                            <option value="VIP Plan|15000|24/7 gym access, Locker room with private shower, Unlimited personal training sessions, Monthly diet plan by a nutritionist, Complimentary fitness gear">VIP Plan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Plan Name</label>
                        <input type="text" class="form-control" name="plan_name" id="plan_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price (LKR)</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Benefits</label>
                        <textarea class="form-control" name="benefits" id="benefits" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Add Membership</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function fillPlanDetails() {
        let planSelector = document.getElementById("planSelector");
        let selectedOption = planSelector.value.split("|");

        if (selectedOption.length === 3) {
            document.getElementById("plan_name").value = selectedOption[0];
            document.getElementById("price").value = selectedOption[1];
            document.getElementById("benefits").value = selectedOption[2];
        }
    }
</script>

<br><br><br>
<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row text-center text-md-start">
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
                    <li><a href="tel:+123456789" class="text-white">0722 287 997</a></li>
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
