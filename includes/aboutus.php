<?php
session_start();
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no"> <!-- Mobile Friendly -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#000000">
    <meta name="format-detection" content="telephone=no"> <!-- Prevents iOS from formatting phone numbers -->

    <title>About Us</title>
    <link rel="icon" href="/gym/pic/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('/gym/pic/about.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding-bottom: 100px;
        }

        /* Navbar Style */ 
        .navbar {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }

        .navbar-nav .nav-link {
            color: white;
        }

        .navbar-nav .nav-link:hover {
            color: #f0f0f0;
        }

        /* About Us section style */
        .about-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            text-align: center;
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .about-container h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .about-container p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .team-section {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .team-member {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 250px;
            margin: 20px;
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .team-member h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .team-member p {
            font-size: 1rem;
            color: #777;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
            margin-top: 50px;
        }

        footer a {
            color: #f0f0f0;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .team-section {
                flex-direction: column;
                align-items: center;
            }

            .team-member {
                width: 80%;
                margin-bottom: 30px;
            }

            .about-container {
                padding: 30px 20px;
            }

            .about-container h2 {
                font-size: 2rem;
            }

            .about-container p {
                font-size: 1rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }
        }

    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid"><a class="navbar-brand" href="../index.php">
            <img src="/gym/pic/logo.png" alt="FitZone Logo" width="40" height="40" class="d-inline-block align-text-top"><font style="bold">
            FitZone </font>
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="appointment.php">Appointment</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Us Section -->
    <div class="about-container">
        <h2>About FitZone</h2>
        <p>FitZone is a premier fitness center that is dedicated to providing personalized training and expert guidance
            to help you reach your fitness goals. Whether you are looking to lose weight, build strength, or improve your
            overall health, we are here to support you every step of the way.</p>

        <p>Maintaining a healthy lifestyle has become crucial in today’s fast-paced world. Fitness centers play a significant 
            role in promoting physical and mental well-being. 
            FitZone Fitness Center, a newly established gym in Kurunegala, 
            aims to enhance its services by launching an interactive web application. </p>
    </div>

    <!-- Team Section -->
    <div class="team-section">
        <div class="team-member">
            <img src="/gym/pic/ct.png" alt="Trainer 1">
            <font color="black"><h4>Sunith Abewardhana</h4></font>
            <p>Certified Personal Trainer</p>
        </div>
        <div class="team-member">
            <img src="/gym/pic/yoga_tr.jpg" alt="Trainer 2">
            <font color="black"><h4>Hansika Jayawardana</h4></font>
            <p>Yoga Instructor</p>
        </div>
        <div class="team-member">
            <img src="/gym/pic/cardio_tr.png" alt="Trainer 3">
            <font color="black"><h4>Rohitha Fernando</h4></font>
            <p>Cardio Specialist</p>
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
