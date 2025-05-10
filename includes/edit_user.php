<?php
include('dbconnect.php'); // Database connection
session_start(); // Start session for messages

// Fetch User
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $fetch_sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $fetch_sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        $_SESSION['message'] = 'User not found!';
        $_SESSION['message_type'] = 'danger';
        header('Location: manage_admin_user.php');
        exit();
    }
}

// Update User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['pwd']; // If password is empty, keep the old one

    $update_sql = "UPDATE users SET username = '$username', email = '$email', role = '$role', pwd = '$password' WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['message'] = 'User updated successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . mysqli_error($conn);
        $_SESSION['message_type'] = 'danger';
    }
    header('Location: manage_admin_user.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 40px; }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: 30px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Edit User</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="staff" <?php echo $user['role'] == 'staff' ? 'selected' : ''; ?>>Staff</option>
                    <option value="customer" <?php echo $user['role'] == 'customer' ? 'selected' : ''; ?>>Customer</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
        </form>

        <center><a href="manage_admin_user.php" class="btn btn-secondary">Back to Manage Users</a></center>
    </div>

    <footer>
        &copy; 2025 FitZone Fitness Center | Developed by [Your Name]
    </footer>
</body>

</html>
