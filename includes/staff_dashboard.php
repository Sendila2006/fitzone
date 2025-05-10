<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php"); // Redirect to login if not authenticated
    exit();
}

$staff_name = $_SESSION['username']; // Get the logged-in staff member's name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.x/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #e9ecef;
            color: #333;
        }
        .dashboard-container {
            padding: 60px 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #5a6268;
        }
        .welcome-text {
            font-size: 1.2rem;
            color: #007bff;
            margin-top: -10px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-icon {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .card h5 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 20px;
        }
        .card a {
            font-size: 1.1rem;
            padding: 12px 20px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .card a:hover {
            background-color: #0056b3;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
            padding: 12px 30px;
            font-size: 1.2rem;
            border-radius: 10px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container dashboard-container">
    <div class="dashboard-header">

        <h1 class="welcome-text">Welcome to Dashboard,<br> <strong><?php echo htmlspecialchars($staff_name); ?></strong>!</h1>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="fa-solid fa-users card-icon"></i>
                <h5>Manage Memberships</h5>
                <a href="manage_membership.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="fa-solid fa-calendar-check card-icon"></i>
                <h5>Manage Appointments</h5>
                <a href="manage_appointments.php" class="btn btn-success">Go</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="fa-solid fa-envelope card-icon"></i>
                <h5>Manage Queries</h5>
                <a href="manage_query.php" class="btn btn-info">Go</a>
            </div>
        </div>
    </div>

    <div class="footer mt-5">
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
