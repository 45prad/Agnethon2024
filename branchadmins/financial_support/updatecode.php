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
       
        $Academic_Year = $_POST['Academic_Year'];
        $Branch = $_POST['Branch'];
        $Name_Of_The_Teacher = $_POST['Name_Of_The_Teacher'];
        $Title_Of_Program = $_POST['Title_Of_Program'];
        $Activity_Name = $_POST['Activity_Name'];
        $Other_Activity = $_POST['Other_Activity'];
        $Dates_From = $_POST['Dates_From'];
        $Dates_To = $_POST['Dates_To'];
        $Name_Of_Activity = $_POST['Name_Of_Activity'];
        $Amount_Of_Support = $_POST['Amount_Of_Support'];
        $pdffile1 = $_FILES['pdffile1']['name1'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name1'];
		// $pdffile2 = $_FILES['pdffile2']['name2'];
        // $file_tmp2 = $_FILES['pdffile2']['tmp_name2'];

        move_uploaded_file($file_tmp1,"../../professors/financial_support/documents/$pdffile1");
		// move_uploaded_file($file_tmp2,"../../professors/book-chapters/uploadsfrontit/$pdffile2");
        
 
            $query = "UPDATE financial_support SET Academic_Year = '$Academic_Year', Branch = '$Branch', 
        Name_Of_The_Teacher = '$Name_Of_The_Teacher', Title_Of_Program = '$Title_Of_Program', Activity_Name = '$Activity_Name', 
        Other_Activity = '$Other_Activity', Dates_From = '$Dates_From', Dates_To = '$Dates_To', 
        Name_Of_Activity = '$Name_Of_Activity', Amount_Of_Support = '$Amount_Of_Support' WHERE id='$id'  ";
         $query_check_run = mysqli_query($connection, $query_check);
         $data = mysqli_fetch_assoc($query_check_run);
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