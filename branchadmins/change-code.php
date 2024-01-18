<?php 
include('../config.php');
session_start();
$result = "SELECT * FROM branchadmins WHERE username = '$user'";
$query = mysqli_query($connection, $result);
$queryresult = mysqli_num_rows($query); 
    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($query)){ 
            $id = $row['id'];
            $branch = $row['branch'];
            $password = $row['password'];
        }  
    }

if(isset($_POST['password_update']))
{
    $current_password = mysqli_real_escape_string($connection, sha1($_POST['current_password']));
    $new_password = mysqli_real_escape_string($connection, sha1($_POST['new_password']));
    $confirm_password = mysqli_real_escape_string($connection, sha1($_POST['confirm_password']));

}




if($current_password == $password){



               if($new_password == $confirm_password)
               {   
                // $new_password = sha1($new_password);
                $update_password = "UPDATE branchadmins SET password='$new_password' LIMIT 1";
                $update_password_run = mysqli_query($connection, $update_password);

                   if($update_password_run)
                   {
                    $_SESSION['status'] = "Successfully Updated ";
                    header("Location: login.php");
                    exit(0);  
                   }
                   else
                   {
                       $_SESSION['status'] = "Did not update password ";
                       $msg = "Username, password, or branch incorrect";
                       exit(0);  
                   }
               }
               else
               {
                   $_SESSION['status'] = "Password and Confirm password does not match ";
                   $msg = "Username, password, or branch incorrect";
                   exit(0);  
               }
            }
            else
            {
                $_SESSION['status'] = "current  password does not match ";
                exit(0);  
            }
    
?>