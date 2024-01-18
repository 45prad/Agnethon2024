<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="global.css">
</head>

<body class="bg-dark">

<header>
  <!-- Hero -->
  <div class="p-5 text-center bg-light">
    <img class="logo" src="https://i.postimg.cc/wvDjdZdp/logo.png" alt="image" width="10%">
    <h1 class="mb-3">Information Management System</h1>
    <h4 class="mb-3">(IMS-FCRIT)</h4>
    <div class="dropdown">
        <select class="btn btn-primary" name="list" onChange="window.location.href=this.value">
            <option value="">SELECT CLUB</option>
            <option value="ecell/login.php">ECELL</option>
            <option value="nss/login.php">NSS</option>
            <option value="ecoclub/login.php">Eco Club</option>
            <option value="uba/login.php">UBA</option>
            <option value="ebsb/login.php">EBSB</option>
            <option value="womencell/login.php">Women Cell</option>
            <option value="aiclub/login.php">A&I</option>
            <option value="placementcell/login.php">Placement Cell</option>
            
        </select>
    </div>
  </div>
  <!-- Hero -->
</header>
   
  <div class="footer">
    <p>Developed and Maintained by Department of Information Technology</p>
    <a href="developer-page.php">Developers</a>
  </div> 

</body>
</html>

