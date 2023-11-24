<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "student_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['isRegistered'] = true;
        echo "<p>Registration successful! Please click the login button to proceed.</p>";
        echo '<button type="button" class="btn btn-primary" id="loginButton" onclick="window.location.href = \'index.html\'">Login</button>';
    } else {
        echo "<p>Registration failed. Please try again later.</p>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connection);
?>
