<?php 
include('../../config.php');
session_start();
?>

<!DOCTYPE html> 

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Student Achievement Activities </title>

    <link rel="stylesheet" href="styles.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body>

<?php include('../../header.php'); ?>

 <!-- main card -->
 <!-- buttons and search buttoncard -->
            <div class="card">
                <div class="card-body">
                
            <div class="card-body mt-5">
                <h2> Student Achievement Activities </h2>
            </div>
            <?php 
if ($_SESSION["role"] == true) {
    echo '<form action="https://ims.fcrit.ac.in/studentadmin/dashboard.php" method="post" style="position: absolute; top: 100px; right: 70px;">
            <button type="submit" class="btn btn-primary" style="background-color: blue; color: white;">HOME</button>
          </form>';
    
    echo '<div style="position: absolute; top: 100px; right: 200px; font-weight: bold; color: #007bff;">Welcome ' . $_SESSION["role"] . '<br><span style="color: #008000;">You logged in as Student Admin</span></div>';
} else {
    header("Location: index.php"); 
}
?>

            <div class="card">
                <div class="card-body btn-group">

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" onclick="exportTableToCSVuser('USerData_StudentAchievementActivities.csv')" class="btn btn-success">Export to excel</button>
			</form> &nbsp; &nbsp; 
        
            <form method="post">
                <label>Search</label>
                <input type="text" name="search">
                <input type="submit" name="submit">
            </form>
            </div>
            </div>

           <!-- table -->
<div id="tabledataid" class="card">
    <div class="card-body">
        <!-- th change -->
        <table id="datatableid" class="table table-bordered table-dark mt-2">
        <thead>
                            <tr>
                            <th scope="col"> ID </th>
                                <th scope="col"> ACADEMIC YEAR (JULY 1st -JUNE 30th )</th>
                                <th scope="col"> NAME OF STUDENT </th>
                                <th scope="col"> ROLL NUMBER </th>
                                <th scope="col"> DEPARTMENT </th>
                                <th scope="col"> DIVISION </th>
                                <th scope="col"> YEAR OF STUDY </th>
                                <th scope="col"> EXTRACURRICULAR/ COCURRICULAR </th>
                                <th scope="col"> TYPE OF THE ACTIVITY </th>
                                <th scope="col"> LEVEL </th>
                                <th scope="col"> NAME  & DETAILS OF THE ACTIVITY </th>
                                <th scope="col"> ORGANIZING INSTITUTE/BODY AND ITS LOCATION </th>
                                <th scope="col"> AWARDS WON/ PARTICIPATION </th>
								<th scope="col"> DATE (FROM) </th>
                                <th scope="col"> DATE (TO) </th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS</th>
                               
                            </tr>
                        </thead>
                        
            <?php
            $user = $_SESSION["role"];

            $result = "SELECT * FROM studentadmins WHERE username = '$user'";

            $query = mysqli_query($connection, $result);
            $queryresult = mysqli_num_rows($query);
            if ($queryresult > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $id = $row['id'];
                    $branch = trim($row['branch']);
                    $Year_Of_Study = trim($row['Year_Of_Study']);
                    $division = trim($row['division']);

                }
            }

            $table_query = "SELECT * FROM achievement WHERE Branch = '$branch' AND Year_Of_Study = '$Year_Of_Study' AND division = '$division' ORDER BY Roll_no ASC";

            $query_run = mysqli_query($connection, $table_query);
            $query_result = mysqli_num_rows($query_run); ?>

            <?php if ($query_result > 0) {
                while ($developer = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <tbody> <!-- change -->
                        <tr>
                        <td> <?php echo $developer['id']; ?> </td>
                                <td> <?php echo $developer['Academic_year']; ?> </td> 
                                <td> <?php echo $developer['Name_Of_The_Student']; ?> </td>
                                <td> <?php echo $developer['Roll_no']; ?> </td> 
                                <td> <?php echo $developer['Branch']; ?> </td>
                                <td> <?php echo $developer['division']; ?> </td>
                                <td> <?php echo $developer['Year_Of_Study']; ?> </td>
                                <td> <?php echo $developer['Extracurricular_Or_Cocurricular']; ?> </td>
                                <td> <?php echo $developer['Type_Of_The_Activity']; ?> </td>
                                <td> <?php echo $developer['Level']; ?> </td>
                                <td> <?php echo $developer['Name_Of_Activity']; ?> </td>
                                <td> <?php echo $developer['Organizing_Body']; ?> </td>
                                <td> <?php echo $developer['Award_Or_Participation']; ?> </td>
                                <td> <?php echo $developer['Dates_From']; ?> </td>
                                <td> <?php echo $developer['Dates_To']; ?> </td>
                            <td>
                                <a href="../../student/achievement_activities/certificates/<?php echo $developer['pdffile1']; ?>" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                                <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                            <td>
                            <?php if ($developer['STATUS'] == 'PENDING') { ?>
                                    <form method="POST" action="approved.php">
                                        <input type="hidden" name="id" value="<?php echo $developer['id']; ?>">
                                        <input type="submit" name="approve" value="Approve">
                                    </form>
                                    <form method="post" action="reject.php">
                                        <input type="hidden" name="id" value="<?php echo $developer['id']; ?>">
                                        <button type="submit" name="reject" class="btn btn-danger">Send Back</button>
                                    </form>
                                <?php } elseif ($developer['STATUS'] == 'Sent Back') { ?>
                                    <?php echo $developer['STATUS']; ?>
                                    <form method="POST" action="approve-now.php">
                                        <input type="hidden" name="id" value="<?php echo $developer['id']; ?>">
                                        <input type="submit" name="approve_now" value="Approve Now">
                                    </form>
                                <?php } else { ?>
                                    <?php echo $developer['STATUS']; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
            } else {
                echo "No Record Found";
            }
            ?>
        </table>

        <?php
        // Approve button logic
        if (isset($_POST['approve'])) {
            $id = $_POST['id'];
            $select = "UPDATE achievement SET STATUS ='APPROVED' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Approved";
            header("Location: index.php");
        }

        // Reject button logic
        if (isset($_POST['reject'])) {
            $id = $_POST['id'];
            $select = "UPDATE achievement SET STATUS ='Sent Back' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Rejected";
            header("Location: index.php");
        }

        // Approve Now button logic
if (isset($_POST['approve_now'])) {
    $id = $_POST['id'];
    $select = "UPDATE achievement SET STATUS ='APPROVED' WHERE id='$id'";
    $result = mysqli_query($connection, $select);
    echo "Data Approved";
    header("Location: index.php");
}
        ?>
    </div>
</div>

      <!-- DELETE POP UP FORM  -->
    <!-- dont make changes-->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes, Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
   
   <!-- EDIT POP UP FORM  -->
    <!-- this is edit data form Make changes to variables and placeholder, keep same variables -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Data </h5> &nbsp;
                    <h5 class="modal-title" id="exampleModalLabel"> (Please enter the data again)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="updatecode.php" method="POST">

                    <div class="modal-body">

                    

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label>Academic Year (July 1st -June 30th)*</label>
                            <select  name="Academic_year"
                              class="form-control" id="Academic_year" required>
                                <option value="">--Select Year--</option>
                                <option name="Academic_year" value="2019-20">2019-20</option>
                                <option name="Academic_year" value="2020-21">2020-21</option>
                                <option name="Academic_year" value="2021-22">2021-22</option>
                                <option name="Academic_year" value="2021-22">2022-23</option>
                                <option name="Academic_year" value="2021-22">2023-24</option>
                                <option name="Academic_year" value="2021-22">2024-25</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Name of the Student*</label>
                            <input type="text" id="Name_Of_The_Student" name="Name_Of_The_Student" class="form-control"  required>
                        </div>

                        <div class="form-group">
                            <label> Roll Number* </label>
                            <input type="text" id="Roll_no" name="Roll_no" class="form-control" required>
                        </div>


                        <div class="form-group">
    <label>Department</label>
    <select name="Branch" class="form-control" disabled required >
        <option value="">--Select Department--</option>
        <?php
        // Retrieve the department information from the session or any other method
        $branch = $_SESSION['branch']; 

       $branches = array("IT", "EXTC", "Mechanical", "Computers", "Electrical", "Humanities");
foreach ($branches as $branchOption) {
    $selected = ($branchOption == $branch) ? 'selected="selected"' : '';
    echo '<option value="' . $branchOption . '" ' . $selected . '>' . $branchOption . '</option>';
}

        ?>
    </select>
</div>

<div class="form-group">
    <label>Division</label>
    <select name="division" class="form-control" disabled required >
        <option value="">--Select Division--</option>
        <?php
        // Retrieve the division information from the session or any other method
        $division = $_SESSION['division'];

        $divisions = array("A","B","C");
        foreach ($divisions as $divisionOption) {
            $selected = ($divisionOption == $division) ? 'selected="selected"' : '';
            echo '<option value="' . $divisionOption . '" ' . $selected . '>' . $divisionOption . '</option>';
        }
        ?>
    </select>
</div>


<div class="form-group">
                            <label>Year of Study*</label>
                            <select  name="Year_Of_Study"  class="form-control" id="Year_Of_Study" required>
                                <option value="">--Select Year--</option>
                                <option name="Year_Of_Study" value="FE">FE</option>
                                <option name="Year_Of_Study" value="SE">SE</option>
                                <option name="Year_Of_Study" value="TE">TE</option>
                                <option name="Year_Of_Study" value="BE">BE</option>
                               </select>
                        </div>

                        <div class="form-group">
        <label>Select Type of Activity*</label>
        <select id="activityType" name="Extracurricular_Or_Cocurricular" class="form-control" required>
            <option value="">--Select Type of Activity--</option>
            <option value="Extracurricular">Extracurricular</option>
            <option value="Cocurricular">Cocurricular</option>
        </select>
    </div>

    <div class="form-group" id="extracurricularDropdown" style="display: none;">
        <label>Select Extracurricular Activity*</label>
        <select name="Extracurricular_Type" class="form-control">
        <option value="">--Select Extracurricular Activity--</option>
            <option value="Cultural">Cultural</option>
            <option value="Sports">Sports</option>
            <option value="Societal">Societal</option>
        </select>
        <input type="text" name="Extracurricular_Other" class="form-control" placeholder="Specify Other" style="display: none;">
    </div>

    <div class="form-group" id="cocurricularDropdown" style="display: none;">
        <label>Select Cocurricular Activity*</label>
        <select name="Cocurricular_Type" class="form-control">
        <option value="">--Select Cocurricular Activity--</option>
            <option value="Technical">Technical Competition</option>
            <option value="Project">Project Competition</option>
            <option value="Award">Academic Awards/Prizes</option>
        </select>
        
        <input type="text" name="Cocurricular_Other" class="form-control" placeholder="Specify Other" style="display: none;">
    </div>

    <div class="form-group">
        <label>Type of the Activity*</label>
        <input type="text" id="Type_Of_The_Activity" name="Type_Of_The_Activity" class="form-control"  required disabled>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const activityTypeDropdown = document.getElementById("activityType");
            const extracurricularDropdown = document.getElementById("extracurricularDropdown");
            const cocurricularDropdown = document.getElementById("cocurricularDropdown");
            const typeOfActivityInput = document.getElementById("Type_Of_The_Activity");

            // Function to update the text input and "Specify Other" input visibility based on the selected dropdown
            function updateTypeOfActivity() {
                const extracurricularTypeDropdown = extracurricularDropdown.querySelector("select[name='Extracurricular_Type']");
                const cocurricularTypeDropdown = cocurricularDropdown.querySelector("select[name='Cocurricular_Type']");
                const extracurricularOtherInput = extracurricularDropdown.querySelector("input[name='Extracurricular_Other']");
                const cocurricularOtherInput = cocurricularDropdown.querySelector("input[name='Cocurricular_Other']");

                if (activityTypeDropdown.value === "Extracurricular") {
                    extracurricularDropdown.style.display = "block";
                    cocurricularDropdown.style.display = "none";
                    typeOfActivityInput.value = extracurricularTypeDropdown.value;
                } else if (activityTypeDropdown.value === "Cocurricular") {
                    extracurricularDropdown.style.display = "none";
                    cocurricularDropdown.style.display = "block";
                    typeOfActivityInput.value = cocurricularTypeDropdown.value;
                } else {
                    extracurricularDropdown.style.display = "none";
                    cocurricularDropdown.style.display = "none";
                    typeOfActivityInput.value = "";
                }

                // Show/hide "Specify Other" input based on the selected option
                extracurricularOtherInput.style.display = extracurricularTypeDropdown.value === "Other" ? "block" : "none";
                cocurricularOtherInput.style.display = cocurricularTypeDropdown.value === "Other" ? "block" : "none";
            }

            // Add event listener to update the text input and "Specify Other" input visibility when dropdowns change
            activityTypeDropdown.addEventListener("change", updateTypeOfActivity);
            extracurricularDropdown.querySelector("select[name='Extracurricular_Type']").addEventListener("change", updateTypeOfActivity);
            cocurricularDropdown.querySelector("select[name='Cocurricular_Type']").addEventListener("change", updateTypeOfActivity);

            // Initially, call updateTypeOfActivity to set the initial state
            updateTypeOfActivity();
        });


// Function to update the text input and "Specify Other" input visibility based on the selected dropdown
function updateTypeOfActivity() {
    const extracurricularTypeDropdown = extracurricularDropdown.querySelector("select[name='Extracurricular_Type']");
    const cocurricularTypeDropdown = cocurricularDropdown.querySelector("select[name='Cocurricular_Type']");
    const extracurricularOtherInput = extracurricularDropdown.querySelector("input[name='Extracurricular_Other']");
    const cocurricularOtherInput = cocurricularDropdown.querySelector("input[name='Cocurricular_Other']");

    if (activityTypeDropdown.value === "Extracurricular") {
        extracurricularDropdown.style.display = "block";
        cocurricularDropdown.style.display = "none";
        typeOfActivityInput.value = extracurricularTypeDropdown.value;
    } else if (activityTypeDropdown.value === "Cocurricular") {
        extracurricularDropdown.style.display = "none";
        cocurricularDropdown.style.display = "block";
        typeOfActivityInput.value = cocurricularTypeDropdown.value;
    } else {
        extracurricularDropdown.style.display = "none";
        cocurricularDropdown.style.display = "none";
        typeOfActivityInput.value = "";
    }

    // Show/hide "Specify Other" input based on the selected option
    extracurricularOtherInput.style.display = extracurricularTypeDropdown.value === "Other" ? "block" : "none";
    cocurricularOtherInput.style.display = cocurricularTypeDropdown.value === "Other" ? "block" : "none";

    // Update "Type of the Activity" with the content of "Specify Other"
    if (extracurricularTypeDropdown.value === "Other") {
        typeOfActivityInput.value = extracurricularOtherInput.value;
    }
    if (cocurricularTypeDropdown.value === "Other") {
        typeOfActivityInput.value = cocurricularOtherInput.value;
    }
}

</script>

<div class="form-group">
                            <label>Level</label>
                            <select name="Level"  id = "Level" name ="Level" class="form-control" >
                                <option value="">--Select Level--</option>
                                <option name="Level" value="Inter-Departement">Inter-Department</option>
                                <option name="Level" value="Inter-College">Inter-College</option>
                                <option name="Level" value="State">State</option>
                                <option name="Level" value="National">National</option>
                                <option name="Level" value="Inter-National">Inter-National</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Name/Detail of Activity* </label>
                            <input type="text" id="Name_Of_Activity" name="Name_Of_Activity" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label> Organizing Insititute/ Body and its location* </label>
                            <input type="text" id="Organizing_Body" name="Organizing_Body" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Awards Won/Participation*</label>
                            <select id="Award_Or_Participation" name="Award_Or_Participation" class="form-control"  required>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="First Prize">First Prize</option>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="Second Prize">Second Prize</option>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="Third Prize">Third Prize</option>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="Participation">Participation</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Starting Date* </label>
                            <input type="date"  name="Dates_From" id="Dates_From" class="form-control" max="<?php echo date('Y-m-d'); ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Ending Date* </label>
                            <input type="date"  name="Dates_To" id="Dates_To" class="form-control" max="<?php echo date('Y-m-d'); ?>"required>
                        </div>
                        
						

                            

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
   
<!--Search data -->
<div id="srch" class="card-body">
                <h4> Search Data </h4>
                    <table class="table table-bordered ">
                    <thead>
                    <tr>
                    <th> ID </th>
                                <th> ACADEMIC YEAR (JULY 1st -JUNE 30th )</th>
                                <th> NAME OF STUDENT </th>
                                <th> ROLL NUMBER </th>
                                <th> DEPARTMENT </th>
                                <th> DIVISION </th>
                                <th> YEAR OF STUDY </th>
                                <th> EXTRACURRICULAR/ COCURRICULAR </th>
                                <th> TYPE OF THE ACTIVITY </th>
                                <th> LEVEL </th>
                                <th> NAME  & DETAILS OF THE ACTIVITY </th>
                                <th> ORGANIZING INSTITUTE/BODY AND ITS LOCATION </th>
                                <th> AWARDS WON/ PARTICIPATION </th>
                                <th> DATE (FROM) </th>
                                <th> DATE (TO) </th>
                                <th> ACTION </th>
                                <th> STATUS</th>
                               
                            </tr>

                        </thead>   
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `achievement` WHERE Branch = '$branch' AND  division = '$divivsion' AND ( division LIKE '%$str%' OR  Roll_no LIKE '%$str%' OR Name_Of_The_Student LIKE '%$str%' OR Year_Of_Study LIKE '%$str%'  OR Extracurricular_Or_Cocurricular LIKE '%$str%' OR Name_Of_Activity LIKE '$str' OR Type_Of_The_Activity LIKE '%$str%'
        OR Level LIKE '%$str%' OR Organizing_Body LIKE '%$str%' OR Award_Or_Participation LIKE '%$str%' OR Dates_From LIKE '%$str%' OR Dates_To LIKE '%$str%' OR STATUS LIKE '$str' ) ";
        
        $result = mysqli_query($connection, $sth);
        $queryresult = mysqli_num_rows($result); ?>

                    <div class="card">
                        <div class="card-body btn-group">
                        <div> Results- </div> &nbsp; &nbsp;
                        <button class="btn btn-success" onclick="exportTableToCSV('Search_Data.csv')"> Export Data </button>
                        </div>
                    </div>
                    
                    <?php if($queryresult > 0){
                while($row = mysqli_fetch_assoc($result)){   
                    ?>
                    <tbody id="srch"> 
             
                    <tr>                
                       
                    <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['Academic_year']; ?> </td> 
                                <td> <?php echo $row['Name_Of_The_Student']; ?> </td>
                                <td> <?php echo $row['Roll_no']; ?> </td> 
                                <td> <?php echo $row['Branch']; ?> </td>
                                <td> <?php echo $row['division']; ?> </td>
                                <td> <?php echo $row['Year_Of_Study']; ?> </td>
                                <td> <?php echo $row['Extracurricular_Or_Cocurricular']; ?> </td>
                                <td> <?php echo $row['Type_Of_The_Activity']; ?> </td>
                                <td> <?php echo $row['Level']; ?> </td>
                                <td> <?php echo $row['Name_Of_Activity']; ?> </td>
                                <td> <?php echo $row['Organizing_Body']; ?> </td>
                                <td> <?php echo $row['Award_Or_Participation']; ?> </td>
                                <td> <?php echo $row['Dates_From']; ?> </td>
                                <td> <?php echo $row['Dates_To']; ?> </td>
                        <td>

                            <a href="../../student/achievement_activities/certificates/<?php echo $row['pdffile1']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<!-- <a href="../../professors/book-chapters/uploadsfrontit/<?php echo $row['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
                            <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                    </td>
                    <td>
                    <?php if ($row['STATUS'] == 'PENDING') { ?>
                                    <form method="POST" action="approved.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="submit" name="approve" value="Approve">
                                    </form>
                                    <form method="post" action="reject.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="reject" class="btn btn-danger"> Send Back</button>
                                    </form>
                                <?php } elseif ($row['STATUS'] == 'Sent Back') { ?>
                                    <?php echo $row['STATUS']; ?>
                                    <form method="POST" action="approve-now.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="submit" name="approve_now" value="Approve Now">
                                    </form>
                                <?php } else { ?>
                                    <?php echo $row['STATUS']; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php 
            }

        } else {
            echo "No Results Found";
        }
    }
    ?>
    </table>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
     <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                //chnage this keep same variable as above
                $('#update_id').val(data[0]);
                $('#Academic_year').val(data[1]);
                $('#Name_Of_The_Student').val(data[2]);
                $('#Roll_no').val(data[3]);
                $('#Branch').val(data[4]);
                $('#division').val(data[5]);
                $('#Year_Of_Study').val(data[6]);
                $('#Extracurricular_Or_Cocurricular').val(data[7]);
                $('#Type_Of_The_Activity').val(data[8]);
                $('#Level').val(data[9]);
                $('#Name_Of_Activity').val(data[10]);
                $('#Organizing_Body').val(data[11]);
                $('#Award_Or_Participation').val(data[12]);
                $('#Dates_From').val(data[13]);
                $('#Dates_To').val(data[14]);
                $('#pdffile1').val(data[15]);
                
            });
        });
    </script>
<script>  
    //user-defined function to download CSV file  
    function downloadCSVuser(csv, filename) {  
        var csvFile;  
        var downloadLink;  

        //define the file type to text/csv  
        csvFile = new Blob([csv], {type: 'text/csv'});  
        downloadLink = document.createElement("a");  
        downloadLink.download = filename;  
        downloadLink.href = window.URL.createObjectURL(csvFile);  
        downloadLink.style.display = "none";  

        document.body.appendChild(downloadLink);  
        downloadLink.click();  
    }  

    //user-defined function to export the data to CSV file format  
    function exportTableToCSVuser(filename) {  
    //declare a JavaScript variable of array type  
    var csv = [];  
    var x=document.getElementById("tabledataid");
    var rows = x.querySelectorAll("table tr");  

    //merge the whole data in tabular form   
    for (var i = 0; i < rows.length; i++) {  
    var row = [];
    var cols = rows[i].querySelectorAll("td, th");  
    for (var j = 1; j < cols.length - 2; j++) {
        // Check if the cell value contains a comma, if so, wrap it in double quotes
        var cellValue = cols[j].innerText;
        if (cellValue.includes(',')) {
            row.push('"' + cellValue + '"');
        } else {
            row.push(cellValue);
        }
    }
    csv.push(row.join(","));
}  
    //call the function to download the CSV file  
    downloadCSVuser(csv.join("\n"), filename);  
    }  
</script> 

<script>  
        //user-defined function to download CSV file  
        function downloadCSV(csv, filename) {  
        var csvFile;  
        var downloadLink;  

        //define the file type to text/csv  
        csvFile = new Blob([csv], {type: 'text/csv'});  
        downloadLink = document.createElement("a");  
        downloadLink.download = filename;  
        downloadLink.href = window.URL.createObjectURL(csvFile);  
        downloadLink.style.display = "none";  

        document.body.appendChild(downloadLink);  
        downloadLink.click();  
    }  

    //user-defined function to export the data to CSV file format  
    function exportTableToCSV(filename) {  
    //declare a JavaScript variable of array type  
    var csv = [];  
    var x=document.getElementById("srch");
    var rows = x.querySelectorAll("table tr");  

    //merge the whole data in tabular form   
    for (var i = 0; i < rows.length; i++) {  
    var row = [];
    var cols = rows[i].querySelectorAll("td, th");  
    for (var j = 1; j < cols.length - 2; j++) {
        // Check if the cell value contains a comma, if so, wrap it in double quotes
        var cellValue = cols[j].innerText;
        if (cellValue.includes(',')) {
            row.push('"' + cellValue + '"');
        } else {
            row.push(cellValue);
        }
    }
    csv.push(row.join(","));
}  
    //call the function to download the CSV file  
    downloadCSV(csv.join("\n"), filename);  
    }  
</script> 


</body>
</html>