<?php
session_start();
include('../../config.php');
$user = $_SESSION["role"];
$result = "SELECT * FROM credentials WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
            $branch=$row['branch'];
            
        }  
    }
	//hello baby
if(isset($_POST['insertdata']))
{   $Academic_Year = $_POST['Academic_Year'];
    // $Branch = $_POST['Branch']; // Remove this line since we are retrieving the branch information from the database
    $Name_of_Faculty = $_POST['Name_of_Faculty'];
    $Nature_of_interaction = $_POST['Nature_of_interaction'];
    $other = $_POST['other'];
    $Details_of_interaction = $_POST['Details_of_interaction'];
    $Level_of_interaction = $_POST['Level_of_interaction'];
    $Date_of_interaction = $_POST['Date_of_interaction'];
    $Duration = $_POST['Duration'];
    $pdffile1 = $_FILES['pdffile1']['name'];
    $file_tmp1 = $_FILES['pdffile1']['tmp_name'];

    $user_id = $_POST['user_id'];
	
    move_uploaded_file($file_tmp1,"certificates/$pdffile1");

    $query = "INSERT INTO facultyinteraction
    (`Academic_Year`,`Branch`, `Name_of_Faculty`, `Nature_of_interaction`,`other`,`Details_of_interaction`,`Date_of_interaction`,`Duration`,`Level_of_interaction`, `pdffile1`, `user_id`,`STATUS`) 
    VALUES ('$Academic_Year','$branch', '$Name_of_Faculty', '$Nature_of_interaction','$other', '$Details_of_interaction','$Date_of_interaction', '$Duration', '$Level_of_interaction', '$pdffile1', '$id','PENDING')";

    
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>
