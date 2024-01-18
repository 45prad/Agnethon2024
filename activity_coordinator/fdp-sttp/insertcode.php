<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM activity_coordinator WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
if ($queryresult > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $branch = $row['branch']; // Retrieve the branch information from the database
    }
}

if(isset($_POST['insertdata']))
{
    $Academic_year = $_POST['Academic_year'];
    $Organized_for = $_POST['Organized_for'];
    // $Branch = $_POST['Branch'];
    $Title_Of_Program = $_POST['Title_Of_Program'];
    $Approving_Body = $_POST['Approving_Body'];
    $Grant_Amount = $_POST['Grant_Amount'];
    $Convener_Of_FDP_STTP = $_POST['Convener_Of_FDP_STTP'];
    $Dates_From = $_POST['Dates_From'];
    $Dates_To = $_POST['Dates_To'];
    
    $No_Of_Participants = $_POST['No_Of_Participants'];
    $pdffile = $_FILES['pdffile']['name'];
    $file_tmp = $_FILES['pdffile']['tmp_name'];
    $user_id = $_POST['user_id'];
    

    move_uploaded_file($file_tmp,"uploadsfdporganised/$pdffile");

    $query = "INSERT INTO fdpsttporganised
    (`Academic_year`, `Branch`, `Organized_for`, `Title_Of_Program`, `Approving_Body`, `Grant_Amount`, `Convener_Of_FDP_STTP`,
	`Dates_From`, `Dates_To`, `No_Of_Participants`, `pdffile`,`user_id`,`STATUS`) 
    VALUES ('$Academic_year', '$branch', '$Organized_for', '$Title_Of_Program' ,'$Approving_Body', '$Grant_Amount', '$Convener_Of_FDP_STTP',
	'$Dates_From', '$Dates_To', '$No_Of_Participants', '$pdffile','$id','PENDING')";

    
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