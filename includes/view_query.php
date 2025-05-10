<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php");
    exit();
}

include 'dbconnect.php';

if (isset($_GET['id'])) {
    $query_id = $_GET['id'];
    
    $query = "SELECT * FROM queries WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $query_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $query_data = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }
        .dashboard-container {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }
        .dashboard-header h1 {
            font-size: 2rem;
            color: #343a40;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
            font-size: 0.9rem;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .query-details {
            padding: 20px;
            border-radius: 5px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
        }
        .query-details p {
            font-size: 1.1rem;
            color: #495057;
        }
        .query-details strong {
            font-weight: bold;
            color: #343a40;
        }
        .btn-primary {
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Query Details</h1>
                <a href="staff_dashboard.php" class="btn btn-back">Back to Dashboard</a>
            </div>
            <div class="query-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($query_data['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($query_data['email']); ?></p>
                <p><strong>Subject:</strong> <?php echo htmlspecialchars($query_data['subject']); ?></p>
                <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($query_data['message'])); ?></p>
                <p><strong>Submitted At:</strong> <?php echo htmlspecialchars($query_data['submitted_at']); ?></p>
            </div>
            <a href="manage_query.php" class="btn btn-primary">Back to Manage Queries</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
