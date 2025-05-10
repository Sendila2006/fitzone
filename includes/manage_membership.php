<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: staff.php"); // Redirect to login if not authenticated
    exit();
}

include 'dbconnect.php'; // Database connection

// Handle form submission for adding new membership
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $benefits = $_POST['benefits'];

    // Prepare an SQL statement to insert the membership into the database
    $insert_query = "INSERT INTO membership (full_name, plan_name, price, benefits) 
                     VALUES ('$full_name', '$plan_name', '$price', '$benefits')";

    if ($conn->query($insert_query)) {
        echo "<script>alert('Membership added successfully!'); window.location='manage_membership.php';</script>";
    } else {
        echo "<script>alert('Error adding membership.');</script>";
    }
}

// Delete membership based on ID
if (isset($_GET['delete_id'])) {
    $membership_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM membership WHERE membership_id = $membership_id";
    if ($conn->query($delete_query)) {
        echo "<script>alert('Membership deleted successfully.'); window.location='manage_membership.php';</script>";
    } else {
        echo "<script>alert('Error deleting membership.');</script>";
    }
}

// Fetch all memberships
$query = "SELECT * FROM membership";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Memberships</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.x/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('/gym/pic/gk.jpg');
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-container {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            margin-top: 30px;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn {
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
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

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .alert {
            margin-bottom: 30px;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 1.1rem;
            color: #555;
        }

        .form-select,
        .form-control,
        .btn {
            border-radius: 10px;
        }

        .form-control {
            padding: 10px;
            margin-bottom: 20px;
        }

        .form-select {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <center>
            <h1>Add Membership Plan</h1></center>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select a Plan</label>
                    <select class="form-select" id="planSelector" onchange="fillPlanDetails()">
                        <option value="">-- Choose a Plan --</option>
                        <option value="Basic Plan|3000|Access to gym facilities, Locker room access, Free water bottle">Basic Plan</option>
                        <option value="Standard Plan|6000|Access to gym facilities, Locker room access, One personal training session per month, Free protein shake">Standard Plan</option>
                        <option value="Premium Plan|10000|Unlimited access to gym facilities, Locker room access, Weekly personal training session, Free nutrition consultation, Access to group fitness classes">Premium Plan</option>
                        <option value="VIP Plan|15000|24/7 gym access, Locker room with private shower, Unlimited personal training sessions, Monthly diet plan by a nutritionist, Complimentary fitness gear">VIP Plan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Plan Name</label>
                    <input type="text" class="form-control" name="plan_name" id="plan_name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (LKR)</label>
                    <input type="number" class="form-control" name="price" id="price" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Benefits</label>
                    <textarea class="form-control" name="benefits" id="benefits" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Add Membership</button>
            </form>
        </div>
    </div>

    <script>
        function fillPlanDetails() {
            let planSelector = document.getElementById("planSelector");
            let selectedOption = planSelector.value.split("|");

            if (selectedOption.length === 3) {
                document.getElementById("plan_name").value = selectedOption[0];
                document.getElementById("price").value = selectedOption[1];
                document.getElementById("benefits").value = selectedOption[2];
            }
        }
    </script>
<br>
<br>
    <div class="container table-container">
        <h1>Manage Memberships</h1>

        <?php if (isset($_GET['delete_id'])): ?>
            <div class="alert alert-success" role="alert">
                Membership deleted successfully!
            </div>
        <?php endif; ?>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Plan Name</th>
                    <th>Price</th>
                    <th>Benefits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($membership = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $membership['membership_id']; ?></td>
                        <td><?php echo $membership['full_name']; ?></td>
                        <td><?php echo $membership['plan_name']; ?></td>
                        <td><?php echo $membership['price']; ?></td>
                        <td><?php echo $membership['benefits']; ?></td>
                        <td>
                            <a href="edit_membership.php?id=<?php echo $membership['membership_id']; ?>" class="btn btn-edit btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <br>
                            <br>
                            <a href="?delete_id=<?php echo $membership['membership_id']; ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this membership?');">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        
        <center><a href="staff_dashboard.php" class="btn btn-primary">Back to Dashboard</a></center>
    </div>
<br>
<br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
