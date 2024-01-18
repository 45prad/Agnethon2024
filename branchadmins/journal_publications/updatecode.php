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
        $Name_Of_Faculty = $_POST['Name_Of_Faculty'];
        
        $Title_Of_Paper= $_POST['Title_Of_Paper'];
        $Name_Of_Author = $_POST['Name_Of_Author'];
        $Branch = $_POST['Branch'];
        $Name_Of_Journal = $_POST['Name_Of_Journal'];
        $Year_Of_Publication = $_POST['Year_Of_Publication'];
        $ISSN_ISBN = $_POST['ISSN_ISBN'];
        $Link_Of_Paper = $_POST['Link_Of_Paper'];
        $Indexing = $_POST['Indexing'];
        $Details_Of_Paper = $_POST['Details_Of_Paper'];
        $Paper_Weblink = $_POST['Paper_Weblink'];
        $Journal_Paper = $_FILES['Journal_Paper']['name'];
        $image_tmp = $_FILES['Journal_Paper']['tmp_name'];        

        move_uploaded_file($image_tmp,"JournalPaper/$Journal_Paper");

        $query = "UPDATE journal_publications SET 
        Academic_year = '$Academic_year', Name_Of_Faculty = '$Name_Of_Faculty', Branch = '$Branch',
        Title_Of_Paper = '$Title_Of_Paper', Name_Of_Author = '$Name_Of_Author', Name_Of_Journal = '$Name_Of_Journal', Year_Of_Publication = '$Year_Of_Publication',ISSN_ISBN = '$ISSN_ISBN',
        Link_Of_Paper = '$Link_Of_Paper', Indexing = '$Indexing', Details_Of_Paper = '$Details_Of_Paper',Paper_Weblink = '$Paper_Weblink' WHERE id='$id'  ";
        
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