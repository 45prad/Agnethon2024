<?php
include('../../config.php');
$user = $_SESSION["role"];

$result = "SELECT * FROM branchadmins WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
            $branch = $row['branch'];
            
        }  
    }

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        $Year = $_POST['Year'];
        $Branch = $_POST['Branch'];
        $Registration_number = $_POST['Registration_number'];
        $Name_of_student= $_POST['Name_of_student'];
        $Name_of_exam = $_POST['Name_of_exam'];
        $other = $_POST['other'];
        $Fcrit_Roll_no = $_POST['Fcrit_Roll_no'];
        $pdffile1 = $_FILES['pdffile1']['name1'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name1'];
		// $pdffile2 = $_FILES['pdffile2']['name2'];
        // $filae_tmp2 = $_FILES['pdffile2']['tmp_name2'];

        move_uploaded_file($file_tmp1,"uploadsindexit/$pdffile1");
		// move_uploaded_file($file_tmp2,"uploadsfrontit/$pdffile2");
        // Check if the data has already been approved
    // $query_check = "SELECT STATUS FROM fdpsttporganised WHERE id='$id'";
    // $query_check_run = mysqli_query($connection, $query_check);
    // $data = mysqli_fetch_assoc($query_check_run);
    // $status = $data['STATUS'];
    // if($status == 'APPROVED'){
    //     echo '<script> alert("Data has already been approved and cannot be updated."); </script>';
    //     header("Location:index.php");
    //     exit();
    // }
        
 
    $query = "UPDATE competitiveexams SET Year='$Year', Fcrit_Roll_no='$Fcrit_Roll_no',   Registration_number = '$Registration_number', 
    Name_of_student = '$Name_of_student', Name_of_exam = '$Name_of_exam', other = '$other' WHERE id='$id'  ";

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