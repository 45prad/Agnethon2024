<?php
session_start();
include('../../config.php');
$user = $_SESSION["role"];
$result = "SELECT * FROM credentials WHERE username = '$user'";
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
    $Name_Of_The_Teacher = $_POST['Name_Of_The_Teacher'];
    $Title_Of_The_Paper= $_POST['Title_Of_The_Paper'];
    $Title_Of_The_Proceedings = $_POST['Title_Of_The_Proceedings'];
    $Name_Of_The_Conference = $_POST['Name_Of_The_Conference'];
    $National_Or_International = $_POST['National_Or_International'];
	$Year_Of_Publication = $_POST['Year_Of_Publication'];
    $ISBN_Or_ISSN_Number = $_POST['ISBN_Or_ISSN_Number'];
    $Affiliating_Institute = $_POST['Affiliating_Institute'];
    $Name_Of_Publisher = $_POST['Name_Of_Publisher'];
    $Details_Of_Paper = $_POST['Details_Of_Paper'];
    $Indexing = $_POST['Indexing'];
    $other = $_POST['other'];
    $Paper_Weblink = $_POST['Paper_Weblink'];    
	$pdffile2 = $_FILES['pdffile2']['name'];
    $file_tmp2 = $_FILES['pdffile2']['tmp_name'];
    $pdffile3 = $_FILES['pdffile3']['name'];
    $file_tmp3 = $_FILES['pdffile3']['tmp_name'];
    $user_id = $_POST['user_id'];
	move_uploaded_file($file_tmp2,"Conference_Paper/$pdffile2");
    move_uploaded_file($file_tmp3,"Conference_Certificate/$pdffile3");
    $query = "INSERT INTO conferencepublication
    (`Academic_year` ,`Name_Of_The_Teacher`, `Branch`, `Title_Of_The_Paper`, `Title_Of_The_Proceedings`,
     `Name_Of_The_Conference`, `National_Or_International`,
      `Year_Of_Publication`, `ISBN_Or_ISSN_Number`,
     `Affiliating_Institute`, `Name_Of_Publisher`, `Details_Of_Paper`, `Indexing`, `other` ,
      `Paper_Weblink`, `pdffile2`, `pdffile3`, `user_id`, `STATUS`) 
    VALUES ('$Academic_year','$Name_Of_The_Teacher', '$branch', '$Title_Of_The_Paper',
     '$Title_Of_The_Proceedings', '$Name_Of_The_Conference', '$National_Or_International',
       '$Year_Of_Publication', '$ISBN_Or_ISSN_Number', '$Affiliating_Institute',
       '$Name_Of_Publisher','$Details_Of_Paper','$Indexing','$other','$Paper_Weblink', '$pdffile2', '$pdffile3','$id','PENDING')";
    
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
