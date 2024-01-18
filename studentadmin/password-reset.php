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
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <button type="submit" name="password_reset_link">Send Link</button>
        </form>
    </div>
</body>
</html>
