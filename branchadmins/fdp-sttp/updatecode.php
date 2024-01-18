<?php
include('../../config.php');

if(isset($_POST['updatedata']))
{   
    $id = $_POST['update_id'];
   
    $Academic_year = $_POST['Academic_year'];
    $Title_Of_Program= $_POST['Title_Of_Program'];
    $Approving_Body = $_POST['Approving_Body'];
    $Grant_Amount = $_POST['Grant_Amount'];
    $Convener_Of_FDP_STTP = $_POST['Convener_Of_FDP_STTP'];
    $Dates_From = $_POST['Dates_From'];
    $Dates_To = $_POST['Dates_To'];
    $Total_No_Of_Days = $_POST['Total_No_Of_Days'];
    $No_Of_Participants = $_POST['No_Of_Participants'];
    $Branch = $_POST['Branch'];
    $pdffile = $_FILES['pdffile']['name'];
    $file_tmp = $_FILES['pdffile']['tmp_name'];

    move_uploaded_file($file_tmp,"uploadsfdporganised/$pdffile");
     $query_check = "SELECT STATUS FROM fdpsttporganised WHERE id='$id'";
    // $query_check_run = mysqli_query($connection, $query_check);
    // $data = mysqli_fetch_assoc($query_check_run);
    // $status = $data['STATUS'];
    // if($status == 'APPROVED'){
    //     echo '<script> alert("Data has already been approved and cannot be updated."); </script>';
    //     header("Location:index.php");
    //     exit();
    // }

    // // Check if the data has already been approved
    // $query_check = "SELECT STATUS FROM fdpsttporganised WHERE id='$id'";
    // $query_check_run = mysqli_query($connection, $query_check);
    // $data = mysqli_fetch_assoc($query_check_run);
    // $status = $data['STATUS'];
    // if($status == 'APPROVED'){
    //     echo '<script> alert("Data has already been approved and cannot be updated."); </script>';
    //     header("Location:index.php");
    //     exit();
    // }
    
    $query = "UPDATE fdpsttporganised SET Academic_year = '$Academic_year', Branch = '$Branch', 
    Title_Of_Program = '$Title_Of_Program', Approving_Body = '$Approving_Body', Grant_Amount = '$Grant_Amount', 
    Convener_Of_FDP_STTP = '$Convener_Of_FDP_STTP', Dates_From = '$Dates_From', Dates_To = '$Dates_To', 
    Total_No_Of_Days = '$Total_No_Of_Days', No_Of_Participants = '$No_Of_Participants',  pdffile= '$pdffile' WHERE id='$id'  ";
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
