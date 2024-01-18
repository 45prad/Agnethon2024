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
    <title>Higher Studies</title>

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
                        <label>Academic Year*</label>
                            <select name="year" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="year" value="2019-20">2019-20</option>
                                <option name="year" value="2020-21">2020-21</option>
                                <option name="year" value="2021-22">2021-22</option>
                                <option name="year" value="2022-23">2022-23</option>
                                <option name="year" value="2023-24">2023-24</option>
                                <option name="year" value="2024-25">2024-25</option>
                            </select>
                        </div>

                        <div class="form-group">
                         <label> Name of the Student* </label>
                            <input type="text" name="student_name" class="form-control" placeholder="Enter Student name" required>
                        </div>

                        <div class="form-group">
                         <label>FCRIT Roll Number* </label>
                            <input type="number" name="roll_no" class="form-control" placeholder="Enter roll number" required>
                        </div>

                        <div class="form-group">
                            <label>Program graduated from</label>
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
                         <label> Name of the Institute Joined* </label>
                            <input type="text" name="institute_name_joined"  class="form-control" placeholder="institute_name_joined" required>
                        </div>

                        <div class="form-group">
                         <label> Name of Program admitted* </label>
                            <input type="text" name="program_name_admitted" class="form-control" placeholder="program_name_admitted" required>
                        </div>

                       

                        
                        <div class="form-group">
                            <label> Upload Admitcard & Idcard* </label>
                            <input type="file" name="upload_admitcard_idcard" id="upload_admitcard_idcard" accept="application/pdf" required/><br>
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

 <!-- main card -->
 <!-- buttons and search buttoncard -->
            <div class="card">
                <div class="card-body">
                <?php 
                if($_SESSION["role"] == true) {
                    echo "Welcome". " ".$_SESSION["role"] ;
                } else {
                    header("Location:index.php"); 
                }
                ?>

            <div class="card-body mt-5">
                <h2>HIGHER STUDIES</h2>
            </div>
            <div class="card">
                <div class="card-body btn-group">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal"> 
                        ADD DATA
                    </button>
            </form> &nbsp;

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" onclick="exportTableToCSVuser('USerData_BookChapters.csv')" class="btn btn-success">Export to excel</button>
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
                                <th scope="col"> ACADEMIC YEAR </th>
                                <th scope="col"> NAME OF STUDENT ENROLLING HIGHER STUDIES </th>
                                <th scope="col"> FCRIT ROLL NO </th>
                                <th scope="col"> PROGRAM GRATUATED FROM </th>
                                <th scope="col"> NAME OF INSTITUTE JOINED </th>
                                <th scope="col"> NAME OF PROGRAM ADMITTED </th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS </th>
                               </tr>
                        </thead>
                        
                        <?php
                        $user = $_SESSION["role"];
                        
                        $result = "SELECT * FROM placement_coordinator WHERE username = '$user'";

                        $query = mysqli_query($connection, $result);
                        $queryresult = mysqli_num_rows($query); 
                            if($queryresult > 0){
                                while($row = mysqli_fetch_assoc($query)){ 
                                    $id = $row['id'];
                                    $branch = $row['branch'];
                                }  
                            }


                        $table_query = "SELECT * FROM higher_studies where user_id='$id'";
                        $query_run = mysqli_query($connection, $table_query);
                        $query_result = mysqli_num_rows($query_run); ?>

                        <?php if($query_result > 0){
                                        while($developer = mysqli_fetch_assoc($query_run)){   
                                            ?>
                        <tbody> <!-- change -->
                            <tr>
                                <!-- table columns -->
                <?php
                $status = $developer['STATUS'];
                $is_disabled = ($status == "approved") ? "disabled" : "";
                // If STATUS is "approved", set the $is_disabled variable to "disabled"
                ?>
                                <td> <?php echo $developer['id']; ?> </td> 
                                <td> <?php echo $developer['year']; ?> </td>
                                <td> <?php echo $developer['student_name']; ?> </td>
                                <td> <?php echo $developer['roll_no']; ?> </td>
                                <td> <?php echo $developer['Branch']; ?> </td> 
                                <td> <?php echo $developer['institute_name_joined']; ?> </td>
                                <td> <?php echo $developer['program_name_admitted']; ?> </td>
                                <td>
                                <a href="reports/<?php echo $developer['upload_admitcard_idcard']; ?>"  class="download" title="Download" data-toggle="tooltip">
                            <i class="fa fa-download"></i>
                        </a>
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

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                         <label>Academic Year*</label>
                         <select name="year" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="year" value="2019-20">2019-20</option>
                                <option name="year" value="2020-21">2020-21</option>
                                <option name="year" value="2021-22">2021-22</option>
                                <option name="year" value="2022-23">2022-23</option>
                                <option name="year" value="2023-24">2023-24</option>
                                <option name="year" value="2024-25">2024-25</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label> Student Name* </label>
                            <input type="text" id="student_name" name="student_name" class="form-control" placeholder="Enter Student name" required>
                        </div>
                        <div class="form-group">
                            <label>FCRIT Roll number*</label>
                            <input type="number" id="roll_no" name="roll_no" class="form-control" placeholder="Enter roll number" required>
                        </div>

                        <div class="form-group">
                            <label>Graduation Program*</label>
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
                            <label> Name of the Institute Joined* </label>
                            <input type="text" id="institute_name_joined" name="institute_name_joined" class="form-control" placeholder="institute_name_joined" required>
                        </div>

                        <div class="form-group">
                            <label> Name of Program admitted </label>
                            <input type="text" id="program_name_admitted" name="program_name_admitted" class="form-control" placeholder="program_name_admitted">
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
                                <th scope="col"> ACADEMIC YEAR </th>
                                <th scope="col"> NAME OF STUDENT ENROLLING HIGHER STUDIES </th>
                                <th scope="col"> FCRIT ROLL NO </th>
                                <th scope="col"> PROGRAM GRATUATED FROM </th>
                                <th scope="col"> NAME OF INSTITUTE JOINED </th>
                                <th scope="col"> NAME OF PROGRAM ADMITTED </th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS </th>
                               </tr>
                        </thead>  
                    </table>  
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `higher_studies` WHERE user_id='$id' AND ( Branch LIKE '%$str%' OR year LIKE '%$str%' OR roll_no LIKE '%$str%' OR student_name LIKE '%$str%' OR institute_name_joined LIKE '%$str%' OR program_name_admitted LIKE '%$str%' OR STATUS LIKE '%$str%') ";
        
       
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
                        <td> <?php echo $row['year']; ?> </td> 
                        <td> <?php echo $row['student_name']; ?> </td>
                        <td> <?php echo $row['roll_no']; ?> </td>
                                <td> <?php echo $row['Branch']; ?> </td>
                                <td> <?php echo $row['institute_name_joined']; ?> </td>
                                <td> <?php echo $row['program_name_admitted']; ?> </td>
                                <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($row['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
                            
                            <a href="reports/<?php echo $row['upload_admitcard_idcard']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<!-- <a href="uploadsfrontit/<?php echo $row['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
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
                        </td>
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
                $('#year').val(data[1]);
                $('#student_name').val(data[2]);
                $('#roll_no').val(data[3]);
                $('#Branch').val(data[4]);
                $('#institute_name_joined').val(data[5]);
                $('#program_name_admitted').val(data[6]);
                
                // $('#pdffile2').val(data[13]);
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