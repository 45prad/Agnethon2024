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
    <title> Certificate Programs</title>

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

    <!-- Modal -->
    <!-- this is add data form Make changes to variables, keep same variables -->
    <div class="modal fade mt-2" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="insertcode.php" method="POST" enctype="multipart/form-data" >
                        <div class="modal-body">

                <div class="form-group">
                            <label>Department</label>
                            <select name="Branch" class="form-control" required disabled>
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
                            <label> Course Coordinator* </label>
                            <input type="text"   name="Course_coordinator" class="form-control" placeholder="Enter Course coordinator" required>
                        </div>

                        <div class="form-group">
                            <label> Name of Add on/Certificate Programs Offered* </label>
                            <input type="text" name="Programs_offered" class="form-control" placeholder="Programs_offered" required>
                        </div>

                        <div class="form-group">
                            <label> Course Code (if any)* </label>
                            <input type="text" name="Course_code"   class="form-control" placeholder="Enter course code">
                        </div>

                        <div class="form-group">
                            <label> Year of Offering* </label>
                            <select name="Year_of_offering" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="Year_of_offering" value="2017-18">2017-18</option>
                                <option name="Year_of_offering" value="2018-19">2018-19</option>
                                <option name="Year_of_offering" value="2019-20">2019-20</option>
                                <option name="Year_of_offering" value="2020-21">2020-21</option>
                                <option name="Year_of_offering" value="2021-22">2021-22</option>
                                <option name="Year_of_offering" value="2022-23">2022-23</option>
                                <option name="Year_of_offering" value="2023-24">2023-24</option>
                                <option name="Year_of_offering" value="2024-25">2024-25</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label> No of Times Offered During the Year* </label>
                            <input type="number" name="No_of_times_offered"  class="form-control" placeholder="Enter No_of_times_offered " required>
                        </div>

                        <div class="form-group">
                            <label>  Start Date* </label>
                            <input type="date" name="Start_date"  class="form-control" placeholder="Enter Start_date" max="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>  End Date*</label>
                            <input type="date" name="End_date"  class="form-control" placeholder="Enter End_date " max="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>  Duration (Hrs)* </label>
                            <input type="number" name= "Duration" class="form-control" placeholder="Enter Duration  " required>
                        </div>

                        <div class="form-group">
                            <label> Number of Students Enrolled in the Year* </label>
                            <input type="number" name="No_of_students_enrolled"  class="form-control" placeholder="Enter No_of_students_enrolled " required>
                        </div>

                        <div class="form-group">
                            <label>  Number of Students Completing the Course  in the Year* </label>
                            <input type="number" name="No_of_students_completing"  class="form-control" placeholder="Enter No_of_students_completing " required>
                        </div>

                        <div class="form-group">
                            <label> Upload Report* </label>
                            <input type="file" name="pdffile1" id="pdffile1" accept="application/pdf"  required/><br>
                                    <img src="" id="pdf-file1-tag" width="100px" />

                                    <script type="text/javascript">
                                        function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    $('#pdf-file1-tag').attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        $("#pdffile1").change(function(){
                                            readURL(this);
                                        });
                                        $allowedExtensions = array('pdf');
$uploadedFileExtension = pathinfo($_FILES['pdffile1']['name'], PATHINFO_EXTENSION);

if (!in_array($uploadedFileExtension, $allowedExtensions)) {
    // File type is not allowed (not a PDF)
    // You can handle the error or display a message to the user.
    echo "Invalid file type. Only PDF files are allowed.";
} else {
    // File type is valid, you can proceed with the upload.
    // Move the uploaded file to a designated directory.
    move_uploaded_file($_FILES['pdffile1']['tmp_name'], '"uploadsindexit/' . $_FILES['pdffile1']['name']);
    echo "File uploaded successfully.";
}
                                    </script><br>
						</div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="insertbutton" name="insertdata" class="btn btn-primary" onClick="datechecker() ">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- DELETE POP UP FORM  --->
    <!-- dont make changes--->
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

 <!-- main card -->
 <!-- buttons and search buttoncard -->
            <div class="card">
                <div class="card-body">

                <div class="card-body mt-5">
                <h2> CERTIFICATE PROGRAMS </h2>
            </div>

                <?php 
                if($_SESSION["role"] == true) {
                    echo '<div style="position: absolute; top: 100px; right: 70px; font-weight: bold; color: #007bff;">Welcome ' . $_SESSION["role"] . '<br><span style="color: #008000;">You logged in as Activity Coordinator</span></div>';
                } else {
                    header("Location:index.php"); 
                }
                ?>

            <div class="card">
                <div class="card-body btn-group">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal"> 
                        ADD DATA
                    </button>
            </form> &nbsp;

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" onclick="exportTableToCSVuser('USerData_CertificatePrograms.csv')" class="btn btn-success">Export to excel</button>
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
                                <th> ID </th>
                                <th> BRANCH </th>
                                <th> COURSE COORDINATOR </th>
                                <th> PROGRAMS OFFERED </th>
                                <th> COURSE CODE </th>
                                <th> YEAR OF OFFERING </th>
                                <th> NO OF TIMES OFFERED </th>
								<th> START DATE </th>
                                <th> END DATE </th>
                                <th> DURATION </th>
                                <th> NO OF STUDENTS ENROLLED</th>
                                <th> NO OF STUDENTS COMPLETING </th>
                                <th> ACTION </th>
                                <th> STATUS </th>
                            </tr>
                        </thead>
                        
                        <?php
                        $user = $_SESSION["role"];
                        
                        $result = "SELECT * FROM activity_coordinator WHERE username = '$user'";

                        $query = mysqli_query($connection, $result);
                        $queryresult = mysqli_num_rows($query); 
                            if($queryresult > 0){
                                while($row = mysqli_fetch_assoc($query)){ 
                                    $id = $row['id'];
                                    $branch = $row['branch'];
                                    
                                }  
                            }

                        $table_query = "SELECT * FROM certificates WHERE user_id = '$id'";
                        
                        $query_run = mysqli_query($connection, $table_query);
                        $query_result = mysqli_num_rows($query_run); ?>

                        <?php if($query_result > 0){
                                        while($developer = mysqli_fetch_assoc($query_run)){   
                                            ?>
                        <tbody> <!-- change -->
                            <tr>
                            <?php
                $status = $developer['STATUS'];
                $is_disabled = ($status == "approved") ? "disabled" : "";
                // If STATUS is "approved", set the $is_disabled variable to "disabled"
                ?>
                                <td> <?php echo $developer['id']; ?> </td>
                                <td> <?php echo $developer['Branch']; ?> </td> 
                                <td> <?php echo $developer['Course_coordinator']; ?> </td>
                                <td> <?php echo $developer['Programs_offered']; ?> </td>
                                <td> <?php echo $developer['Course_code']; ?> </td>
                                <td> <?php echo $developer['Year_of_offering']; ?> </td>
                                <td> <?php echo $developer['No_of_times_offered']; ?> </td>
                                <td> <?php echo $developer['Start_date']; ?> </td>
                                <td> <?php echo $developer['End_date']; ?> </td>
                                <td> <?php echo $developer['Duration']; ?> </td>
                                <td> <?php echo $developer['No_of_students_enrolled']; ?> </td>
                                <td> <?php echo $developer['No_of_students_completing']; ?> </td>
                                <td>
<!--                             <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>-->
<a href="reports/<?php echo $developer['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
<!--                             <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>-->
<?php if ($status == "approved") { ?>
    <!-- Code for when the status is approved -->
    <!-- You can hide the delete and edit buttons for the approved status -->

    <!-- Code for when the status is sent back -->
    <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip" <?php echo $is_disabled ?>>
        <i class="material-icons">&#xE254;</i>
    </a>
<?php } else { ?>
    <!-- Code for when the status is pending or any other status -->
    <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip" <?php echo $is_disabled ?>>
        <i class="material-icons">&#xE254;</i>
    </a>
    <a class="delete btn-danger deletebtn" title="Delete" data-toggle="tooltip" >
        <i class="material-icons">&#xE872;</i>
    </a>
<?php } ?>
                </td>

                <td> <?php echo $status; ?> </td>
            </tr>
        </tbody>
            <?php           
    }
}
else  
{
    echo "No Record Found";
}
            ?>
        </table>
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
                    <h5 class="modal-title" id="exampleModalLabel"> (Please enter the dates again)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="updatecode.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Branch*</label>
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
                            <label> Course Coordinator* </label>
                            <input type="text" name="Course_coordinator" id = "Course_coordinator" class="form-control" placeholder="Enter Course coordinator" required>
                        </div>

                        <div class="form-group">
                            <label> Name of Add on/Certificate Programs Offered* </label>
                            <input type="text" name="Programs_offered" id = "Programs_offered" class="form-control" placeholder="Programs offered" required>
                        </div>

                        <div class="form-group">
                            <label> Course Code (if any) </label>
                            <input type="text" name="Course_code" id="Course_code" class="form-control" placeholder="Enter course code">
                        </div>

                        <div class="form-group">
                            <label> Year of Offering* </label>
                            <input type="text" name="Year_of_offering" id="Year_of_offering" class="form-control" placeholder="Year of Offering" required>
                        </div>

                        <!-- <div class="form-group">
                            <label>Year of Offering*</label>
                            <select name="Year_of_offering" id="Year_of_offering" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option id="Year_of_offering" name="Year_of_offering" value="2017-18">2017-18</option>
                                <option id="Year_of_offering" name="Year_of_offering" value="2018-19">2018-19</option>
                                <option id="Year_of_offering" name="Year_of_offering" value="2019-20">2019-20</option>
                                <option id="Year_of_offering" name="Year_of_offering" value="2020-21">2020-21</option>
                                <option id="Year_of_offering" name="Year_of_offering" value="2021-22">2021-22</option>
                                <option id="Year_of_offering" name="Year_of_offering" value="2022-23">2022-23</option>
                            </select>
                        </div> -->

                        <!-- <div class="form-group">
                            <label> No of Times Offered During the Year* </label>
                            <input type="number" id="No_of_times_offered" name="No_of_times_offered" class="form-control" placeholder="Enter No of times offered " required>
                        </div> -->

                        <div class="form-group">
                            <label> No of Times Offered During the Year* </label>
                            <input type="number" id="No_of_times_offered" name="No_of_times_offered" class="form-control" placeholder="Enter No of times offered" required>
                        </div>

                        <div class="form-group">
                            <label>  Start Date* </label>
                            <input type="date" id="Start_date" name="Start_date" class="form-control" placeholder="Enter Start_date" max="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>  End Date* </label>
                            <input type="date" name="End_date" id="End_date" class="form-control" placeholder="Enter End_date " max="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>  Duration (Hrs)* </label>
                            <input type="number" name="Duration" id="Duration" class="form-control" placeholder="Enter Duration  " required>
                        </div>

                        <div class="form-group">
                            <label> Number of Students Enrolled in the Year* </label>
                            <input type="number" name="No_of_students_enrolled" id="No_of_students_enrolled" class="form-control" placeholder="Enter No of students enrolled " required>
                        </div>

                        <div class="form-group">
                            <label>  Number of Students Completing the Course  in the Year* </label>
                            <input type="number" name="No_of_students_completing" id="No_of_students_completing" class="form-control" placeholder="Enter No of students completing " required>
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                        </div>
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
                                <th> BRANCH </th>
                                <th> COURSE COORDINATOR </th>
                                <th> PROGRAMS OFFERED </th>
                                <th> COURSE CODE </th>
                                <th> YEAR OF OFFERING </th>
                                <th> NO OF TIMES OFFERED </th>
								<th> START DATE </th>
                                <th> END DATE </th>
                                <th> DURATION </th>
                                <th> NO OF STUDENTS ENROLLED</th>
                                <th> NO OF STUDENTS COMPLETING </th>
                                <th> Upload Report </th>
                                <th> Status</th>
                            </tr>
                    </thead>  
                         
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `certificates` WHERE user_id='$id' AND (Branch LIKE '%$str%' OR Course_coordinator LIKE '%$str%' OR Programs_offered LIKE '%$str%' OR Course_code LIKE '%$str%' OR Year_of_offering LIKE '%$str%' OR No_of_times_offered LIKE '$str' OR Start_date LIKE '%$str%' OR End_date LIKE '%$str%' OR Duration LIKE '%$str%' OR No_of_students_enrolled LIKE '%$str%' OR No_of_students_completing LIKE '%$str%'OR STATUS LIKE '$str' ) ";
        
        $result = mysqli_query($connection, $sth);
        $queryresult = mysqli_num_rows($result); ?>

                    <div class="card">
                        <div class="card-body btn-group">
                        <div> Results- </div> &nbsp; &nbsp;
                        <button class="btn btn-success" onclick="exportTableToCSV('Search_data.csv')"> Export Data </button>
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
                        <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['Branch']; ?> </td> 
                                <td> <?php echo $row['Course_coordinator']; ?> </td>
                                <td> <?php echo $row['Programs_offered']; ?> </td>
                                <td> <?php echo $row['Course_code']; ?> </td>
                                <td> <?php echo $row['Year_of_offering']; ?> </td>
                                <td> <?php echo $row['No_of_times_offered']; ?> </td>
                                <td> <?php echo $row['Start_date']; ?> </td>
                                <td> <?php echo $row['End_date']; ?> </td>
                                <td> <?php echo $row['Duration']; ?> </td>
                                <td> <?php echo $row['No_of_students_enrolled']; ?> </td>
                                <td> <?php echo $row['No_of_students_completing']; ?> </td>
                                <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($row['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
<!--                             <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
 -->                            <a href="reports/<?php echo $row['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<!-- <a href="uploadsfrontit/<?php echo $row['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
<!--                             <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
 -->							
                            
                            
                            <!-- <button class="btn"><i class="fa fa-download"></i> Download</button> -->
                            <?php if ($status != "approved") { // If STATUS is not "approved", show the edit and delete buttons ?>
                        <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip" <?php echo $is_disabled ?>>
                            <i class="material-icons">&#xE254;</i>
                        </a>

                        <a class="delete btn-danger deletebtn" title="Delete" data-toggle="tooltip" <?php echo $is_disabled ?>>
                            <i class="material-icons">&#xE872;</i>
                        </a>
                    <?php } ?>
                            </td>
                        <td> <?php echo $row['STATUS']; ?> </td>
                    </tr> 
                    <tbody>
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

    <!--<script type="text/javascript">
        function EnableDisableTextBox(Approving_Body) {
            var selectedValue = Approving_Body.options[Approving_Body.selectedIndex].value;
            var txtOther = document.getElementById("txtOther");
            txtOther.disabled = selectedValue == other ? false : true;
            if (!txtOther.disabled) {
                txtOther.focus();
            }
        }
    </script> -->

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
                $('#Branch').val(data[1]);
                $('#Course_coordinator').val(data[2]);
                $('#Programs_offered').val(data[3]);
                $('#Course_code').val(data[4]);
                $('#Year_of_offering').val(data[5]);
                $('#No_of_times_offered').val(data[6]);
                $('#Start_date').val(data[7]);
                $('#End_date').val(data[8]);
                $('#Duration').val(data[9]);
                $('#No_of_students_enrolled').val(data[10]);
                $('#No_of_students_completing').val(data[11]);
                $('#pdffile1').val(data[12]);
                // $('#pdffile2').val(data[13]);
            });
        });
    </script>

<!--<script>
        function datechecker() {
            if(document.getElementById('insertbutton').clicked == true) {
                alert("Dhjkd");
            }
        }
</script>-->

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

    //user-defined function to export the data to CSV file formatt  
    function exportTableToCSVuser(filename) {  
    //declare a JavaScript variable of array type  
    var csv = [];  
    var x=document.getElementById("tabledataid");
    var rows = x.querySelectorAll("table tr");  

    //merge the whole data in tabular form   
    for(var i=0; i<rows.length; i++) {  
        var row = [], cols = rows[i].querySelectorAll("td, th");  
        for( var j=1; j<cols.length-1; j++)  
        row.push(cols[j].innerText);  
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
    for(var i=0; i<rows.length; i++) {  
        var row = [], cols = rows[i].querySelectorAll("td, th");  
        for( var j=1; j<cols.length-1; j++)  
        row.push(cols[j].innerText);  
        csv.push(row.join(","));  
    }   
    //call the function to download the CSV file  
    downloadCSV(csv.join("\n"), filename);  
    }  
</script> 


</body>
</html>