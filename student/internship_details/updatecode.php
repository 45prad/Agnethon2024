<?php
include('../../config.php');
$user = $_SESSION["role"];

$result = "SELECT * FROM student WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
            $branch = $row['branch'];
            $division = $row['division'];
        }  
    }

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        $academic_year = $_POST['academic_year']; 
        $Name_Of_The_Student = $_POST['Name_Of_The_Student'];
    $Roll_no = $_POST['Roll_no'];
    $Branch = $_POST['Branch'];
    $division = $_POST['division'];
    $Year_Of_Study = $_POST['Year_Of_Study'];
    $Name_of_Organization = $_POST['Name_of_Organization'];
    $Organizing_Addr = $_POST['Organizing_Addr'];    
    $Dates_From = $_POST['Dates_From'];
    $Dates_To = $_POST['Dates_To'];
    $Number_of_Days_of_Internship = $_POST['Number_of_Days_of_Internship'];
   
        // $pdffile1 = $_FILES['pdffile1']['name1'];
        // $file_tmp1 = $_FILES['pdffile1']['tmp_name1'];
		$pdffile2 = $_FILES['pdffile2']['name2'];
        $file_tmp2 = $_FILES['pdffile2']['tmp_name2'];
        $pdffile3 = $_FILES['pdffile3']['name3'];
        $file_tmp3 = $_FILES['pdffile3']['tmp_name3'];
        // $user_id = $_POST['id'];

        // move_uploaded_file($file_tmp1,"certificate1/$pdffile1");
        move_uploaded_file($file_tmp2,"certificate2/$pdffile2");
        move_uploaded_file($file_tmp3,"certificate3/$pdffile3");
		// move_uploaded_file($file_tmp2,"uploadsfrontit/$pdffile2");
        
 
        $query = "UPDATE internship_details SET academic_year='$academic_year',Name_Of_The_Student = '$Name_Of_The_Student',Roll_no = '$Roll_no', Branch = '$Branch', 
        Year_Of_Study = '$Year_Of_Study', division = '$division',
        Name_of_Organization = '$Name_of_Organization',Organizing_Addr = '$Organizing_Addr',Dates_From = '$Dates_From', Dates_To = '$Dates_To', 
    Number_of_Days_of_Internship = '$Number_of_Days_of_Internship'
         WHERE id='$id'  ";

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