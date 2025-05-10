<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Training | FitZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body and Background */
        body {
            background: url('/gym/pic/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Arial', sans-serif;
            padding-top: 50px; /* To avoid overlap with fixed navbar */
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #2c3e50; /* Dark background for navbar */
        }

        .navbar-nav .nav-link {
            color: #ecf0f1 !important; /* Light color for links */
            font-size: 1.1rem;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #f39c12 !important; /* Hover effect for links */
        }

        .navbar-brand {
            color: #f39c12 !important; /* Golden color for brand */
            font-weight: bold;
            font-size: 1.6rem;
            margin-left: 20px;
        }

        /* Container */
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 40px;
            margin-top: 80px; /* To avoid overlap with navbar */
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #f39c12;
        }

        h3 {
            font-size: 2rem;
            margin-top: 20px;
            color: #f39c12;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #ecf0f1;
        }

        ul {
            font-size: 1.1rem;
            color: #ecf0f1;
        }

        /* Card Design */
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .card img {
            height: 250px;
            object-fit: cover;
        }

        .card:hover {
            transform: scale(1.05);
            cursor: pointer;
        }

        .card-body {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            color: #ecf0f1;
            text-align: center;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #f39c12;
        }

        .card-text {
            font-size: 1.1rem;
            color: #bdc3c7;
        }

        /* Button Style */
        .btn-primary {
            background-color: #27ae60;
            border-color: #27ae60;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        /* Footer Style */
        footer {
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FitZone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="yoga.php">Yoga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cardio.php">Cardio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="mb-4">Personal Training</h1>
        <p>Our personal training programs are tailored to help you achieve your fitness goals with professional
            guidance. Whether you’re a beginner or an advanced athlete, our trainers will create a plan that suits
            your needs.</p>

        <h3>Benefits of Personal Training</h3>
        <ul>
            <li>Customized Workout Plans</li>
            <li>Motivation and Accountability</li>
            <li>Professional Guidance</li>
            <li>Nutrition and Diet Tips</li>
        </ul>

        <h3>Meet Our Trainers</h3>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="/gym/pic/trainer.jpeg" class="card-img-top" alt="Trainer 1">
                    <div class="card-body">
                        <h5 class="card-title">Sunith Abewardhana</h5>
                        <p class="card-text">Certified Personal Trainer | Strength Training Specialist</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="/gym/pic/trainer2.jpg" class="card-img-top" alt="Trainer 2">
                    <div class="card-body">
                        <h5 class="card-title">Rohitha Fernando</h5>
                        <p class="card-text">Certified Fitness Coach | Weight Loss Expert</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="appointment.php" class="btn btn-primary">Book a Session</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 FitZone. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
