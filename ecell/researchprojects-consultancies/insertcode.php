<?php
include('../../config.php');
session_start();
$user = $_SESSION["role"];
$result = "SELECT * FROM ecell WHERE username = '$user'";
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
    $Academic_year = $_POST['Academic_year'];
    $Type_Research_Project_Consultancy = $_POST['Type_Research_Project_Consultancy'];
    $Name_Of_Project_Endownment = $_POST['Name_Of_Project_Endownment'];
    $Name_Of_Principal_Investigator_CoInvestigator = $_POST['Name_Of_Principal_Investigator_CoInvestigator'];
    $Department_Of_Principal_Investigator= $_POST['Department_Of_Principal_Investigator'];
    $Year_Of_Award = $_POST['Year_Of_Award'];
    $Amount_Sanctioned = $_POST['Amount_Sanctioned'];
    $Duration_Of_The_Project = $_POST['Duration_Of_The_Project'];
    $Name_Of_The_Funding_Agency = $_POST['Name_Of_The_Funding_Agency'];
    $Funding_Agency_Website_Link = $_POST['Funding_Agency_Website_Link'];
    $Type_Govt_NonGovt = $_POST['Type_Govt_NonGovt'];
    $pdffile1 = $_FILES['pdffile1']['name'];
    $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
    $user_id = $_POST['user_id'];
    //$branch = $_POST['branch'];

        move_uploaded_file($file_tmp1,"uploadsindex1/$pdffile1");
	 

    $query = "INSERT INTO researchprojectconsultancies
    (`Academic_year`,`Type_Research_Project_Consultancy`,`Name_Of_Project_Endownment`, `Name_Of_Principal_Investigator_CoInvestigator`, `Department_Of_Principal_Investigator`, `Year_Of_Award`,
     `Amount_Sanctioned`, `Duration_Of_The_Project`, `Name_Of_The_Funding_Agency`, `Funding_Agency_Website_Link`, 
     `Type_Govt_NonGovt`, `pdffile1`, `user_id`, `STATUS`,`branch`) 
    VALUES ('$Academic_year','$Type_Research_Project_Consultancy','$Name_Of_Project_Endownment', '$Name_Of_Principal_Investigator_CoInvestigator', '$Department_Of_Principal_Investigator', '$Year_Of_Award', 
    '$Amount_Sanctioned', '$Duration_Of_The_Project', '$Name_Of_The_Funding_Agency', '$Funding_Agency_Website_Link', '$Type_Govt_NonGovt', '$pdffile1', '$id','PENDING','$branch')";
    
    
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