<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM student WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
if ($queryresult > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $branch = $row['branch']; // Retrieve the branch information from the database
        $division = $row['division'];
    }
}

if (isset($_POST['insertdata'])) {
    $Academic_year = $_POST['Academic_year'];
    $Name_Of_The_Student = $_POST['Name_Of_The_Student'];
    $Roll_no = $_POST['Roll_no'];
    // $Branch = $_POST['Branch']; // Remove this line since we are retrieving the branch information from the database
    // $division = $_POST['division'];
    $Year_Of_Study = $_POST['Year_Of_Study'];
    $Extracurricular_Or_Cocurricular = $_POST['Extracurricular_Or_Cocurricular'];
    $Type_Of_The_Activity = $_POST['Hidden_Type_Of_The_Activity'];
    $Level = $_POST['Level'];
    $Name_Of_Activity = $_POST['Name_Of_Activity'];
    $Organizing_Body = $_POST['Organizing_Body'];
    $Award_Or_Participation = $_POST['Award_Or_Participation'];
    $Dates_From = $_POST['Dates_From'];
    $Dates_To = $_POST['Dates_To'];
    $pdffile1 = $_FILES['pdffile1']['name'];
    $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
    // $pdffile2 = $_FILES['pdffile2']['name'];
    // $file_tmp2 = $_FILES['pdffile2']['tmp_name'];
    $user_id = $_POST['user_id'];

    move_uploaded_file($file_tmp1,"certificates/$pdffile1");
    // move_uploaded_file($file_tmp2,"uploadsfrontit/$pdffile2");

    $query = "INSERT INTO achievement
    (`Academic_year`,`Name_Of_The_Student`, `Roll_no`, `Branch`, `division`,`Year_Of_Study`,
      `Extracurricular_Or_Cocurricular`, `Type_Of_The_Activity`, `Level`,`Name_Of_Activity`, 
     `Organizing_Body`, `Award_Or_Participation`, `Dates_From`, `Dates_To`, `pdffile1`, `user_id`,`STATUS`) 
    VALUES ('$Academic_year','$Name_Of_The_Student', '$Roll_no', '$branch','$division' ,'$Year_Of_Study',  
    '$Extracurricular_Or_Cocurricular', '$Type_Of_The_Activity','$Level','$Name_Of_Activity',  '$Organizing_Body', '$Award_Or_Participation', '$Dates_From', '$Dates_To', '$pdffile1', '$id','PENDING')";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>
