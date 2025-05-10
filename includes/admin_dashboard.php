<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin.php"); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Mobile responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
        }

        .dashboard-container {
            margin: 50px auto;
            max-width: 800px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-dashboard {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            margin-bottom: 15px;
        }

        @media (max-width: 576px) {
            .dashboard-container {
                margin: 20px;
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .btn-dashboard {
                padding: 12px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="dashboard-container text-center">
                <h1>Admin Dashboard</h1>
                <hr>
                <a href="manage_admin_user.php" class="btn btn-primary btn-dashboard">Manage Users Accounts</a><br><br>
                <a href="manage_admin_trainer.php" class="btn btn-success btn-dashboard">Manage Trainers</a><br><br>
                <a href="manage_admin_class.php" class="btn btn-info btn-dashboard">Manage Class Schedule</a><br><br>
                <a href="logout.php" class="btn btn-danger btn-dashboard">Logout</a><br><br>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
