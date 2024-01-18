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
       
        $Name_of_Activity = $_POST['Name_of_Activity'];
        $Organizing_Unit = $_POST['Organizing_Unit'];
        $Name_of_Coordinators= $_POST['Name_of_Coordinators'];
        $Name_Of_Scheme = $_POST['Name_Of_Scheme'];
        $Dates_Conducted = $_POST['Dates_Conducted'];
        $Year_of_Activity = $_POST['Year_of_Activity'];
        $No_of_Student_Volunteer_for_Activity = $_POST['No_of_Student_Volunteer_for_Activity'];
        $No_of_People_benefitted_by_Activity = $_POST['No_of_People_benefitted_by_Activity'];
        $pdffile1 = $_FILES['pdffile1']['name'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name'];

        move_uploaded_file($file_tmp1,"Reports/$pdffile1");
		
        
 
            $query = "UPDATE outreachprogram SET Name_of_Activity = '$Name_of_Activity', Organizing_Unit = '$Organizing_Unit', 
        Name_of_Coordinators = '$Name_of_Coordinators', Name_Of_Scheme = '$Name_Of_Scheme',
        Dates_Conducted = '$Dates_Conducted', Year_of_Activity = '$Year_of_Activity', No_of_Student_Volunteer_for_Activity = '$No_of_Student_Volunteer_for_Activity', 
        No_of_People_benefitted_by_Activity = '$No_of_People_benefitted_by_Activity' WHERE id='$id'  ";

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