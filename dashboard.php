<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit();
}

$connection = mysqli_connect("localhost", "root", "", "student_db");

$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM students WHERE id='$user_id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome to the Student Dashboard</h2>
        <p>Name: <?php echo $user["name"]; ?></p>
        <p>Email: <?php echo $user["email"]; ?></p>
        <p><a href="logout.php" class="btn btn-danger">Logout</a></p>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
