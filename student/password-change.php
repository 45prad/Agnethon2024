<!-- 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <form action="password-reset-code.php" method="POST">

<input type="text" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">

    <div class="form-group">
        <label> Enter Email </label>
        <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
            required>
    </div>

    <div class="form-group">
        <label> New Password </label>
        <input type="password" id="pass" name="new_password" class="form-control form-control-lg"
            placeholder=" New Password" required>
    </div>

    
    <div class="form-group">
        <label> Confirm Password </label>
        <input type="password" id="pass" name="confirm_password" class="form-control form-control-lg"
            placeholder="Confirm Password" required>
    </div>


    <div class="form-group">
        <button type="submit" name="password_update">Update</button>
    </div>


</form>
    </div>
</body>
</html> -->

<?php
session_start();

$page_title="Password Reset Form";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="styleaa.css">
</head>
<body>
    <?php
        if(isset($_SESSION['status']))
        {
            ?>
            <div class="alert alert-sucess">
                <h5><?=$_SESSION['status'];?></h5>
        </div>
        <?php
        unset($_SESSION['status']);
        }
        ?>
    <div class="reset-container">
        <h2>Password Reset</h2>
        <form action="password-reset-code.php" method="post">
        <input type="text" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
        <label> Enter Email </label>
        <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
            required>
            <label> New Password </label>
        <input type="password" id="pass" name="new_password" class="form-control form-control-lg"
            placeholder=" New Password" required>
            <label> Confirm Password </label>
        <input type="password" id="pass" name="confirm_password" class="form-control form-control-lg"
            placeholder="Confirm Password" required>
            <button type="submit" name="password_update">Update</button>
        </form>
    </div>
</body>
</html>


