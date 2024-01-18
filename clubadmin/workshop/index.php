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
    <title> Workshop/Seminar </title>

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

    <!-- Modal --->
    <!--- this is add data form Make changes to variables, keep same variables -->
    <!-- <div class="modal fade mt-2" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <label>Year</label>
                            <select name="year" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="year" value="2017-18">2017-18</option>
                                <option name="year" value="2018-19">2018-19</option>
                                <option name="year" value="2019-20">2019-20</option>
                                <option name="year" value="2020-21">2020-21</option>
                                <option name="year" value="2021-22">2021-22</option>
                                <option name="year" value="2021-23">2022-23</option>
                            </select>
                        </div>

                        
                        
                        <div class="form-group">
                            <label>Branch</label>
                            <select name="branch" class="form-control" required>
                                <option value="">--Select branch--</option>
                                <option name="branch" value="IT">IT</option>
                                <option name="branch" value="Computer">Computer</option>
                                <option name="branch" value="Extc">Extc</option>
                                <option name="branch" value="Electrical">Electrical</option>
                                <option name="branch" value="Mechanical">Mechanical</option>
                                <option name="branch" value="Humanities">Humanities</option>
                            </select>
                        </div>


                        

                        <div class="form-group">
                            <label>Workshop/Seminar</label>
                            <select name="workshop_seminar" class="form-control" required>
                                <option value="">--Select--</option>
                                <option name="workshop_seminar" value="Workshop">Workshop</option>
                                <option name="workshop_seminar" value="Seminar">Seminar</option>
                            </select>
                        </div>
                        

                        <div class="form-group">
                            <label> Coordinator</label>
                            <input type="text" name="coordinator" class="form-control" placeholder="Name of the teacher" required>
                        </div>

                        <div class="form-group">
                            <label> Title of the workshop / seminar </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title of Chapter" required>
                        </div>

                        <div class="form-group">
                            <label>Category of the activity</label>
                            <select name="category" class="form-control" required>
                                <option value="">--Select Type of activity-</option>
                                <option name="category" value="Research Methodology">Research Methodology</option>
                                <option name="category" value="IPR">IPR</option>
                                <option name="category" value="Entrepreneurship">Entrepreneurship</option>
                                <option name="category" value="Soft skills">Soft skills</option>
                                <option name="category" value="Others">Others</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> If others, please mention the Theme/category</label>
                            <input type="text" name="others" class="form-control" placeholder="Enter category">
                        </div>

                        <div class="form-group">
                            <label> Number of Participants </label>
                            <input type="number" name="no_of_participants" class="form-control" placeholder="Enter number of participants" required>
                        </div>

                        <div class="form-group">
                            <label> Starting date </label>
                            <input type="date" name="start_date" class="form-control" placeholder="Starting date" required>
                        </div>
                        <div class="form-group">
                            <label> Ending date </label>
                            <input type="date" name="end_date" class="form-control" placeholder="Ending date" required>
                        </div>

                        

                        <div class="form-group">
                            <label> Upload Activity report in the appropraite template </label>
                            <input type="file" name="pdffile1" id="pdffile1" required/><br>
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
    </div> -->

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
                

            <div class="card-body mt-5">
                <h2> Workshop/Seminars</h2>
            </div>
            <?php 
if ($_SESSION["role"] == true) {
    echo '<form action="https://ims.fcrit.ac.in/clubadmin/dashboard.php" method="post" style="position: absolute; top: 100px; right: 70px;">
            <button type="submit" class="btn btn-primary" style="background-color: blue; color: white;">HOME</button>
          </form>';
    
    echo '<div style="position: absolute; top: 100px; right: 200px; font-weight: bold; color: #007bff;">Welcome ' . $_SESSION["role"] . '<br><span style="color: #008000;">You logged in as Club Admin</span></div>';
} else {
    header("Location: index.php"); 
}
?>
            <div class="card">
                <div class="card-body btn-group">
                <!-- <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal"> 
                        ADD DATA
                    </button>
            </form> &nbsp; -->

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
                                <th scope="col"> ID</th>
                                <th scope="col"> Year </th>
                                <th scope="col"> Branch </th>
                                <th scope="col"> Workshop/ seminar</th>
                                <th scope="col"> Coordinator </th>
                                <th scope="col"> Title of the workshop / seminar </th>
                                <th scope="col"> Category of the activity</th>
								<th scope="col"> If others, please mention the Theme/category</th>
                                <th scope="col"> Number of Participants</th>
                                <th scope="col"> Starting Date</th>
                                <th scope="col"> Ending Date</th>
                                <th scope="col">Action</th>
                                <th scope="col"> STATUS</th>
                               
                            </tr>
                        </thead>
                        
                        <?php
                        $user = $_SESSION["role"];
                        
                        $result = "SELECT * FROM clubadmin WHERE username = '$user'";

                        $query = mysqli_query($connection, $result);
                        $queryresult = mysqli_num_rows($query); 
                            if($queryresult > 0){
                                while($row = mysqli_fetch_assoc($query)){ 
                                    $id = $row['id'];
                                    
                                }  
                            }

                        $table_query = "SELECT * FROM workshops WHERE Source='aiclub' OR Source='ebsb' OR Source='ecell' OR Source='nss' OR Source='uba' OR Source='womencell'  OR  Source='ecoclub'  ORDER BY id ASC";
                        
                        $query_run = mysqli_query($connection, $table_query);
                        $query_result = mysqli_num_rows($query_run); ?>
                        <?php if($query_result > 0){
                                        while($developer = mysqli_fetch_assoc($query_run)){   
                                            ?>
                        <tbody> <!-- change -->
                            <tr>
                                  <td> <?php echo $developer['id']; ?> </td>
                                <td> <?php echo $developer['year']; ?> </td> 
                                <td> <?php echo $developer['branch']; ?> </td> 
                                <td> <?php echo $developer['workshop_seminar']; ?> </td>
                                <td> <?php echo $developer['coordinator']; ?> </td>
                                <td> <?php echo $developer['title']; ?> </td>
                                <td> <?php echo $developer['category']; ?> </td>
                                <td> <?php echo $developer['others']; ?> </td>
                                <td> <?php echo $developer['no_of_participants']; ?> </td>
                                <td> <?php echo $developer['start_date']; ?> </td>
                                <td> <?php echo $developer['end_date']; ?> </td>
                                <td>
                                <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                     <a href="../../activity_coordinator/workshop/uploads/<?php echo $developer['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<!-- <a href="uploadsfrontit/<?php echo $developer['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
<!--                             <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
 -->	
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
                                        <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                    </form>
                                <?php } elseif ($developer['STATUS'] == 'rejected') { ?>
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
            } else
                {
                    echo "No Record Found";
                }
            ?>
                    </table>
                    <?php
        // Approve button logic
        if (isset($_POST['approve'])) {
            $id = $_POST['id'];
            $select = "UPDATE workshops SET STATUS ='APPROVED' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Approved";
            header("Location: index.php");
        }

        // Reject button logic
        if (isset($_POST['reject'])) {
            $id = $_POST['id'];
            $select = "UPDATE workshops SET STATUS ='REJECTED' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Rejected";
            header("Location: index.php");
        }

        // Approve Now button logic
if (isset($_POST['approve_now'])) {
    $id = $_POST['id'];
    $select = "UPDATE workshops SET STATUS ='APPROVED' WHERE id='$id'";
    $result = mysqli_query($connection, $select);
    echo "Data Approved";
    header("Location: index.php");
}
        ?>
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
                            <label>Branch</label>
                            <select name="branch" class="form-control" required>
                                <option value="">--Select branch--</option>
                                <option name="branch" value="IT">IT</option>
                                <option name="branch" value="Computer">Computer</option>
                                <option name="branch" value="Extc">Extc</option>
                                <option name="branch" value="Electrical">Electrical</option>
                                <option name="branch" value="Mechanical">Mechanical</option>
                                <option name="branch" value="Humanities">Humanities</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Year</label>
                            <select name="year" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="year" value="2017-18">2017-18</option>
                                <option name="year" value="2018-19">2018-19</option>
                                <option name="year" value="2019-20">2019-20</option>
                                <option name="year" value="2020-21">2020-21</option>
                                <option name="year" value="2021-22">2021-22</option>
                                <option name="year" value="2021-23">2022-23</option>
                            </select>
                        </div>

                        

                        <div class="form-group">
                            <label>Workshop/Seminar</label>
                            <select name="workshop_seminar" class="form-control" required>
                                <option value="">--Select--</option>
                                <option name="workshop_seminar" value="Workshop">Workshop</option>
                                <option name="workshop_seminar" value="Seminar">Seminar</option>
                            </select>
                        </div>

                        

                        

                        <div class="form-group">
                            <label>Coordinator </label>
                            <input type="text"  id="coordinator" name="coordinator" class="form-control" placeholder="Enter name of Coordinator" required>
                        </div>

                        <div class="form-group">
                            <label> Title </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="title of workshop/seminar" required>
                        </div>

                        <div class="form-group">
                            <label> Category </label>
                            <input type="text" name="category"  id="category" class="form-control" placeholder="Enter Category">
                        </div>

                        <div class="form-group">
                            <label> Others</label>
                            <input type="text" name="others" id="others" class="form-control" placeholder="Enter Category">
                        </div>

                        <div class="form-group">
                            <label> Participants</label>
                            <input type="text" name="no_of_participants" id="no_of_participants" class="form-control" placeholder="Enter Number of participants" required>
                        </div>

                        <div class="form-group">
                            <label> Startingdate</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Starting date"max="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label> EndingDate</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Ending date" max="<?php echo date('Y-m-d'); ?>"required>
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
                        <th> ID</th>
                                <th > Year </th>
                                <th > Branch </th>
                                <th> Workshop/ seminar</th>
                                <th> Coordinator </th>
                                <th> Title of the workshop / seminar </th>
                                <th> Category of the activity</th>
								<th> If others, please mention the Theme/category</th>
                                <th> Number of Participants</th>
                                <th> Starting Date</th>
                                <th> Ending Date</th>
                                <th> Action</th>
                                <th> STATUS</th>
                        </tr>
                    <thead>       
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `workshops` WHERE Source='aiclub' OR Source='ebsb' OR Source='ecell' OR Source='nss' OR Source='uba' OR Source='womencell'  OR  Source='ecoclub'  AND (branch LIKE '%$str%' OR workshop_seminar LIKE '%$str%' OR year LIKE '%$str%'  OR coordinator LIKE '%$str%' OR title LIKE '%$str%' OR category LIKE '$str' OR others LIKE '%$str%' OR no_of_participants LIKE '%$str%' OR start_date LIKE '%$str%' OR end_date LIKE '%$str%' OR STATUS LIKE '$str') ";
        
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
                    <tbody> <!-- change -->
                            <tr>
                            <?php
                $status = $row['STATUS'];
                $is_disabled = ($status == "approved") ? "disabled" : "";
                // If STATUS is "approved", set the $is_disabled variable to "disabled"
                ?> 
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['year']; ?> </td> 
                                <td> <?php echo $row['branch']; ?> </td> 
                                <td> <?php echo $row['workshop_seminar']; ?> </td>
                                <td> <?php echo $row['coordinator']; ?> </td>
                                <td> <?php echo $row['title']; ?> </td>
                                <td> <?php echo $row['category']; ?> </td>
                                <td> <?php echo $row['others']; ?> </td>
                                <td> <?php echo $row['no_of_participants']; ?> </td>
                                <td> <?php echo $row['start_date']; ?> </td>
                                <td> <?php echo $row['end_date']; ?> </td>
                                <td>
<!--                             <a href="read.php?viewid=<?php echo htmlentities ($row['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->                      
<a href="../../activity_coordinator/workshop/uploads/<?php echo $row['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<!-- <a href="uploadsfrontit/<?php echo $developer['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
<!--                             <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
 -->							
                            
                            
 <?php if ($status != "approved") { // If STATUS is not "approved", show the edit and delete buttons ?>
                        <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip" <?php echo $is_disabled ?>>
                            <i class="material-icons">&#xE254;</i>
                        </a>

                        <a class="delete btn-danger deletebtn" title="Delete" data-toggle="tooltip" <?php echo $is_disabled ?>>
                            <i class="material-icons">&#xE872;</i>
                        </a>
                    <?php } ?>
                            </td>
                            <td>
                                <?php if ($row['STATUS'] == 'PENDING') { ?>
                                    <form method="POST" action="approved.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="submit" name="approve" value="Approve">
                                    </form>
                                    <form method="post" action="reject.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                    </form>
                                <?php } elseif ($row['STATUS'] == 'rejected') { ?>
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
                $('#branch').val(data[2]);
                $('#workshop_seminar').val(data[3]);
                $('#coordinator').val(data[4]);
                $('#title').val(data[5]);
                $('#category').val(data[6]);
                $('#others').val(data[7]);
                $('#no_of_participants').val(data[8]);
                $('#start_date').val(data[9]);
                $('#end_date').val(data[10]);
                //$('#pdffile1').val(data[11]);
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

    //user-defined function to export the data to CSV file format  
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