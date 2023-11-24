<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "student_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: dashboard.php");
    } else {
        echo "Invalid login credentials";
    }
}

mysqli_close($connection);
?>
