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

        $Academic_year = $_POST['Academic_year'];
        $Name_Of_The_Teacher=$_POST['Name_Of_The_Teacher'];
        $Branch = $_POST['Branch'];
        $Title_Of_Program = $_POST['Title_Of_Program'];
        $Professional_Body_Or_Organization_Associated = $_POST['Professional_Body_Or_Organization_Associated'];
        $Course_Type= $_POST['Course_Type'];
        $other= $_POST['other'];
        $Organizing_Institute_And_Location=$_POST['Organizing_Institute_And_Location'];
        $Dates_From = $_POST['Dates_From'];
        $Dates_To = $_POST['Dates_To'];
        $Duration = $_POST['Duration'];
       

        // move_uploaded_file($file_tmp1,"uploadsfdpattended1/$pdffile1");
        move_uploaded_file($file_tmp2,"uploadsfdpattended2/$pdffile2");
        
        $query = "UPDATE fdpsttpattendedit SET Academic_year = '$Academic_year', Name_Of_The_Teacher = '$Name_Of_The_Teacher', Branch = '$Branch', 
        Title_Of_Program = '$Title_Of_Program', Professional_Body_Or_Organization_Associated = '$Professional_Body_Or_Organization_Associated', Course_Type = '$Course_Type', 
        Organizing_Institute_And_Location = '$Organizing_Institute_And_Location', Dates_From = '$Dates_From',other = '$other', Dates_To = '$Dates_To', 
        Duration = '$Duration' WHERE id='$id'  ";
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