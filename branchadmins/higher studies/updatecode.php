<?php
include('../../config.php');
$user = $_SESSION["role"];

$result = "SELECT * FROM branchadmins WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
        }  
    }

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        $year = $_POST['year'];
        $Branch = $_POST['Branch'];
        $roll_no = $_POST['roll_no'];
        $student_name = $_POST['student_name'];
        $institute_name_joined = $_POST['institute_name_joined'];
        $program_name_admitted = $_POST['program_name_admitted'];
        $upload_admitcard_idcard = $_FILES['upload_admitcard_idcard']['name'];
        $file_tmp1 = $_FILES['upload_admitcard_idcard']['tmp_name'];
        $user_id = $_POST['user_id'];
     
        move_uploaded_file($file_tmp1,"reports/$upload_admitcard_idcard");
		// move_uploaded_file($file_tmp2,"uploadsfrontit/$pdffile2");
        // Check if the data has already been approved
     
        $query = "UPDATE higher_studies SET Branch = '$Branch',roll_no = '$roll_no', student_name = '$student_name', 
        institute_name_joined = '$institute_name_joined', program_name_admitted = '$program_name_admitted', year = '$year' WHERE id='$id'";

        //$query_check_run = mysqli_query($connection, $query_check);
        //$data = mysqli_fetch_assoc($query_check_run);
        $status = $data['STATUS'];
        if($status == 'APPROVED'){
            echo '<script> alert("Data has already been approved and cannot be updated."); </script>';
            header("Location:index.php");
            exit();
        }


        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:index.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>