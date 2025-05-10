<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment | FitZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/gym/pic/cancela.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background-color: rgb(5, 63, 152);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff !important;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            color: #d1e7ff !important;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
            margin-bottom: 50px;
        }

        h2 {
            color: #0d6efd;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0a58ca;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin-top: 40px;
            }

            h2 {
                font-size: 1.5rem;
                text-align: center;
            }

            .navbar-brand img {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="/gym/pic/logo.png" alt="FitZone Logo" width="40" height="40" class="d-inline-block align-text-top">
            FitZone
        </a>
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon bg-light rounded"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="viewappointment.php">View Appointment</a></li>
                <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="form-container">
                <h2 class="text-center">Cancel Appointment</h2>
                <form id="cancelForm" method="GET" action="" onsubmit="confirmCancellation(event)">
                    <div class="mb-3">
                        <label for="appointment_id" class="form-label">Appointment ID:</label>
                        <input type="number" id="appointment_id" name="appointment_id" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Cancel Appointment</button>
                    <div class="text-center">
                        <a href="viewappointment.php" class="btn btn-primary mt-3">View Appointments</a>
                    </div>
                </form>
                <?php
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'gym';

                $conn = new mysqli($host, $username, $password, $database);

                if ($conn->connect_error) {
                    die('<p style="color: red;">Connection failed: ' . $conn->connect_error . '</p>');
                }

                if (isset($_GET['appointment_id'])) {
                    $appointment_id = intval($_GET['appointment_id']);

                    $check_query = "SELECT * FROM appointments WHERE appointment_id = $appointment_id";
                    $result = $conn->query($check_query);

                    if ($result->num_rows > 0) {
                        $sql = "UPDATE appointments SET status = 'cancelled' WHERE appointment_id = $appointment_id";
                        if ($conn->query($sql) === TRUE) {
                            echo '<center><p style="color: green;">Appointment cancelled successfully.</p></center>';
                        } else {
                            echo '<center><p style="color: red;">Error cancelling appointment: ' . $conn->error . '</p></center>';
                        }
                    } else {
                        echo '<p style="color: red;">Appointment ID not found.</p>';
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmCancellation(event) {
        event.preventDefault();
        const appointmentId = document.getElementById('appointment_id').value;
        if (confirm('Are you sure you want to cancel this appointment?')) {
            document.getElementById('cancelForm').submit();
        }
    }
</script>

<footer class="bg-dark text-white py-4 mt-auto">
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
                    <li>No.20, FitZone Ave, Kurunegala, Sri Lanka</li>
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
