
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
            $Name_of_Faculty = $_POST['Name_of_Faculty'];
            $Nature_of_interaction= $_POST['Nature_of_interaction'];
            $Level_of_interaction = $_POST['Level_of_interaction'];
            $Details_of_interaction = $_POST['Details_of_interaction'];
            $Date_of_interaction = $_POST['Date_of_interaction'];
            $Duration = $_POST['Duration'];
            $pdffile1 = $_FILES['pdffile1']['name'];
            $file_tmp1 = $_FILES['pdffile1']['tmp_name'];
    
    
            move_uploaded_file($file_tmp1,"certificates/$pdffile1");
    
    
            $query = "UPDATE facultyinteraction SET Name_of_Faculty = '$Name_of_Faculty', Academic_Year = '$Academic_Year',Branch = '$Branch',
            Nature_of_interaction = '$Nature_of_interaction', Level_of_interaction = '$Level_of_interaction', 
            Details_of_interaction = '$Details_of_interaction', 
            Date_of_interaction = '$Date_of_interaction',  Duration = '$Duration'
            WHERE id='$id' ";
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