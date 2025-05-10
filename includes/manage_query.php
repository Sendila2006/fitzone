<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php");
    exit();
}

include 'dbconnect.php'; // Database connection

// Delete query based on ID
if (isset($_GET['delete_id'])) {
    $query_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM queries WHERE id = $query_id"; // Corrected variable name

    if ($conn->query($delete_query)) {
        echo "<script>alert('Query deleted successfully.'); window.location='manage_query.php';</script>";
    } else {
        echo "<script>alert('Error deleting query.');</script>";
    }
}

// Fetch all queries
$query = "SELECT * FROM queries ORDER BY submitted_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Queries</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/gym/pic/kal.jpg');
            background-size: cover;
        }
        .container {
            margin-top: 50px;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-back {
            font-size: 1.1rem;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .btn-view, .btn-delete {
            font-size: 0.9rem;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Queries</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['subject']}</td>
                                <td>{$row['message']}</td>
                                <td>{$row['submitted_at']}</td>
                                <td>
                                    <a href='view_query.php?id={$row['id']}' class='btn btn-sm btn-primary'>View</a>
                                    <br>
                                    <br>
                                    <a href='manage_query.php?delete_id={$row['id']}' class='btn btn-sm btn-delete' onclick='return confirm(\"Are you sure you want to delete this query?\");'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No queries found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <center><a href="staff_dashboard.php" class="btn btn-back">Back to Dashboard</a></center>
    </div>
<br>
<br>
<br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
