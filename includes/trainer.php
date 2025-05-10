<?php
include('dbconnect.php');

if (isset($_POST['add_trainer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $availability = $_POST['availability'];

    $sql = "INSERT INTO trainers (name, email, phone, specialization, experience, availability) 
            VALUES ('$name', '$email', '$phone', '$specialization', '$experience', '$availability')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Trainer added successfully!');
                window.location.href = 'viewtrainer.php';
              </script>";
        exit();
    } else {
        echo "<p class='message error'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trainers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/gym/pic/addtr.jpeg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .navbar {
            margin-bottom: 30px;
        }
        .container {
            max-width: 800px;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h4 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .navbar-nav .nav-link {
            font-size: 16px;
        }
        .error {
            color: red;
            font-size: 14px;
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="viewtrainer.php">View Trainers</a></li>
                <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                <li class="nav-item"><a class="nav-link" href="viewappointment.php">Appointment</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <div class="form-container">
        <h4>Add a New Trainer</h4>
        
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Trainer Name:</label>
                <input type="text" name="name" required class="form-control" placeholder="Enter trainer's name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" required class="form-control" placeholder="Enter trainer's email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="tel" name="phone" required class="form-control" placeholder="Enter trainer's phone number">
            </div>

            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization:</label>
                <input type="text" name="specialization" required class="form-control" placeholder="Enter trainer's specialization">
            </div>

            <div class="mb-3">
                <label for="experience" class="form-label">Experience (years):</label>
                <input type="number" name="experience" required class="form-control" placeholder="Enter years of experience">
            </div>

            <div class="mb-3">
                <label for="availability" class="form-label">Availability:</label>
                <select name="availability" required class="form-control">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <button type="submit" name="add_trainer" class="btn btn-custom">Add Trainer</button>
        </form>
    </div>
</div>

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
