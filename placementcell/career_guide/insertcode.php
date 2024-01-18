<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM placementcell WHERE username = '$user'";
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
    $career_year = $_POST['career_year'];
    // $Branch = $_POST['Branch'];
    $guidance_career = $_POST['guidance_career'];
    $title = $_POST['title'];
    $students_attended = $_POST['students_attended'];
    $pdffile = $_FILES['pdffile']['name'];
    $file_tmp = $_FILES['pdffile']['tmp_name'];
    $user_id = $_POST['user_id'];
    

    move_uploaded_file($file_tmp,"uploadsfdporganised/$pdffile");

    $query = "INSERT INTO career_guidance
    (`career_year`, `Branch`, `guidance_career`, `title`, `students_attended`, `pdffile`,`user_id`,`STATUS`) 
    VALUES ('$career_year', '$branch', '$guidance_career', '$title', '$students_attended','$pdffile','$id','PENDING')";

    
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