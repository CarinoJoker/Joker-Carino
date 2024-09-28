<?php
session_start(); 


$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'N/A';
$number = isset($_SESSION['number']) ? $_SESSION['number'] : 'N/A';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A';
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : 'N/A';
$country = isset($_SESSION['country']) ? $_SESSION['country'] : 'N/A';
$biography = isset($_SESSION['biography']) ? $_SESSION['biography'] : 'N/A';
$skills = isset($_SESSION['skills']) ? $_SESSION['skills'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Websys</title>
</head>
<body>
<h1>User Information</h1>
<ul>
    <li>Name: <?php echo $name; ?></li>
    <li>Number: <?php echo $number; ?></li>
    <li>Email: <?php echo $email; ?></li>
    <li>Gender: <?php echo $gender; ?></li>
    <li>Country: <?php echo $country; ?></li>
    <li>Skills: <?php echo empty($skills) ? 'None' : implode(', ', $skills); ?></li>
    <li>Biography: <?php echo $biography; ?></li>
</ul>

<a href="home.php">Back to Home</a>
</body>
</html>
