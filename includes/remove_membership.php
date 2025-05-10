<?php
session_start();
include('dbconnect.php');

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Handle membership removal
if (isset($_POST['delete'])) {
    $membershipId = $_POST['membership_id'];

    // Validate input
    if (!empty($membershipId)) {
        $sql = "DELETE FROM membership WHERE membership_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $membershipId);
        if ($stmt->execute()) {
            $message = "Membership deleted successfully!";
        } else {
            $message = "Error deleting membership.";
        }
    } else {
        $message = "Please enter a valid Membership ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Membership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/gym/pic/remove.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-danger, .btn-primary {
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
        }
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">
            <img src="/gym/pic/logo.png" alt="FitZone Logo" width="40" height="40" class="d-inline-block align-text-top"><font style="bold">
            FitZone </font>
        </a>
    </div>
</nav>

<div class="container">
    <div class="form-container">
        <h3 class="text-center mb-4">Cancel Membership</h3>
        <?php if (isset($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="membership_id" class="form-label">Membership ID</label>
                <input type="number" name="membership_id" class="form-control" placeholder="Enter Membership ID" required>
            </div>
            <center><button type="submit" name="delete" class="btn btn-danger">Remove Membership</button></center>
        </form>
        
        <center> <a href="membership.php" class="btn btn-primary">Back to Membership Plans</a></center>
    </div>
</div>

<footer class="text-center">
    <p>&copy; 2025 FitZone. All Rights Reserved.</p>
</footer>
</body>
</html>