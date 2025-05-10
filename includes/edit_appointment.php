<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php"); // Redirect to login if not authenticated
    exit();
}

include 'dbconnect.php'; // Database connection

// Fetch the appointment ID from the URL
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Fetch the current appointment data
    $query = "SELECT * FROM appointments WHERE appointment_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $appointment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if the appointment exists
        if ($result->num_rows == 0) {
            echo "<script>alert('Appointment not found!'); window.location='manage_appointments.php';</script>";
            exit();
        }
        
        $appointment = $result->fetch_assoc();
    }
}

// Fetch trainers for the dropdown
$trainer_query = "SELECT * FROM trainers";
$trainer_result = $conn->query($trainer_query);

// Handle the form submission for editing the appointment
if (isset($_POST['update_appointment'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $trainer_id = $_POST['trainer_id'];
    $session_type = $_POST['session_type'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = $_POST['status'];

    // Prepare the update query
    $update_query = "UPDATE appointments SET full_name = ?, email = ?, phone = ?, trainer_id = ?, session_type = ?, appointment_date = ?, appointment_time = ?, status = ? WHERE appointment_id = ?";
    
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param("ssssssssi", $full_name, $email, $phone, $trainer_id, $session_type, $appointment_date, $appointment_time, $status, $appointment_id);
        if ($stmt->execute()) {
            echo "<script>alert('Appointment updated successfully.'); window.location='manage_appointments.php';</script>";
        } else {
            echo "<p class='message error'>Error: " . $stmt->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('/gym/pic/ea.jpg');
            background-size: cover;
        }
        .container {
            margin-top: 60px;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 40px;
        }
        .form-label {
            font-weight: bold;
            color: #2c3e50;
        }
        .form-control {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }
        .form-select {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-back {
            margin-top: 20px;
            font-size: 1.1rem;
            padding: 12px 25px;
            background-color: #7f8c8d;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #95a5a6;
        }
        .alert {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control, .form-select {
            height: 40px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Appointment</h1>
        <form method="POST">
            <div class="form-group mb-4">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($appointment['full_name']); ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($appointment['email']); ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($appointment['phone']); ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="trainer_id" class="form-label">Select Trainer</label>
                <select class="form-select" id="trainer_id" name="trainer_id" required>
                    <?php while ($trainer = $trainer_result->fetch_assoc()) { ?>
                        <option value="<?php echo $trainer['trainer_id']; ?>" <?php echo ($trainer['trainer_id'] == $appointment['trainer_id']) ? 'selected' : ''; ?>>
                            <?php echo $trainer['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="session_type" class="form-label">Session Type</label>
                <input type="text" class="form-control" id="session_type" name="session_type" value="<?php echo htmlspecialchars($appointment['session_type']); ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending" <?php echo ($appointment['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="confirmed" <?php echo ($appointment['status'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="cancelled" <?php echo ($appointment['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" name="update_appointment" class="btn btn-primary w-100">Update Appointment</button>
        </form>

        <center><a href="manage_appointments.php" class="btn btn-back">Back to Manage Appointments</a></center>
    </div>

    <div class="footer">
        <p>&copy; 2025 FitZone. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
