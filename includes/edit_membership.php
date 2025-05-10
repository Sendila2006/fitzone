<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php"); // Redirect to login if not authenticated
    exit();
}

include 'dbconnect.php'; // Database connection

// Fetch membership details based on ID
if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];
    $query = "SELECT * FROM membership WHERE membership_id = $membership_id";
    $result = $conn->query($query);
    $membership = $result->fetch_assoc();
}

// Update membership details
$updateSuccess = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $benefits = $_POST['benefits'];

    $update_query = "UPDATE membership SET full_name='$full_name', plan_name='$plan_name', price='$price', benefits='$benefits' WHERE membership_id = $membership_id";
    if ($conn->query($update_query)) {
        $updateSuccess = true;
    } else {
        echo "<script>alert('Update failed.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Membership</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 800px;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #28a745;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            background-color: #f4f7fc;
            border-radius: 0 0 10px 10px;
        }

        .modal-body {
            font-size: 1.2rem;
            text-align: center;
            color: #333;
        }

        .modal-footer a {
            font-size: 1rem;
        }
    </style>
    <script>
        // Function to populate price and benefits based on selected plan
        function fillPlanDetails() {
            const planSelector = document.getElementById('planSelector');
            const selectedPlan = planSelector.value;
            
            if (selectedPlan) {
                const planDetails = selectedPlan.split('|');
                const planName = planDetails[0];
                const price = planDetails[1];
                const benefits = planDetails[2];

                // Set the plan details in the respective fields
                document.getElementById('plan_name').value = planName;
                document.getElementById('price').value = price;
                document.getElementById('benefits').value = benefits;
            }
        }

        // Show success modal if update is successful
        window.onload = function() {
            <?php if ($updateSuccess) { ?>
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            <?php } ?>
        };
    </script>
</head>
<body>

<div class="container">
    <h1>Edit Membership</h1>
    <form method="post">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo $membership['full_name']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Select a Plan</label>
            <select class="form-select" id="planSelector" onchange="fillPlanDetails()">
                <option value="">-- Choose a Plan --</option>
                <option value="Basic Plan|3000|Access to gym facilities, Locker room access, Free water bottle" <?php echo ($membership['plan_name'] == 'Basic Plan') ? 'selected' : ''; ?>>Basic Plan</option>
                <option value="Standard Plan|6000|Access to gym facilities, Locker room access, One personal training session per month, Free protein shake" <?php echo ($membership['plan_name'] == 'Standard Plan') ? 'selected' : ''; ?>>Standard Plan</option>
                <option value="Premium Plan|10000|Unlimited access to gym facilities, Locker room access, Weekly personal training session, Free nutrition consultation, Access to group fitness classes" <?php echo ($membership['plan_name'] == 'Premium Plan') ? 'selected' : ''; ?>>Premium Plan</option>
                <option value="VIP Plan|15000|24/7 gym access, Locker room with private shower, Unlimited personal training sessions, Monthly diet plan by a nutritionist, Complimentary fitness gear" <?php echo ($membership['plan_name'] == 'VIP Plan') ? 'selected' : ''; ?>>VIP Plan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="plan_name" class="form-label">Plan Name</label>
            <input type="text" id="plan_name" name="plan_name" class="form-control" value="<?php echo $membership['plan_name']; ?>" readonly required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?php echo $membership['price']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="benefits" class="form-label">Benefits</label>
            <textarea id="benefits" name="benefits" class="form-control" rows="4" required><?php echo $membership['benefits']; ?></textarea>
        </div>

        <center><button type="submit" class="btn btn-success">Update Membership</button></center>
        <br>

        <center><a href="manage_membership.php" class="btn btn-secondary">Back to Manage Membership</a></center>
    </form>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Membership details have been successfully updated.
            </div>
            <div class="modal-footer">
                <a href="manage_membership.php" class="btn btn-primary">Go to Manage Membership</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
