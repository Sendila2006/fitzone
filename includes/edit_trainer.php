<?php
include('dbconnect.php'); // Include your database connection file

// Start the session to store messages
session_start();

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $trainer_id = $_GET['id'];

    // Fetch the trainer's details from the database
    $sql = "SELECT * FROM trainers WHERE trainer_id = '$trainer_id'";
    $result = mysqli_query($conn, $sql);
    $trainer = mysqli_fetch_assoc($result);

    // If the trainer doesn't exist, redirect back to the trainer management page
    if (!$trainer) {
        $_SESSION['message'] = 'Trainer not found!';
        $_SESSION['message_type'] = 'danger';
        header('Location: manage_admin_trainer.php');
        exit();
    }
}

// Update Trainer
if (isset($_POST['update_trainer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $availability = $_POST['availability'];

    // Update query
    $update_sql = "UPDATE trainers 
                   SET name = '$name', email = '$email', phone = '$phone', 
                       specialization = '$specialization', experience = '$experience', availability = '$availability' 
                   WHERE trainer_id = '$trainer_id'";

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['message'] = 'Trainer updated successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . mysqli_error($conn);
        $_SESSION['message_type'] = 'danger';
    }

    // Redirect back to the manage trainers page
    header('Location: manage_admin_trainer.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trainer</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('/gym/pic/mtr.jpeg');
            background-size: cover;
            color: #333;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 800px;
            margin-top: 80px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 35px;
            color: #007bff;
        }

        .btn-custom {
            background-color: #28a745;
            color: #fff;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #218838;
            transition: background-color 0.3s ease;
        }

        .alert {
            margin-top: 20px;
            border-radius: 10px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #17a2b8;
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
            margin-bottom: 20px;
        }

        .form-container h4 {
            font-size: 1.75rem;
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(38, 143, 255, 0.6);
            border-color: #28a745;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Trainer
            </div>
            <div class="card-body">
                <h2 class="form-title">Edit Trainer Details</h2>

                <!-- Display messages -->
                <?php
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    $message_type = $_SESSION['message_type'];
                    echo "<div class='alert alert-$message_type' role='alert'>$message</div>";

                    // Clear messages
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
                ?>

                <!-- Edit Trainer Form -->
                <div class="container mt-5">
                    <div class="form-container">
                        <h4>Update Trainer</h4>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Trainer Name:</label>
                                <input type="text" name="name" value="<?php echo $trainer['name']; ?>" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" value="<?php echo $trainer['email']; ?>" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="tel" name="phone" value="<?php echo $trainer['phone']; ?>" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="specialization" class="form-label">Specialization:</label>
                                <input type="text" name="specialization" value="<?php echo $trainer['specialization']; ?>" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="experience" class="form-label">Experience (years):</label>
                                <input type="number" name="experience" value="<?php echo $trainer['experience']; ?>" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="availability" class="form-label">Availability:</label>
                                <select name="availability" required class="form-control">
                                    <option value="available" <?php if ($trainer['availability'] == 'available') echo 'selected'; ?>>Available</option>
                                    <option value="unavailable" <?php if ($trainer['availability'] == 'unavailable') echo 'selected'; ?>>Unavailable</option>
                                </select>
                            </div>

                            <button type="submit" name="update_trainer" class="btn btn-custom">Update Trainer</button>
                        </form>
                    </div>
                </div>

                <center><a href="manage_admin_trainer.php" class="btn btn-primary">Back to Trainer Management</a></center>
            </div>
        </div>
    </div>
    <br>
    <br>
</body>

</html>
