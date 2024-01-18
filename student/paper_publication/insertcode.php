<?php
session_start();
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
	//hello
if(isset($_POST['insertdata']))
{
    $academic_year = $_POST['academic_year'];
    // $Branch = $_POST['Branch'];
    $name_of_the_student= $_POST['name_of_the_student'];
    //$division= $_POST['division'];
    $roll_number = $_POST['roll_number'];
    $Year_Of_Study = $_POST['Year_Of_Study'];
    $title_of_the_paper = $_POST['title_of_the_paper'];
    $name_of_the_conference = $_POST['name_of_the_conference'];
	$national_or_international = $_POST['national_or_international'];
    $ISBN_Or_ISSN_Number = $_POST['ISBN_Or_ISSN_Number'];
    $year_of_publication = $_POST['year_of_publication'];
    $name_of_publisher = $_POST['name_of_publisher'];
    $indexing = $_POST['indexing'];
    $other = $_POST['other'];
    $paper_link = $_POST['paper_link'];
    

    $pdffile1 = $_FILES['pdffile1']['name'];
    $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
	$pdffile2 = $_FILES['pdffile2']['name'];
    $file_tmp2 = $_FILES['pdffile2']['tmp_name'];
    $pdffile3 = $_FILES['pdffile3']['name'];
    $file_tmp3 = $_FILES['pdffile3']['tmp_name'];
    $user_id = $_POST['user_id'];
	
    move_uploaded_file($file_tmp1,"IEEE_format_paper/$pdffile1");
	move_uploaded_file($file_tmp2,"certificate/$pdffile2");
    move_uploaded_file($file_tmp3,"conference_paper/$pdffile3");


    $query = "INSERT INTO paper_publication
    (`academic_year`, `Branch`,`division`, `name_of_the_student`, `roll_number`, `Year_Of_Study`, `title_of_the_paper`, `name_of_the_conference`, `national_or_international`, `ISBN_Or_ISSN_Number`, `year_of_publication`, `name_of_publisher`, `indexing`, `other`,`paper_link`, `pdffile1`, `pdffile2`, `pdffile3`,`user_id`,`STATUS`) 
    VALUES ('$academic_year', '$branch','$division', '$name_of_the_student', '$roll_number', '$Year_Of_Study', '$title_of_the_paper', '$name_of_the_conference', '$national_or_international', '$ISBN_Or_ISSN_Number', '$year_of_publication', '$name_of_publisher', '$indexing', '$other','$paper_link', '$pdffile1', '$pdffile2', '$pdffile3','$id','PENDING')";
    
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
