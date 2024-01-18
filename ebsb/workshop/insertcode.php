<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM ebsb WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
if ($queryresult > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
    }
}

if (isset($_POST['insertdata'])) {
        $year = $_POST['year'];
        $branch= $_POST['branch'];
        $workshop_seminar = $_POST['workshop_seminar'];
        $coordinator = $_POST['coordinator'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $others = $_POST['others'];
        $no_of_participants = $_POST['no_of_participants'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $pdffile1 = $_FILES['pdffile1']['name'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
        
        $user_id = $_POST['user_id'];

    move_uploaded_file($file_tmp1,"../../activity_coordinator/workshop/uploads/$pdffile1");

    $query = "INSERT INTO workshops
    (`year`,`branch`, `workshop_seminar`, `coordinator`,
     `title`, `category`, `others`, `no_of_participants`, 
     `start_date`, `end_date`,`pdffile1`, `user_id`,`STATUS`,`Source`) 
    VALUES ('$year', '$branch', '$workshop_seminar','$coordinator', 
    '$title', '$category', '$others', '$no_of_participants', '$start_date', '$end_date','$pdffile1' ,'$id','PENDING','ebsb')";
    

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>