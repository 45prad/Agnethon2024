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
       
        $Academic_Year = $_POST['Academic_Year'];
        $Branch = $_POST['Branch'];
        $Name_Of_The_Faculty= $_POST['Name_Of_The_Faculty'];
        $Details_of_Achievement = $_POST['Details_of_Achievement'];
        $other = $_POST['other'];
        $Nature_of_Achievement = $_POST['Nature_of_Achievement'];
        

        $pdffile1 = $_FILES['pdffile1']['name1'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name1'];
	   

        move_uploaded_file($file_tmp1,"certificates/$pdffile1");
	

        $query = "UPDATE facultyachievement SET Academic_Year = '$Academic_Year', Branch = '$Branch', 
        Name_Of_The_Faculty = '$Name_Of_The_Faculty', Details_of_Achievement = '$Details_of_Achievement', other = '$other', 
        Nature_of_Achievement = '$Nature_of_Achievement' WHERE id='$id' ";

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