<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM credentials WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
if ($queryresult > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $branch = $row['branch']; // Retrieve the branch information from the database
    }
}

if (isset($_POST['insertdata'])) {
    $Academic_Year = $_POST['Academic_Year'];
    // $Branch = $_POST['Branch']; // Remove this line since we are retrieving the branch information from the database
    $Name_Of_The_Teacher = $_POST['Name_Of_The_Teacher'];
    $Title_Of_Program = $_POST['Title_Of_Program'];
    $Activity_Name = $_POST['Activity_Name'];
    $Other_Activity = $_POST['Other_Activity'];
    // $Dates_From = $_POST['Dates_From'];
    // $Dates_To = $_POST['Dates_To'];
    $Details = $_POST['Details'];
    $Name_Of_Activity = $_POST['Name_Of_Activity'];
    $Amount_Of_Support = $_POST['Amount_Of_Support'];
    $pdffile1 = $_FILES['pdffile1']['name'];
    $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
    // $pdffile2 = $_FILES['pdffile2']['name'];
    // $file_tmp2 = $_FILES['pdffile2']['tmp_name'];
    $user_id = $_POST['user_id'];

    move_uploaded_file($file_tmp1,"documents/$pdffile1");
    // move_uploaded_file($file_tmp2,"uploadsfrontit/$pdffile2");

    $query = "INSERT INTO financial_support
    (`Academic_Year`, `Branch`, `Name_Of_The_Teacher`, `Title_Of_Program`,
     `Activity_Name`, `Other_Activity`, `Details`, 
     `Name_Of_Activity`, `Amount_Of_Support`, `pdffile1`, `user_id`,`STATUS`) 
    VALUES ('$Academic_Year', '$branch', '$Name_Of_The_Teacher', '$Title_Of_Program', 
    '$Activity_Name', '$Other_Activity', '$Details', '$Name_Of_Activity', '$Amount_Of_Support', '$pdffile1, ', '$id','PENDING')";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>
