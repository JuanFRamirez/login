<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
<header>
<nav class="nav-bar">
<div class="logo">
Logo
</div>
<ul>
<li><a href="./sign-in_form.php">Register</a></li>
<li>Log-in</li>
<?php
if(isset($_SESSION['uid'])){
    echo '<li> <a href="./log-out.php">Log-Out</a></li>';
}

?>
</ul>
</nav>
</header>

