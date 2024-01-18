<?php

if (isset($_POST['deny'])) {
    header("Location: " . $_SERVER['PHP_SELF']); 
    echo "<script>alert('Data has been denied.')</script>";
    exit();
} else {
    $servername = "localhost";
    $username = "sql_ims_fcrit_ac";
    $password = "WEpwb7F7iCY86MBa";
    $db = "sql_ims_fcrit_ac";
    // Create connection
    $mysqli = new Mysqli("localhost","sql_ims_fcrit_ac","WEpwb7F7iCY86MBa","sql_ims_fcrit_ac");
    $connection = mysqli_connect($servername, $username, $password, $db);
    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['approve_now'])) {
        $id = $_POST['id'];
        $query = "UPDATE facultyachievement SET STATUS = 'approved' WHERE id = $id";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "<script>alert('Data has been approved.')</script>";
            header("Location:index.php");
            exit();
        } else {
            echo "Error updating status: " . mysqli_error($connection);
        }
    }
}
?>
