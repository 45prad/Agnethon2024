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
     $Branch = $_POST['Branch'];
     $division = $_POST['division'];
    $name_of_the_student= $_POST['name_of_the_student'];
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

        $pdffile1 = $_FILES['pdffile1']['name1'];
        $file_tmp1 = $_FILES['pdffile1']['tmp_name1'];
	    $pdffile2 = $_FILES['pdffile2']['name2'];
        $file_tmp2 = $_FILES['pdffile2']['tmp_name2'];
        $pdffile3 = $_FILES['pdffile3']['name3'];
        $file_tmp3 = $_FILES['pdffile3']['tmp_name3'];
       

        move_uploaded_file($file_tmp1,"IEEE_format_paper/$pdffile1");
        move_uploaded_file($file_tmp2,"certificate/$pdffile2");
        move_uploaded_file($file_tmp3,"conference_paper/$pdffile3");

        $query = "UPDATE paper_publication SET academic_year = '$academic_year', Branch = '$Branch',division = '$division', 
        name_of_the_student = '$name_of_the_student', roll_number = '$roll_number', Year_Of_Study = '$Year_Of_Study', 
        title_of_the_paper = '$title_of_the_paper',  name_of_the_conference = '$name_of_the_conference',national_or_international= '$national_or_international', ISBN_Or_ISSN_Number = '$ISBN_Or_ISSN_Number', 
        year_of_publication = '$year_of_publication',name_of_publisher = '$name_of_publisher',indexing = '$indexing', other = '$other', 
        paper_link = '$paper_link' WHERE id='$id'";
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