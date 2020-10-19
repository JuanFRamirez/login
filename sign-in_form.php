<?php
include 'header.php';
?>
<div class="form-container">
    <form method="POST" action ="control/register.php">
        <label>Name:</label>
        <input type="text" name="username" class="form-control" placeholder="Enter your username"/>
        <label>Email:</label>
        <input type="text" name="email" class="form-control" placeholder="Enter your email"/>
        <label>Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password"/>
        <label>Repeat password:</label>
        <input type="password" name="repeat-password" class="form-control" placeholder="Repeat your password"/>
        <input type="submit" name="register-form" class="form-control button">
    </form>
</div>
<?php
include_once 'footer.php';
?>