<?php 
    include('../config.php');
    session_start();
   

    $msg="";

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password= sha1($password);

        $sql = "SELECT * FROM uba WHERE username=? AND password=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        session_regenerate_id();
        $_SESSION['role'] = $row['username'];
        session_write_close();

        if($row['username'] == $username && $row['password'] == $password){
            header("location:dashboard.php");
        }  
        else{
              $msg="Invalid credentials, please try again";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../global.css">

    <style>
    body {
        background-image: url('1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
</head>

<body class="bg-dark">
<div class="navbar">
      <img class="logo" src="https://i.postimg.cc/wvDjdZdp/logo.png" alt="image" width="3%">
      <h3 class="name">Fr. Conceicao Rodrigues Institute Of Technology</h3>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 bg-light mt-5 px-0">
                <h3 class="text-center text-light bg-primary p-3"> Login </h3>
                <form action= "<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-4">

                    <div class="form-group"> 
                      <label> Enter Username </label>
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                    </div>

                    <div class="form-group"> 
                      <label> Enter Password </label>
                        <input type="password" id="pass" name="password" class="form-control form-control-lg" placeholder="Password" required>
                    </div>

                    <input type="checkbox" onclick="myFunction()">Show Password

                    <div class="form-group"> 
                        <input type="submit" name="login" class="btn btn-primary btn-block">
                    </div>


                    <h5 class="text-danger text-center"><?= $msg; ?> </h5>

                </form>
            </div>
        </div>
    </div>  

<script>
    function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
    }
</script>

<?php include('../header.php'); ?>  

</body>
</html>