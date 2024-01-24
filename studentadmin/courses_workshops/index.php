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
    <title> Student Courses, Workshops and Seminars </title>

    <link rel="stylesheet" href="styles.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>

#selectedItemsTableContainer {
    opacity: 0;
    height: 0;
    overflow: hidden;
    transition: opacity 0.8s ease, height 0.8s ease;
}

#selectedItemsTableContainer.show {
    opacity: 1;
    height: auto;
}
#selectedItemsTable .select-checkbox {
        display: none;
    }


</style>

<body>

<?php include('../../header.php'); ?>

 <!-- main card -->
 <!-- buttons and search buttoncard -->
            <div class="card">
                <div class="card-body">
                
            <div class="card-body mt-5">
                <h2>STUDENT COURSES ,WORKSHOPS AND SEMINAR</h2>
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
				<button type="submit" onclick="exportTableToCSVuser('USerData_StudentCourses&Workshops.csv')" class="btn btn-success">Export to excel</button>
			</form> &nbsp; &nbsp; 
        
            <form method="post">
                <label>Search</label>
                <input type="text" name="search">
                <input type="submit" name="submit">
            </form>
            </div>
            </div>
<!-- Selected batch download items table -->
<div id="selectedItemsTableContainer" class="card mt-4">

<div class="card-body">
    <h3>Selected Items for Batch Download</h3>
    <button type="submit" onclick="exportTableToCSVuserBatch('USerData_StudentCourses&amp;Workshops.csv')" class="btn btn-success">Export selected to excel</button>
    <table id="selectedItemsTable" class="table table-bordered table-dark mt-2">
        <thead>
            <tr>
                <th scope="col"> </th>
                <th scope="col">ID</th>
                <th scope="col">NAME OF STUDENT</th>
                <th scope="col">ROLL NUMBER</th>
                <th scope="col">BRANCH</th>
                <th scope="col">DIVISION</th>
                <th scope="col">YEAR OF STUDY</th>
                <th scope="col">TYPE OF COURSE/WORKSHOP/SEMINAR</th>
                <th scope="col">TITLE OF COURSE/WORKSHOP/SEMINAR</th>
                <th scope="col">ORGANIZING INSTITUTE/BODY AND ITS LOCATION</th>
                <th scope="col">PROFESSIONAL BODY/ORGANIZATION ASSOCIATED WITH THE EVENT IF ANY,</th>
                <th scope="col">DURATION (IN WEEKS OR DAYS)</th>
                <th scope="col">STARTING DATE</th>
                <th scope="col">ENDING DATE</th>
                <th scope="col">ACTION</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody>
            <!-- Selected items will appear here -->
        </tbody>
    </table>
</div>
</div>

           <!-- table -->
<div id="tabledataid" class="card">
    <div class="card-body">
        <!-- th change -->
        <table id="datatableid" class="table table-bordered table-dark mt-2">
            <thead>
                <tr>
                <th scope="col" id = "checkboxContainer">  </th> <!--@richie-->
                    <th scope="col"> ID </th>
                    <th scope="col"> NAME OF STUDENT </th>
                    <th scope="col"> ROLL NUMBER </th>
                    <th scope="col"> BRANCH </th>
                    <th scope="col"> DIVISION </th>
                    <th scope="col"> YEAR OF STUDY</th>
                    <th scope="col"> TYPE OF COURSE </th>
                    <th scope="col"> TITLE OF PROGRAM </th>
                    <th scope="col"> ORGANIZING INSTITUTE/BODY AND ITS LOCATION </th>
                    <th scope="col"> PROFESSIONAL BODY/ORGANIZATION ASSOCIATED WITH THE EVENT IF ANY, </th>
                    <th scope="col"> DURATION (IN WEEKS OR DAYS)</th>
                    <th scope="col"> STARTING DATE </th>
                    <th scope="col"> ENDING DATE </th>
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

            $table_query = "SELECT * FROM courses WHERE Branch = '$branch' AND Year_Of_Study = '$Year_Of_Study' AND division = '$division' ORDER BY id ASC";
            
            $query_run = mysqli_query($connection, $table_query);
            $query_result = mysqli_num_rows($query_run); ?>

            <?php if ($query_result > 0) {
                while ($developer = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <tbody> <!-- change -->
                        <tr>
                            <td>
                                <input type="checkbox" class="select-checkbox" name="selectedRows[]" value="<?php echo $developer['id']; ?>">
                            </td>
                            <td> <?php echo $developer['id']; ?> </td>
                            <td> <?php echo $developer['Name_Of_The_Student']; ?> </td>
                            <td> <?php echo $developer['Roll_no']; ?> </td>
                            <td> <?php echo $developer['Branch']; ?> </td>
                            <td> <?php echo $developer['division']; ?> </td>
                            <td> <?php echo $developer['Year_Of_Study']; ?> </td>
                            <td> <?php echo $developer['Type_Of_Course']; ?> </td>
                            <td> <?php echo $developer['Title_Of_Course']; ?> </td>
                            <td> <?php echo $developer['Organizing_Body']; ?> </td>
                            <td> <?php echo $developer['Others']; ?> </td>
                            <td> <?php echo $developer['Duration']; ?> </td>
                            <td> <?php echo $developer['Dates_From']; ?> </td>
                            <td> <?php echo $developer['Dates_To']; ?> </td>
                            <td>
                                <a href="../../student/courses_workshops/certificates/<?php echo $developer['pdffile1']; ?>" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
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
            $select = "UPDATE courses SET STATUS ='APPROVED' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Approved";
            header("Location: index.php");
        }

        // Reject button logic
        if (isset($_POST['reject'])) {
            $id = $_POST['id'];
            $select = "UPDATE courses SET STATUS ='Sent Back' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Rejected";
            header("Location: index.php");
        }

        // Approve Now button logic
if (isset($_POST['approve_now'])) {
    $id = $_POST['id'];
    $select = "UPDATE courses SET STATUS ='APPROVED' WHERE id='$id'";
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
                            <label> Name of the Student </label>
                            <input type="text"  id="Name_Of_The_Student" name="Name_Of_The_Student" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>  Roll Number </label>
                            <input type="number"  id="Roll_no" name="Roll_no" class="form-control" required>
                        </div>

                        <div class="form-group">
    <label>Branch</label>
    <select name="Branch" class="form-control" required >
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
    <label>Year_Of_Study</label>
    <select name="Year_Of_Study" class="form-control" required >
        <option value="">--Select Department--</option>
        <?php
        // Retrieve the department information from the session or any other method
        $Year_Of_Study = $_SESSION['Year_Of_Study']; 

       $Year_Of_Studys = array("FE", "SE", "TE", "BE");
foreach ($Year_Of_Studys as $Year_Of_StudyOption) {
    $selected = ($Year_Of_StudyOption == $Year_Of_Study) ? 'selected="selected"' : '';
    echo '<option value="' . $Year_Of_StudyOption . '" ' . $selected . '>' . $Year_Of_StudyOption . '</option>';
}

        ?>
    </select>
</div>
<div class="form-group">
    <label>Division</label>
    <select name="division" class="form-control" required >
        <option value="">--Select Division--</option>
        <?php
        // Retrieve the division information from the session or any other method
        $division = $_SESSION['division'];

        $divisions = array("A","B");
        foreach ($divisions as $divisionOption) {
            $selected = ($divisionOption == $division) ? 'selected="selected"' : '';
            echo '<option value="' . $divisionOption . '" ' . $selected . '>' . $divisionOption . '</option>';
        }
        ?>
    </select>
</div>
                        

                        <!-- <div class="form-group">
                            <label>Select Type of Activity</label>
                            <select id="Extracurricular_Or_Cocurricular" name="Extracurricular_Or_Cocurricular" class="form-control"  required>
                                <option id="Extracurricular_Or_Cocurricular" name="Extracurricular_Or_Cocurricular" value="Extracurricular">Extracurricular</option>
                                <option id="Extracurricular_Or_Cocurricular" name="Extracurricular_Or_Cocurricular" value="Cocurricular">Cocurricular</option>
                            </select>
                        </div> -->

                        <div class="form-group">
                            <label> Type of Course </label>
                            <input type="text" name="Type_Of_Course"  id="Type_Of_Course" class="form-control" placeholder="Enter Type of Course" required>
                        </div>

                        <div class="form-group">
                            <label> Title of Course </label>
                            <input type="text" name="Title_Of_Course" id="Title_Of_Course" class="form-control" placeholder="Enter Title of Course" required>
                        </div>

                        <div class="form-group">
                            <label> Organizing Insititute/ Body and its location </label>
                            <input type="text" name="Organizing_Body" id="Organizing_Body" class="form-control" placeholder="Enter Organizing Body and its location" required>
                        </div>

                        <!-- <div class="form-group">
                            <label>Awards won/ Participation</label>
                            <select id="Award_Or_Participation" name="Award_Or_Participation" class="form-control"  required>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="First Prize">First Prize</option>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="Second Prize">Second Prize</option>
                                <option id="Award_Or_Participation" name="Award_Or_Participation" value="Participation">Participation</option>
                            </select>
                        </div> -->

                        <div class="form-group">
                            <label> Professional Body/ Organization associated with the event if any  </label>
                            <input type="text" name="Others" id="Others" class="form-control" placeholder="Enter Other Professional Body name" >
                        </div>

                        <div class="form-group">
                            <label> Duration (please mention weeks or days) </label>
                            <input type="text" name="Duration" id="Duration" class="form-control" placeholder="Enter Duration in weeks or days" required>
                        </div>

                        <div class="form-group">
                            <label> Starting Date </label>
                            <input type="date" id="Dates_From" name="Dates_From" class="form-control" max="<?php echo date('Y-m-d'); ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Ending Date </label>
                            <input type="date" id="Dates_To" name="Dates_To" class="form-control" max="<?php echo date('Y-m-d'); ?>"required>
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
                                <th scope="col"> ID </th>
                                <th scope="col"> NAME OF TEACHER </th>
                                <th scope="col"> ROLL NUMBER </th>
                                <th scope="col"> BRANCH </th>
                                <th scope="col"> YEAR OF STUDY</th>
                                <th scope="col"> DIVISION </th>
                                <th scope="col"> TYPE OF COURSE </th>
                                <th scope="col"> TITLE OF PROGRAM </th>
								<th scope="col"> ORGANIZING INSTITUTE/BODY AND ITS LOCATION </th>
                                <th scope="col"> PROFESSIONAL BODY/ORGANIZATION ASSOCIATED WITH THE EVENT IF ANY, </th>
                                <th scope="col"> DURATION (IN WEEKS OR DAYS) </th>
                                <th scope="col"> STARTING DATE </th>
                                <th scope="col"> ENDING DATE </th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS </th>
                               

                               
                            </tr>
                        </thead>   
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `courses` WHERE branch = '$branch' AND division = '$division' AND (Name_Of_The_Student LIKE '%$str%' OR Roll_no LIKE '%$str%' OR Year_Of_Study LIKE '%$str%'  OR Type_Of_Course LIKE '%$str%' OR Title_Of_Course LIKE '$str' OR Organizing_Body LIKE '%$str%' OR Others LIKE '%$str%' OR Duration LIKE '%$str%' OR Dates_From LIKE '%$str%' OR Dates_To LIKE '%$str%' OR STATUS LIKE '$str')";
        
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
                            <?php
                $status = $row['STATUS'];
                $is_disabled = ($status == "approved") ? "disabled" : "";
                // If STATUS is "approved", set the $is_disabled variable to "disabled"
                ?>            
                        <td>
                            <input type="checkbox" class="select-checkbox" name="selectedRows[]" value="<?php echo $row['id']; ?>" onclick="updateSelectedItems(this, 'srch');">
                        </td>    
                        <td> <?php echo $row['id']; ?> </td>
                        <td> <?php echo $row['Name_Of_The_Student']; ?> </td> 
                        <td> <?php echo $row['Roll_no']; ?> </td>
                        <td> <?php echo $row['Branch']; ?> </td>
                        <td> <?php echo $row['division']; ?> </td>
                        <td> <?php echo $row['Year_Of_Study']; ?> </td>
                        <td> <?php echo $row['Type_Of_Course']; ?> </td>
                        <td> <?php echo $row['Title_Of_Course']; ?> </td>
                        <td> <?php echo $row['Organizing_Body']; ?> </td>
                        <td> <?php echo $row['Others']; ?> </td>
                        <td> <?php echo $row['Duration']; ?> </td>
                        <td> <?php echo $row['Dates_From']; ?> </td>
                        <td> <?php echo $row['Dates_To']; ?> </td>
                        <td>

                            <a href="../../student/courses_workshops/certificates/<?php echo $row['pdffile1']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
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

                $('#delete_id').val(data[1]);

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
                $('#update_id').val(data[1]);
                $('#Name_Of_The_Student').val(data[2]);
                $('#Roll_no').val(data[3]);
                $('#Branch').val(data[4]);
                $('#division').val(data[5]);
                $('#Year_Of_Study').val(data[6]);
                $('#Type_Of_Course').val(data[7]);
                $('#Title_Of_Course').val(data[8]);
                $('#Organizing_Body').val(data[9]);
                $('#Others').val(data[10]);
                $('#Duration').val(data[11]);
                $('#Dates_From').val(data[12]);
                $('#Dates_To').val(data[13]);
                $('#pdffile1').val(data[14]);

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


    function exportTableToCSVuserBatch(filename) {  
    //declare a JavaScript variable of array type  
    var csv = [];  
    var x=document.getElementById("selectedItemsTable");
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
document.addEventListener('DOMContentLoaded', function () {
    var table = document.getElementById('tabledataid');
    
    table.addEventListener('change', function (event) {
        var checkbox = event.target.closest('tr').querySelector('.select-checkbox');
        if (checkbox && event.target === checkbox) {
            updateSelectedItems(checkbox);
            toggleSelectedItemsTable();
        }
    });
});

function updateSelectedItems(checkbox) {
    var row = checkbox.parentNode.parentNode;

    var selectedItemsTableBody = document.getElementById("selectedItemsTable").getElementsByTagName("tbody")[0];
    var selectedItemsTableContainer = document.getElementById("selectedItemsTableContainer");

    if (checkbox.checked) {
        var clonedRow = row.cloneNode(true);
        selectedItemsTableBody.appendChild(clonedRow);
        row.classList.add('highlighted-row');
        
        // Show the selected items section with animation
        selectedItemsTableContainer.classList.add('show');
    } else {
        var selectedItemsTableRows = selectedItemsTableBody.getElementsByTagName('tr');
        for (var i = 0; i < selectedItemsTableRows.length; i++) {
            if (areRowsEqual(row, selectedItemsTableRows[i])) {
                selectedItemsTableBody.removeChild(selectedItemsTableRows[i]);
                row.classList.remove('highlighted-row');

                // If no selected items left, there is no need to hide the selected items section
                break;
            }
        }
    }
}

function areRowsEqual(row1, row2) {
    var cells1 = row1.getElementsByTagName('td');
    var cells2 = row2.getElementsByTagName('td');

    for (var i = 1; i < cells1.length - 2; i++) {
        if (cells1[i].innerText !== cells2[i].innerText) {
            return false;
        }
    }

    return true;
}

document.addEventListener('DOMContentLoaded', function () {
    var selectedItemsTableBody = document.getElementById('selectedItemsTable').getElementsByTagName('tbody')[0];
    
    // Create a MutationObserver to observe changes in the "Selected Items" table
    var observer = new MutationObserver(function () {
        toggleSelectedItemsContainerBasedOnContents();
    });

    // Configure the observer to watch for child list changes
    var observerConfig = { childList: true };

    // Start observing the target node (selectedItemsTableBody) for configured mutations
    observer.observe(selectedItemsTableBody, observerConfig);
});

function toggleSelectedItemsContainerBasedOnContents() {
    var selectedItemsTableBody = document.getElementById('selectedItemsTable').getElementsByTagName('tbody')[0];
    var selectedItemsTableContainer = document.getElementById('selectedItemsTableContainer');

    // Add/remove the 'show' class to trigger the CSS transition
    if (selectedItemsTableBody.children.length > 0) {
        selectedItemsTableContainer.classList.add('show');
    } else {
        selectedItemsTableContainer.classList.remove('show');
    }
}












</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var checkboxId = "checkbox_<?php echo $developer['id']; ?>";
    var checkbox = document.getElementById(checkboxId);

    // Check if the checkbox exists
    if (checkbox) {
        // Toggle the visibility of the checkbox when the button is clicked
        var bulkDownloadButton = document.getElementById('bulkDownloadButton');
        bulkDownloadButton.addEventListener('click', function () {
            checkbox.style.display = (checkbox.style.display === 'none') ? '' : 'none';
        });
    }
});

 
</script>









</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var checkboxId = "checkbox_<?php echo $developer['id']; ?>";
    var checkbox = document.getElementById(checkboxId);

    // Check if the checkbox exists
    if (checkbox) {
        // Toggle the visibility of the checkbox when the button is clicked
        var bulkDownloadButton = document.getElementById('bulkDownloadButton');
        bulkDownloadButton.addEventListener('click', function () {
            checkbox.style.display = (checkbox.style.display === 'none') ? '' : 'none';
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
        var table = document.getElementById('tabledataid');

        table.addEventListener('change', function (event) {
            var checkbox = event.target.closest('tr').querySelector('.select-checkbox');
            if (checkbox && event.target === checkbox) {
                updateSelectedItems(checkbox);
                toggleSelectedItemsContainerBasedOnContents();
            }
        });

 
</script>


</body>
</html>