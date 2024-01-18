<?php
include('../../config.php');
session_start();
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
        $Name_Of_Faculty = $_POST['Name_Of_Faculty'];
        // $Branch = $_POST['Branch'];
        $Title_Of_Paper= $_POST['Title_Of_Paper'];
        $Name_Of_Author = $_POST['Name_Of_Author'];
        $Name_Of_Journal = $_POST['Name_Of_Journal'];
        $Year_Of_Publication = $_POST['Year_Of_Publication'];
        $ISSN_ISBN = $_POST['ISSN_ISBN'];
        $Link_Of_Paper = $_POST['Link_Of_Paper'];
        $Indexing = $_POST['Indexing'];
        $Details_Of_Paper = $_POST['Details_Of_Paper'];
        $Paper_Weblink = $_POST['Paper_Weblink'];
        $Journal_Paper = $_FILES['Journal_Paper']['name'];
        $file_tmp = $_FILES['Journal_Paper']['tmp_name'];
        $user_id = $_POST['user_id'];
 
        move_uploaded_file($file_tmp,"JournalPaper/$Journal_Paper");

        $query = "INSERT INTO journal_publications
        (`Academic_year`, `Name_Of_Faculty`,`Title_Of_Paper`, `Name_Of_Author`,`Branch`,  `Name_Of_Journal`, `Year_Of_Publication`,`ISSN_ISBN`, `Link_Of_Paper`,  `Indexing`,`Details_Of_Paper`,`Paper_Weblink`, `Journal_Paper`,`user_id`,`STATUS`) 
        VALUES ('$Academic_year','$Name_Of_Faculty','$Title_Of_Paper', '$Name_Of_Author',  '$branch', '$Name_Of_Journal', '$Year_Of_Publication','$ISSN_ISBN','$Link_Of_Paper','$Indexing','$Details_Of_Paper','$Paper_Weblink','$Journal_Paper','$id','PENDING')";
        
    
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