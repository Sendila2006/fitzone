<?php
include('dbconnect.php'); // Include your database connection file
session_start();

// Handle Add Trainer Form Submission
if (isset($_POST['add_trainer'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $experience = (int) $_POST['experience'];
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);

    $checkQuery = "SELECT * FROM trainers WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['message'] = "Trainer with this email already exists.";
        $_SESSION['message_type'] = "warning";
    } else {
        $insertQuery = "INSERT INTO trainers (name, email, phone, specialization, experience, availability) 
                        VALUES ('$name', '$email', '$phone', '$specialization', $experience, '$availability')";

        if (mysqli_query($conn, $insertQuery)) {
            $_SESSION['message'] = "Trainer added successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error adding trainer: " . mysqli_error($conn);
            $_SESSION['message_type'] = "danger";
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle Delete Request
if (isset($_GET['delete'])) {
    $trainer_id = intval($_GET['delete']);

    $deleteQuery = "DELETE FROM trainers WHERE trainer_id = $trainer_id";
    if (mysqli_query($conn, $deleteQuery)) {
        $_SESSION['message'] = "Trainer deleted successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete trainer.";
        $_SESSION['message_type'] = "danger";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch all trainers
$sql = "SELECT * FROM trainers";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trainers</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('/gym/pic/mtrainer.jpg');
            background-size: cover;
            color: #333;
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
            color: #4e73df;
        }

        .table {
            background-color: #ffffff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            text-align: center;
            padding: 15px;
        }

        .table th {
            background-color: #4e73df;
            color: white;
            font-weight: 600;
        }

        .table tbody tr {
            background-color: #f8f9fc;
        }

        .table tbody tr:hover {
            background-color: #4e73df;
            color: white;
        }

        .btn-custom {
            background-color: #4e73df;
            color: #fff;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 5px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #2e59d9;
            transition: background-color 0.3s ease;
        }

        .alert {
            margin-top: 20px;
            border-radius: 10px;
            font-weight: 500;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-header {
            background-color: #4e73df;
            color: #fff;
            font-size: 1.5rem;
            text-align: center;
            padding: 20px 0;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-container {
            background-color: #f8f9fc;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #4e73df;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.4);
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-group .btn {
            font-size: 0.9rem;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Manage Trainers
            </div>
            <div class="card-body">
                <h2 class="form-title">Trainer Management</h2>

                <?php
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    $message_type = $_SESSION['message_type'];
                    echo "<div class='alert alert-$message_type' role='alert'>$message</div>";
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
                ?>

                <div class="form-container mt-5">
                    <h4>Add a New Trainer</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Trainer Name:</label>
                            <input type="text" name="name" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="tel" name="phone" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label">Specialization:</label>
                            <input type="text" name="specialization" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="experience" class="form-label">Experience (years):</label>
                            <input type="number" name="experience" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="availability" class="form-label">Availability:</label>
                            <select name="availability" required class="form-control">
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>

                        <button type="submit" name="add_trainer" class="btn btn-custom">Add Trainer</button>
                    </form>
                </div>

                <h3 class="mt-5">View and Manage Trainers</h3>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Trainer Name</th>
                                <th>Specialization</th>
                                <th>Experience</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['specialization']; ?></td>
                                    <td><?php echo $row['experience']; ?> years</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit_trainer.php?id=<?php echo $row['trainer_id']; ?>" class="btn btn-custom">Edit</a>
                                            <a href="?delete=<?php echo $row['trainer_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this trainer?');">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No trainers available.</p>
                <?php } ?>

                <center><a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a></center>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 FitZone Fitness Center | Developed by [Your Name]
    </footer>
</body>

</html>
