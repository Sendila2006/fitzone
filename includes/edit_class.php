<?php
include('dbconnect.php'); // Include your database connection file
session_start(); // Start session to manage messages

// Check if class ID is provided
if (!isset($_GET['id'])) {
    $_SESSION['message'] = 'Class ID is missing!';
    $_SESSION['message_type'] = 'danger';
    header('Location: manage_classes.php');
    exit();
}

$class_id = $_GET['id'];

// Fetch class data to edit
$fetch_sql = "SELECT * FROM class_schedule WHERE id = '$class_id'";
$result = mysqli_query($conn, $fetch_sql);

if ($result && mysqli_num_rows($result) > 0) {
    $class_data = mysqli_fetch_assoc($result);
} else {
    $_SESSION['message'] = 'Class not found!';
    $_SESSION['message_type'] = 'danger';
    header('Location: manage_classes.php');
    exit();
}

// Update Class
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_name = $_POST['class_name'];
    $instructor_name = $_POST['instructor_name'];
    $class_time = $_POST['class_time'];

    $update_sql = "UPDATE class_schedule SET 
        class_name = '$class_name', 
        instructor_name = '$instructor_name', 
        class_time = '$class_time' 
        WHERE id = '$class_id'";

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['message'] = 'Class updated successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . mysqli_error($conn);
        $_SESSION['message_type'] = 'danger';
    }

    header('Location: manage_classes.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('/gym/pic/mclass.jpg');
            background-size: cover;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 700px;
            margin-top: 50px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 35px;
            color: #e9ecef;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background-color: #343a40;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-size: 1.5rem;
            text-align: center;
            padding: 20px 0;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .btn-custom {
            background-color: #1d72b8;
            color: #fff;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 5px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #155a8a;
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Class
            </div>
            <div class="card-body">
                <h2 class="form-title">Update Class Details</h2>

                <!-- Edit Form -->
                <form method="POST">
                    <div class="mb-3">
                        <label for="class_name" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="class_name" name="class_name" value="<?= $class_data['class_name'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="instructor_name" class="form-label">Instructor Name</label>
                        <input type="text" class="form-control" id="instructor_name" name="instructor_name" value="<?= $class_data['instructor_name'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="class_time" class="form-label">Class Time</label>
                        <input type="datetime-local" class="form-control" id="class_time" name="class_time" value="<?= date('Y-m-d\TH:i', strtotime($class_data['class_time'])) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-custom">Update Class</button>
                    <a href="manage_classes.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
