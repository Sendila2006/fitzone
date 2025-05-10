<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php"); // Redirect to login if not authenticated
    exit();
}

include 'dbconnect.php';

// Delete appointment based on ID
if (isset($_GET['delete_id'])) {
    $appointment_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $appointment_id);
    if ($stmt->execute()) {
        echo "<script>alert('Appointment deleted successfully.'); window.location='manage_appointments.php';</script>";
    } else {
        echo "<script>alert('Error deleting appointment.');</script>";
    }
}

// Fetch all appointments
$query = "SELECT appointments.*, trainers.name as trainer_name FROM appointments LEFT JOIN trainers ON appointments.trainer_id = trainers.trainer_id";
$result = $conn->query($query);

// Handle new appointment submission
if (isset($_POST['appointment'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $trainer_id = $_POST['trainer_id'];
    $session_type = $_POST['session_type'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = 'pending'; // Default status

    // Prepare the query to insert appointment
    $sql = "INSERT INTO appointments (full_name, email, phone, trainer_id, session_type, appointment_date, appointment_time, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssss", $full_name, $email, $phone, $trainer_id, $session_type, $appointment_date, $appointment_time, $status);
        if ($stmt->execute()) {
            echo '<script type="text/javascript">alert("Appointment booked successfully. Now you can view the appointments");
            window.location="manage_appointments.php";
            </script>';
        } else {
            echo "<p class='message error'>Error: " . $stmt->error . "</p>";
        }
    }
}

// Fetch trainers for the dropdown
$trainer_query = "SELECT * FROM trainers";
$trainer_result = $conn->query($trainer_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.x/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f6f9;
            background-image: url('/gym/pic/ma.jpg');
            background-size: cover;
            color: #333;
        }
        .container {
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d2d2d;
            text-align: center;
            margin-bottom: 30px;
        }
        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .table {
            width: 80%;  /* You can adjust this percentage to control the table's width */
            text-align: center; /* Ensures content within the table is centered */
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .btn {
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 5px;
            text-transform: uppercase;
        }
        .btn-edit {
            background-color: #fd7e14;
            color: white;
        }
        .btn-edit:hover {
            background-color: #e56a10;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
        }
        .btn-add:hover {
            background-color: #218838;
        }
        .btn-back {
            margin-top: 30px;
            font-size: 1.1rem;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .alert {
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
            color: #343a40;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Appointments</h1>
        
        <!-- Success Alert -->
        <?php if (isset($_GET['delete_id'])): ?>
            <div class="alert alert-success" role="alert">
                Appointment deleted successfully!
            </div>
        <?php endif; ?>

        <!-- Book Appointment Form -->
        <h2 class="my-4 text-center">Book Appointment</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="trainer_id" class="form-label">Select Trainer</label>
                <select class="form-select" id="trainer_id" name="trainer_id" required>
                    <option value="">-- Select Trainer --</option>
                    <?php while ($trainer = $trainer_result->fetch_assoc()) { ?>
                        <option value="<?php echo $trainer['trainer_id']; ?>"><?php echo $trainer['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="session_type" class="form-label">Session Type</label>
                <input type="text" class="form-control" id="session_type" name="session_type" required>
            </div>
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
            </div>
            <div class="mb-3">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
            </div>
            <button type="submit" name="appointment" class="btn btn-add w-100">Book Appointment</button>
        </form>

        <br>
        <center><h1>Appointments</h1></center>
        <div class="table-container">
            <table class="table table-striped table-bordered mt-2">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Trainer</th>
                        <th>Session Type</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($appointment = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $appointment['appointment_id']; ?></td>
                            <td><?php echo htmlspecialchars($appointment['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['email']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['trainer_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['session_type']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                            <td><?php echo ucfirst(htmlspecialchars($appointment['status'])); ?></td>
                            <td>
                                <a href="edit_appointment.php?id=<?php echo $appointment['appointment_id']; ?>" class="btn btn-edit btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <br><br>
                                <a href="?delete_id=<?php echo $appointment['appointment_id']; ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <center><a href="staff_dashboard.php" class="btn btn-back">Back to Dashboard</a></center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
