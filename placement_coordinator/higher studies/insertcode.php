<?php
session_start();
include('../../config.php');
$user = $_SESSION["role"];
$result = "SELECT * from placement_coordinator WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
            $branch = $row['branch'];
        }  
    }
	
if(isset($_POST['insertdata']))
{
    $year = $_POST['year'];
    $Branch = $_POST['Branch']; 
    $student_name = $_POST['student_name'];
    $institute_name_joined = $_POST['institute_name_joined'];
    $program_name_admitted = $_POST['program_name_admitted'];
    $roll_no = $_POST['roll_no'];
    $upload_admitcard_idcard = $_FILES['upload_admitcard_idcard']['name'];
    $file_tmp1 = $_FILES['upload_admitcard_idcard']['tmp_name'];
    $user_id = $_POST['user_id'];
	
    move_uploaded_file($file_tmp1,"reports/$upload_admitcard_idcard");

    $query = "INSERT INTO higher_studies
    (`year`,`Branch`,`roll_no`, `student_name`, `institute_name_joined`, `program_name_admitted`,`upload_admitcard_idcard`, `user_id`,`STATUS`) 
    VALUES ('$year','$branch','$roll_no', '$student_name', '$institute_name_joined', '$program_name_admitted', '$upload_admitcard_idcard', '$id','PENDING')";
    
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