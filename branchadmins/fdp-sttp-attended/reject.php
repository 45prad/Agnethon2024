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

    if (isset($_POST['reject'])) {
        $id = $_POST['id'];
        $query = "UPDATE fdpsttpattendedit SET STATUS = 'Sent Back' WHERE id = $id";
        $mysqli->query($query);
        header("Location: index.php");
        echo "<script>alert('Data has been sent back.')</script>";
        exit();
    }
}
?>
