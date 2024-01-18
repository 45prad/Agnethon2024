<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM uba WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
if ($queryresult > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        
    }
}

if (isset($_POST['insertdata'])) {
    $Name_of_Activity = $_POST['Name_of_Activity'];
        $Organizing_Unit = $_POST['Organizing_Unit'];
        $Name_of_Coordinators= $_POST['Name_of_Coordinators'];
        $Name_of_Scheme = $_POST['Name_Of_Scheme'];
        
        $Dates_Conducted = $_POST['Dates_Conducted'];
        $Year_of_Activity = $_POST['Year_of_Activity'];
        $No_of_Student_Volunteer_for_Activity = $_POST['No_of_Student_Volunteer_for_Activity'];
        $No_of_People_benefitted_by_Activity = $_POST['No_of_People_benefitted_by_Activity'];
        $pdffile1 = $_FILES['pdffile1']['name'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
        $user_id = $_POST['user_id'];

    move_uploaded_file($file_tmp1,"Reports/$pdffile1");


    $query = "INSERT INTO outreachprogram
    (`Name_of_Activity`, `Organizing_Unit`, `Name_of_Coordinators`, `Name_Of_Scheme`, `Dates_Conducted`, `Year_of_Activity`, 
    `No_of_Student_Volunteer_for_Activity`, `No_of_People_benefitted_by_Activity`, `pdffile1`, `user_id`,`STATUS`,`Source`) 
    VALUES ('$Name_of_Activity', '$Organizing_Unit', '$Name_of_Coordinators', '$Name_Of_Scheme', '$Dates_Conducted',
     '$Year_of_Activity', '$No_of_Student_Volunteer_for_Activity', '$No_of_People_benefitted_by_Activity', '$pdffile1','$id','PENDING','club')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>
