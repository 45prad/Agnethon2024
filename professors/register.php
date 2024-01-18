<!-- <?php 
    include('../config.php');
    session_start();

    $msg="";

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $branch = $_POST['branch'];
        $password= sha1($password);

        $emailquery = "SELECT * FROM credentials WHERE username='$username'";
        $query = mysqli_query($connection, $emailquery);

        $emailcount = mysqli_num_rows($query);

        $domainWhitelist = ['fcrit.ac.in'];
        $domainBlacklist = ['gmail.com', 'hotmail.com'];
        $domain = array_pop(explode('@', $username));
       


        if($emailcount>0){
            $msg = "Email already exists";
        } 
        else if(in_array($domain, $domainWhitelist)){
                $insertquery = "INSERT INTO credentials(username, password, branch) VALUES('$username', '$password', '$branch')";
                $iquery = mysqli_query($connection, $insertquery);

                if($iquery){
                    ?>
                    <script>
                        alert("Inserted Successfully");
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert("Not Inserted");
                    </script>
                    <?php
                }
        }

        else {
            ?>
            <script>
                alert("Please enter a valid FCRT email");
            </script>
            <?php
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="global.css">
</head>

<body class="bg-dark">
<div class="navbar">
      <img class="logo" src="https://i.postimg.cc/wvDjdZdp/logo.png" alt="image" width="3%">
      <h3 class="name">Fr. Conceicao Rodrigues Institute Of Technology</h3>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 bg-light mt-5 px-0">
                <h3 class="text-center text-light bg-secondary p-3"> Register </h3>
                <form action= "<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-4">

                    <div class="form-group"> 
                      <label> Enter Username </label>
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                    </div>

                    <div class="form-group"> 
                      <label> Enter Password </label>
                        <input type="password" id="pass" name="password" class="form-control form-control-lg" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label>Department</label>
                        <select name="branch" class="form-control" required>
                            <option name="branch" value="">--Select Department--</option>
                            <option name="branch" value="IT">IT</option>
                            <option name="branch" value="EXTC">EXTC</option>
                            <option name="branch" value="Mechanical">Mechanical</option>
                            <option name="branch" value="Computers">Computers</option>
                            <option name="branch" value="Electrical">Electrical</option>
                            <option name="branch" value="Humanities">Humanities</option>
                        </select>
                    </div>

                    <input type="checkbox" onclick="myFunction()">Show Password

                    <div class="form-group"> 
                        <input type="submit" name="register" class="btn btn-secondary btn-block">
                    </div>

                    <a href="login.php" class="text-center text-secondary">Already have an account? Login Here </a>
                    <h5 class="text-danger text-center"><?= $msg; ?> </h5>

                </form>
            </div>
        </div>
    </div>  
    <div class="footer">

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
</html> -->