<?php
include('../../config.php');
session_start();

$user = $_SESSION["role"];

$result = "SELECT * FROM womenclub WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
           
        }  
    }

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];


        $query = "DELETE FROM workshops";

    
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:index.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>