<?php
include 'header.php';
?>
<div class="form-container">
    

        <?php
    if(isset($_SESSION['uid'])){

        $host = $_SERVER['HTTP_HOST'];
        $url = $_SERVER['REQUEST_URI'];
        echo '<p>You are logged in</p>';
        echo $host. $url;
    }else{
        echo '<p>No user logged</p>';
        if(isset($_GET['error'])){
            if($_GET['error']=='username_required'){
                echo '<p class="error">User name is required</p>';
            }
        }
        echo '
        <form method="POST" action ="control/login.php">
        <label>Name:</label>
        <input type="text" name="username" class="form-control" placeholder="Enter your username"/>
        <label>Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password"/>
        <input type="submit" name="submit-form" class="form-control button">
        
        </form>
        ';
    }
    
    ?>
    
</div>
<?php
include_once 'footer.php';
?>