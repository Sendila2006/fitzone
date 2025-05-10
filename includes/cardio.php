<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardio Workouts | FitZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/gym/pic/cardio-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Arial', sans-serif;
            padding-top: 70px; /* for navbar spacing */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #2c3e50;
        }

        .navbar-nav .nav-link {
            color: #ecf0f1 !important;
            font-size: 1.1rem;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #f39c12 !important;
        }

        .navbar-brand {
            color: #f39c12 !important;
            font-weight: bold;
            font-size: 1.6rem;
            margin-left: 20px;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 40px;
            margin-top: 20px;
            margin-bottom: 40px;
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

        p, ul {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #ecf0f1;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .card img {
            height: 250px;
            object-fit: cover;
            width: 100%;
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

        footer {
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
                text-align: center;
            }

            h3 {
                font-size: 1.5rem;
                text-align: center;
            }

            p, ul {
                font-size: 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .btn-primary {
                width: 100%;
                font-size: 1rem;
                padding: 12px 20px;
            }

            .container {
                padding: 20px;
            }

            .card img {
                height: 200px;
            }
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
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="personal_tr.php">Personal Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="yoga.php">Yoga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
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
        <h1 class="mb-4">Cardio Workouts</h1>
        <p>Our cardio workouts are designed to boost your heart health, increase stamina, and help with weight loss. Whether you prefer high-intensity interval training (HIIT) or steady-state cardio, we have a program for you!</p>

        <h3>Benefits of Cardio Workouts</h3>
        <ul>
            <li>Improved Heart Health</li>
            <li>Weight Loss and Fat Burning</li>
            <li>Increased Energy Levels</li>
            <li>Boosted Mood and Mental Health</li>
        </ul>

        <h3>Our Cardio Programs</h3>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="/gym/pic/cardio1.jpg" class="card-img-top" alt="Cardio Program 1">
                    <div class="card-body">
                        <h5 class="card-title">High-Intensity Interval Training (HIIT)</h5>
                        <p class="card-text">Burn more calories in less time with our HIIT cardio sessions!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="/gym/pic/cardio.jpg" class="card-img-top" alt="Cardio Program 2">
                    <div class="card-body">
                        <h5 class="card-title">Steady-State Cardio</h5>
                        <p class="card-text">A more moderate and consistent approach to cardiovascular health.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
