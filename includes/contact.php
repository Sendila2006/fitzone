<?php
session_start();

$host = "localhost";
$username = "root";
$password = ""; 
$database = "gym"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check login status
$loggedIn = isset($_SESSION['user_id']);

// Handle form submission only if logged in
if ($_SERVER["REQUEST_METHOD"] == "POST" && $loggedIn) {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $subject = $conn->real_escape_string($_POST["subject"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $query = "INSERT INTO queries (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Message sent and saved successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | FitZone</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        nav {
            background-color: #343a40;
        }

        nav a {
            color: white;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .contact-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .contact-container h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .contact-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .contact-container input,
        .contact-container textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .contact-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 50px;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .contact-container {
                padding: 30px;
            }

            .contact-container h2 {
                font-size: 1.8rem;
            }

            .contact-container input,
            .contact-container textarea,
            .contact-container button {
                padding: 10px;
            }
        }
    </style>
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="/gym/pic/logo.png" alt="FitZone Logo" width="40" height="40" class="d-inline-block align-text-top">
                FitZone
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.php">Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>


<!-- Contact Form -->
<div class="container">
    <div class="contact-container">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you! Please fill out the form below, and we will get back to you as soon as possible.</p>

        <form action="contact.php" method="post" onsubmit="<?php echo $loggedIn ? '' : 'alert(\'Please log in first!\'); return false;'; ?>">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required <?php echo $loggedIn ? '' : 'disabled'; ?>>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required <?php echo $loggedIn ? '' : 'disabled'; ?>>
            </div>
            <div class="mb-3">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" required <?php echo $loggedIn ? '' : 'disabled'; ?>>
            </div>
            <div class="mb-3">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" class="form-control" required <?php echo $loggedIn ? '' : 'disabled'; ?>></textarea>
            </div>
            <button type="submit" class="btn btn-success"><?php echo $loggedIn ? 'Send Message' : 'Login to Send Message'; ?></button>
        </form>
    </div>
</div>

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
