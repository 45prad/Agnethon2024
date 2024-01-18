<?php 
include('../config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function send_password_reset($get_username,$get_email,$token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'adityadhumal450@gmail.com';                     //SMTP username
    $mail->Password   = 'biomesebcfhgnocx';                               //SMTP password

    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('adityadhumal45060@gmail.com', $get_username);
    $mail->addAddress($get_email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $mail->isHTML(true);
    $mail->Subject = "Reset password";

    $email_template = "
    <h2>Hello</h2>
    <h3>to change password</h3>
    <br/>
    <a href='https://ims.fcrit.ac.in/student/password-change.php?token=$token&email=$get_email'>Click me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();

}

if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $token =md5(rand());

    $check_email = "SELECT email FROM student WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($connection, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
         $row = mysqli_fetch_array($check_email_run);
         $get_username = $row['username'];
         $get_email = $row['email'];

         $update_token = "UPDATE student SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
         $update_token_run = mysqli_query($connection, $update_token);

         if($update_token_run)
         {
              send_password_reset($get_username,$get_email,$token);
              $_SESSION['status'] = "WE emailed link";
              header("Location: password-reset.php");
              exit(0);
         }
         else
         {
            $_SESSION['status'] = "Something went wrong. #1";
            header("Location: password-reset.php");
            exit(0); 
         }

    }
    else{
        $_SESSION['status'] = "No email found";
        header("Location: password-reset.php");
        exit(0);
    }
}
if(isset($_POST['password_update']))
{
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $new_password = mysqli_real_escape_string($connection, sha1($_POST['new_password']));
    $confirm_password = mysqli_real_escape_string($connection, sha1($_POST['confirm_password']));
    $token = mysqli_real_escape_string($connection, $_POST['password_token']);
}

if(!empty($token))
{
    if(!empty($token) && !empty($new_password) && !empty($confirm_password))
    {
        //Checking token valid or not
        $check_token = "SELECT verify_token FROM student WHERE verify_token='$token' LIMIT 1";
        $check_token_run = mysqli_query($connection, $check_token);

        if(mysqli_num_rows($check_token_run) > 0)
        {
               if($new_password == $confirm_password)
               {   
                // $new_password = sha1($new_password);
                $update_password = "UPDATE student SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
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
                       header("Location: password-change.php?token=$token&email=$email");
                       exit(0);  
                   }
               }
               else
               {
                   $_SESSION['status'] = "Password and Confirm password does not match ";
                   $msg = "Username, password, or branch incorrect";
                   header("Location: password-change.php?token=$token&email=$email");
                   exit(0);  
               }
        }
        else
        {
            $_SESSION['status'] = "Invalid Token ";
            header("Location: password-change.php?token=$token&email=$email");
            $msg = "Username, password, or branch incorrect";
            exit(0);  
        }
    }
    else
    {
        $_SESSION['status'] = "All filled are Mandatory ";
        header("Location: password-change.php?token=$token&email=$email");
        $msg = "Username, password, or branch incorrect";
        exit(0);  
    }
}
else
{
    $_SESSION['status'] = "No token available";

    header("Location: password-change.php");
    exit(0);  
}
?>