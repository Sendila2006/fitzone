<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | FitZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        /* Navbar Styling */
        nav {
            background-color: #343a40;
        }

        nav a {
            color: white;
        }

        nav a:hover {
            color: #f0f0f0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }

        /* Hero Section */
        .hero {
            background: url('https://via.placeholder.com/1920x600') no-repeat center center;
            background-size: cover;
            color: black;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero button {
            padding: 12px 25px;
            font-size: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .hero button:hover {
            background-color: #45a049;
        }

        /* Services Section */
        .services {
            margin-top: 50px;
        }

        .service-card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .service-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service-card-body {
            padding: 20px;
            background-color: white;
        }

        .service-card-body h5 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .service-card-body p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .service-card-body a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .service-card-body a:hover {
            text-decoration: underline;
        }

        /* Footer Styling */
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 50px;
        }

        footer a {
            color: #f0f0f0;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .service-card {
                margin-bottom: 20px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Our Premium Fitness Services</h1>
            <p>At FitZone, we offer top-tier fitness services designed to help you reach your health goals. Explore our services and find what works best for you!</p>
            <button onclick="document.getElementById('services').scrollIntoView({ behavior: 'smooth' })">Explore Services</button>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services container">
        <div class="row">
            <div class="col-md-4">
                <div class="service-card">
                    <img src="/gym/pic/personal_tr.jpeg" alt="Personal Training">
                    <div class="service-card-body">
                        <h5>Personal Training</h5>
                        <p>Our certified trainers will guide you through a tailored workout plan that fits your fitness level and goals.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <img src="/gym/pic/group_tr.jpg" alt="Group Classes">
                    <div class="service-card-body">
                        <h5>Group Classes</h5>
                        <p>Join our energetic group fitness classes that include Yoga, Pilates, Zumba, and more to keep you motivated.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <img src="/gym/pic/nutrition.jpg" alt="Nutrition Advice">
                    <div class="service-card-body">
                        <h5>Nutrition Advice</h5>
                        <p>Get personalized nutrition plans to help fuel your body for optimal performance and recovery.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row text-center">
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
            <p class="mb-0">&copy; 2025 FitZone. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
