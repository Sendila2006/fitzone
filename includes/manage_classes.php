<?php
include('dbconnect.php'); // Include your database connection file

// Start the session to store success/error messages
session_start();

// Delete Class
if (isset($_GET['delete'])) {
    $class_id = $_GET['delete'];

    $delete_sql = "DELETE FROM class_schedule WHERE id = '$class_id'";

    if (mysqli_query($conn, $delete_sql)) {
        $_SESSION['message'] = 'Class deleted successfully!';
        $_SESSION['message_type'] = 'success'; // Success message
    } else {
        $_SESSION['message'] = 'Error: ' . mysqli_error($conn);
        $_SESSION['message_type'] = 'danger'; // Error message
    }

    // Redirect back to the page to display the message
    header('Location: manage_classes.php');
    exit();
}

// Fetch classes
$sql = "SELECT * FROM class_schedule";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #212529;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 35px;
            color: #e9ecef;
        }

        .table {
            background-color: #343a40;
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            text-align: center;
            padding: 15px;
        }

        .table th {
            background-color: #007bff;
            font-weight: 600;
        }

        .table tbody tr {
            background-color: #495057;
        }

        .table tbody tr:hover {
            background-color: #1d72b8;
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

        .alert {
            margin-top: 20px;
            border-radius: 10px;
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

        .btn-group {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Manage Classes
            </div>
            <div class="card-body">
                <h2 class="form-title">Class Schedule</h2>

                <!-- Display success or error message -->
                <?php
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    $message_type = $_SESSION['message_type'];
                    echo "<div class='alert alert-$message_type' role='alert'>$message</div>";

                    // Clear the message after displaying
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
                ?>

                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Class Name</th>
                                <th>Instructor Name</th>
                                <th>Class Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['class_name']; ?></td>
                                    <td><?php echo $row['instructor_name']; ?></td>
                                    <td><?php echo date('F d, Y h:i A', strtotime($row['class_time'])); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit_class.php?id=<?php echo $row['id']; ?>" class="btn btn-custom">Edit</a>
                                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-custom">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No classes available to display.</p>
                <?php } ?>

                <center> <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a> </center>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
