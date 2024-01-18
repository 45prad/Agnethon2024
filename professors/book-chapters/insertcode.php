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
    $academic_year = $_POST['academic_year'];
    // $Branch = $_POST['Branch']; // Remove this line since we are retrieving the branch information from the database
    $Name_Of_The_Teacher = $_POST['Name_Of_The_Teacher'];
    $Title_Of_The_Book_Published = $_POST['Title_Of_The_Book_Published'];
    $National_Or_International = $_POST['National_Or_International'];
    $Year_Of_Publication = $_POST['Year_Of_Publication'];
    $ISBN_Or_ISSN_Number = $_POST['ISBN_Or_ISSN_Number'];
    $Affiliating_institute = $_POST['Affiliating_institute'];
    $Name_Of_The_Publisher = $_POST['Name_Of_The_Publisher'];
    $paper_link = $_POST['paper_link'];
    $pdffile1 = $_FILES['pdffile1']['name'];
    $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
    $pdffile2 = $_FILES['pdffile2']['name'];
    $file_tmp2 = $_FILES['pdffile2']['tmp_name'];
    $user_id = $_POST['user_id'];

    move_uploaded_file($file_tmp1,"uploadsindexit/$pdffile1");
    move_uploaded_file($file_tmp2,"uploadsfrontit/$pdffile2");

    $query = "INSERT INTO bookschapter
    (`academic_year`,`Name_Of_The_Teacher`, `Branch`, `Title_Of_The_Book_Published`, 
     `Name_Of_The_Publisher`, `National_Or_International`, `ISBN_Or_ISSN_Number`, `Year_Of_Publication`, 
     `paper_link`,`Affiliating_institute`,`pdffile1`, `pdffile2`, `user_id`,`STATUS`) 
    VALUES ('$academic_year','$Name_Of_The_Teacher', '$branch', '$Title_Of_The_Book_Published',  
    '$Name_Of_The_Publisher', '$National_Or_International', '$ISBN_Or_ISSN_Number', '$Year_Of_Publication', '$paper_link','$Affiliating_institute', '$pdffile1', '$pdffile2', '$id','PENDING')";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>
