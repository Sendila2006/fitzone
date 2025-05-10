<?php
include('dbconnect.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_name = $_POST['class_name'];
    $instructor_name = $_POST['instructor_name'];
    $class_time = $_POST['class_time'];

    $sql = "INSERT INTO class_schedule (class_name, instructor_name, class_time) 
            VALUES ('$class_name', '$instructor_name', '$class_time')";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success" role="alert">New class added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJho9v5LzRmt7n0fF5dLw9oK6Uj9f2hzM2TsdU5n5pJbBr9bI6gk1tM4YO2w" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('/gym/pic/add_class.jpg');
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 700px;
            margin-top: 100px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 35px;
            color: #e9ecef;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #1d72b8;
            color: #fff;
            font-weight: 600;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #155a8a;
            transform: translateY(-2px);
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
            background-color: #1d72b8;
            color: #fff;
            font-size: 1.5rem;
            text-align: center;
            padding: 20px 0;
            border-radius: 15px 15px 0 0;
        }

        .form-control {
            border-radius: 8px;
            background-color: #495057;
            color: #fff;
            border: 1px solid #6c757d;
            padding: 12px;
            transition: background-color 0.3s ease, border 0.3s ease;
        }

        .form-control:focus {
            background-color: #343a40;
            border: 1px solid #1d72b8;
            box-shadow: 0 0 5px rgba(29, 114, 184, 0.5);
        }

        .form-label {
            font-weight: 600;
            color: #e9ecef;
        }

        .alert-success, .alert-danger {
            font-size: 1.2rem;
            padding: 18px;
            font-weight: 500;
        }

        .card-body {
            padding: 30px;
        }

        /* Neumorphism effect for inputs */
        .form-control, .btn-custom {
            background: #343a40;
            box-shadow: inset 3px 3px 6px rgba(0, 0, 0, 0.2), inset -3px -3px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus, .btn-custom:hover {
            box-shadow: inset 3px 3px 6px rgba(0, 0, 0, 0.3), inset -3px -3px 6px rgba(0, 0, 0, 0.15);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .container {
                margin-top: 50px;
                padding: 0 15px;
            }

            .form-title {
                font-size: 2rem;
            }

            .card-header {
                font-size: 1.2rem;
                padding: 15px 0;
            }

            .card-body {
                padding: 20px;
            }

            .form-control {
                padding: 10px;
            }

            .btn-custom {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <center>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Add New Class
            </div>

            <div class="card-body">
                <h2 class="form-title">Enter Class Details</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="class_name" class="form-label">Class Name:</label>
                        <input type="text" class="form-control" name="class_name" placeholder="Enter class name" required>
                    </div>

                    <div class="form-group">
                        <label for="instructor_name" class="form-label">Instructor Name:</label>
                        <input type="text" class="form-control" name="instructor_name" placeholder="Enter instructor's name" required>
                    </div>

                    <div class="form-group">
                        <label for="class_time" class="form-label">Class Time:</label>
                        <input type="datetime-local" class="form-control" name="class_time" required>
                    </div>

                    <button type="submit" class="btn btn-custom mt-4">Add Class</button>
                </form>
            </div>
        </div>
    </div>
</center>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb7C7W1P10bbp06pUqGQXMiw4vEq3y5jvyoqlf7px7y8p5UBP" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0jXZnP8Wv6cGF1K5kzWv53qboq8kAUmz8WUwkt44hXgXxuL7" crossorigin="anonymous"></script>
</body>

</html>
