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
        
        $Academic_year = $_POST['Academic_year'];
        $Type_Research_Project_Consultancy = $_POST['Type_Research_Project_Consultancy'];
        $Name_Of_Project_Endownment = $_POST['Name_Of_The_Project_Endownment'];
        $Name_Of_Principal_Investigator_CoInvestigator = $_POST['Name_Of_The_Principal_Investigator_CoInvestigator'];
        $Department_Of_Principal_Investigator= $_POST['Department_Of_Principal_Investigator'];
        $Year_Of_Award = $_POST['Year_Of_Award'];
        $Amount_Sanctioned = $_POST['Amount_Sanctioned'];
        $Duration_Of_The_Project = $_POST['Duration_Of_The_Project'];
        $Name_Of_The_Funding_Agency = $_POST['Name_Of_The_Funding_Agency'];
        $Funding_Agency_Website_Link = $_POST['Funding_Agency_Website_Link'];
        $Type_Govt_NonGovt = $_POST['Type_Govt_NonGovt'];
        $pdffile1 = $_FILES['pdffile1']['name'];


        move_uploaded_file($file_tmp1,"uploadsindex1/$pdffile1");
		
        
 
            $query = "UPDATE researchprojectconsultancies SET 
            Academic_year = '$Academic_year',Type_Research_Project_Consultancy = '$Type_Research_Project_Consultancy', Name_Of_Project_Endownment = '$Name_Of_Project_Endownment', Name_Of_Principal_Investigator_CoInvestigator = '$Name_Of_Principal_Investigator_CoInvestigator', 
        Department_Of_Principal_Investigator = '$Department_Of_Principal_Investigator', Year_Of_Award = '$Year_Of_Award', Amount_Sanctioned = '$Amount_Sanctioned', 
        Duration_Of_The_Project = '$Duration_Of_The_Project', Name_Of_The_Funding_Agency = '$Name_Of_The_Funding_Agency', Funding_Agency_Website_Link = '$Funding_Agency_Website_Link', 
        Type_Govt_NonGovt = '$Type_Govt_NonGovt' WHERE id='$id'";
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