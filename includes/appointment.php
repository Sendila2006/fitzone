<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$isLoggedId = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Training Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('/gym/pic/appointment.jpg');
            background-size: cover;
            background-position: center center;
            color: white;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: white;
        }

        .navbar-nav .nav-link:hover {
            color: #f0f0f0;
        }

        .form-container {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container label {
            font-size: 1rem;
            color: #555;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }

        .message {
            font-size: 1.2rem;
            margin-top: 20px;
            text-align: center;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 40px;
        }

        footer a {
            color: #f0f0f0;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .form-container h2 {
                font-size: 1.6rem;
            }

            footer h5 {
                font-size: 1rem;
            }

            footer p,
            footer li {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="/gym/pic/logo.png" alt="FitZone Logo" width="40" height="40" class="d-inline-block align-text-top">
                <strong>FitZone</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="viewappointment.php">View Appointments</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Appointment Form -->
    <div class="container my-5">
        <div class="form-container">
            <?php if ($isLoggedIn): ?>
                <h2>Book a Training Session</h2>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <label for="full_name">Full Name:</label>
                            <input type="text" id="full_name" name="full_name" required>
                        </div>
                        <div class="col-12">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="col-12">
                            <label for="phone">Phone:</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="col-12">
                            <label for="trainer">Select Trainer:</label>
                            <select id="trainer" name="trainer_id" required>
                                <option value="">-- Choose Trainer --</option>
                                <?php
                                    $query = "SELECT trainer_id, name FROM trainers";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['trainer_id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No trainers available</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="session_type">Training Session Type:</label>
                            <select id="session_type" name="session_type" required>
                                <option value="">-- Choose Session Type --</option>
                                <option value="Cardio">Cardio</option>
                                <option value="Strength Training">Strength Training</option>
                                <option value="Yoga">Yoga</option>
                                <option value="HIIT">HIIT</option>
                                <option value="Personal Training">Personal Training</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="date">Session Date:</label>
                            <input type="date" id="date" name="appointment_date" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="time">Session Time:</label>
                            <input type="time" id="time" name="appointment_time" required>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" name="appointment">Submit Session</button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <h2>You must log in to book a training session.</h2>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>

            <?php
            if (isset($_POST['appointment'])) {
                if (!$isLoggedIn) {
                    echo '<script>
                            alert("Please log in to your account to book a training session.");
                            window.location.href = "login.php";
                        </script>';
                } else {
                    $full_name = $_POST['full_name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $trainer_id = $_POST['trainer_id'];
                    $session_type = $_POST['session_type'];
                    $appointment_date = $_POST['appointment_date'];
                    $appointment_time = $_POST['appointment_time'];
                    $status = 'pending';

                    $sql = "INSERT INTO appointments (full_name, email, phone, trainer_id, session_type, appointment_date, appointment_time, status)
                            VALUES ('$full_name', '$email', '$phone', '$trainer_id', '$session_type', '$appointment_date', '$appointment_time', '$status')";

                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("Appointment booked successfully. Now you can view the appointments"); window.location="viewappointment.php";</script>';
                    } else {
                        echo "<p class='message error'>Error: " . $conn->error . "</p>";
                    }
                    $conn->close();
                }
            }
            ?>
        </div>
    </div>
<br>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
