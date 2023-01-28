<?php 
include('config.php');
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}else{
    $user = $_SESSION['user'];
    echo "<p>you are logged in as " .$user;
    echo "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <title>Dashboard</title>
</head>
<body>
    <nav>
     
    </nav>
    <h1 class="font-bold">here comes the currency calculator</h1>
    

</body>
</html>