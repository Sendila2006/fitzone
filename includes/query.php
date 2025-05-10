<?php

$host = "localhost";
$username = "root"; 
$password = "";
$database = "gym"; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $subject = $conn->real_escape_string($_POST["subject"]);
    $message = $conn->real_escape_string($_POST["message"]);


    $query = "INSERT INTO queries (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Message sent and saved successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
