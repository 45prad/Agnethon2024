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
    <link rel="icon" type="image/jpg" href="/fcrit.jpg">

    <style>
.logo {
    opacity: 0;
    transform: scale(0.5);
    transition: opacity 1.5s, transform 1.5s; /* Increased transition duration */
}

.logo.show {
    opacity: 1;
    transform: scale(1);
}
</style>

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
            <option value="">SELECT ROLE</option>
            <option value="professors/login.php">Faculty</option>
            <option value="branchadmins/login.php">Branch Admin</option>
            <option value="placement_coordinator/login.php">Dept Placement Coordinator</option>
            <option value="activity_coordinator/login.php">Dept Activity Coordinator</option>
            <option value="placementcell/login.php">Placement Cell</option>
            <option value="superadmin/login.php">Super Admin</option>
            <option value="clubs_index.php">Clubs</option>
            <option value="clubadmin/login.php">Club Admin</option>
            <option value="student/login.php">Student</option>
            <option value="studentadmin/login.php">Class Teacher</option>
        </select>
    </div>
  </div>
  <!-- Hero -->
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var logo = document.querySelector(".logo");
        logo.classList.add("show");
    });
</script>
   
  <div class="footer">
    <p>Developed and Maintained by Department of Information Technology</p>
    <a href="developer-page.php">Developers</a>
  </div> 

</body>
</html>

