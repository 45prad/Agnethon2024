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
    <title> Conference Publication </title>

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
                            <label>Academic Year (July 1st -June 30th)*</label>
                            <select name="Academic_year" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="Academic_year" value="2019-20">2019-20</option>
                                <option name="Academic_year" value="2020-21">2020-21</option>
                                <option name="Academic_year" value="2021-22">2021-22</option>
                                <option name="Academic_year" value="2022-23">2022-23</option>
                                <option name="Academic_year" value="2023-24">2023-24</option>
                                <option name="Academic_year" value="2024-25">2024-25</option>
                            </select>
                        </div>

                        <div class="form-group">
                                <label>Branch</label>
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
                            <label> Name of the Teacher* </label>
                            <input type="text" name="Name_Of_The_Teacher"   class="form-control" placeholder="Name of the teacher" required>
                        </div>

                        <div class="form-group">
                            <label> Title of the Paper* </label>
                            <input type="text" name="Title_Of_The_Paper"  class="form-control" placeholder="Title of the Paper ">
                        </div>

                        <div class="form-group">
                            <label> Title of the proceedings of the conference* </label>
                            <input type="text" name="Title_Of_The_Proceedings" class="form-control"  placeholder="Title of the proceedings of the conference" required>
                        </div>

                        <div class="form-group">
                            <label> Name of the Conference* </label>
                            <input type="text" name="Name_Of_The_Conference"  class="form-control" placeholder="Name of the Conference" required>
                        </div>

                        <div class="form-group">
                            <label>Select National/International*</label>
                            <select name="National_Or_International" class="form-control" required>
                                <option value="National_Or_International">--Select Publication--</option>
                                <option name="National_Or_International" value="National">National</option>
                                <option name="National_Or_International" value="International">International</option>
                            </select>
                        </div>


                      <div class="form-group">
                            <label> Year of Publication* </label>
                            <input type="number" name="Year_Of_Publication" class="form-control"  placeholder="Enter Year of publication" required>
                            
                        </div>

                        <div class="form-group">
                            <label> Enter ISBN/ISSN number </label>
                            <input type="text" name="ISBN_Or_ISSN_Number"  class="form-control" placeholder="Enter ISBN/ISSN number">
                        </div>

                        <div class="form-group">
                            <label> Affiliating Institute at the time of Publication* </label>
                            <input type="text" name="Affiliating_Institute" class="form-control" placeholder="Affiliating Institute at the time of Publication" required>
                        </div>

                        <div class="form-group">
                            <label> Name of the Publisher* </label>
                            <input type="text" name="Name_Of_Publisher" class="form-control" placeholder="Name of the Publisher" required>
                        </div>

<!-- 
                        <div class="form-group">
                            <label> INDEXING</label>
                            <input type="text" name="Indexing" class="form-control" placeholder="Indexing" required>
                        </div> -->


                        <div class="form-group">
                            <label>Indexing*</label>
                            <select name="Indexing" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="SCI">SCI</option>
                                <option value="ESCI">ESCI</option>
                                <option value="SCOPUS">SCOPUS</option>
                                <option value="WEB OF SCIENCE">WEB OF SCIENCE</option>
                            
                                <option value="other">Other</option> 
                            </select>
                        </div>

                        <div class="form-group">
                            <label>  Any other Indexing </label>
                            <input type="text" name="other"  class="form-control" placeholder="any other indexing other than mentioned above">
                        </div>


                        <div class="form-group">
                            <label> Details of Paper Published(IEEE Format)* </label>
                            <input type="text" name="Details_Of_Paper" class="form-control" placeholder="Enter details of paper" required>
                        </div>

                        <div class="form-group">
                            <label> Paper Weblink/ DOI </label>
                            <input type="text" name="Paper_Weblink" class="form-control" placeholder="Enter Paper weblink/ DOI" required>
                        </div>

<!-- 
                           <div class="form-group">
                            <label> Conference paper </label>
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
						</div> -->
                        <div class="form-group">
                            <label> Conference Paper </label>						
						    <input type="file" name="pdffile2" id="pdffile2" accept="application/pdf"  /><br>
                                    <img src="" id="pdf-file2-tag" width="100px" />

                                    <script type="text/javascript">
                                        function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    $('#pdf-file2-tag').attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        $("#pdffile2").change(function(){
                                            readURL(this);
                                        });
                                    </script><br>
						</div>	
                        
                        <div class="form-group">
                            <label> Conference Certificate </label>						
						    <input type="file" name="pdffile3" id="pdffile3" accept="application/pdf" ><br>
                                    <img src="" id="pdf-file3-tag" width="100px" />

                                    <script type="text/javascript">
                                        function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    $('#pdf-file3-tag').attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        $("#pdffile3").change(function(){
                                            readURL(this);
                                        });
                                    </script><br>
						</div>	
                        
                        <!-- <div class="form-group">
                            <label> SoftCopy of Application Letter/Reimbursement Letter of Registration & TA amount </label>						
						    <input type="file" name="pdffile4" id="pdffile4"><br>
                                    <img src="" id="pdf-file4-tag" width="100px" />

                                    <script type="text/javascript">
                                        function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    $('#pdf-file4-tag').attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        $("#pdffile4").change(function(){
                                            readURL(this);
                                        });
                                    </script><br>
						</div> -->

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
              

            <div class="card-body mt-5">
                <h2> CONFERENCE PUBLICATION </h2>
            </div>


            <?php 
if ($_SESSION["role"] == true) {
    echo '<form action="https://ims.fcrit.ac.in/professors/dashboard.php" method="post" style="position: absolute; top: 100px; right: 70px;">
            <button type="submit" class="btn btn-primary" style="background-color: blue; color: white;">HOME</button>
          </form>';
    
    echo '<div style="position: absolute; top: 100px; right: 200px; font-weight: bold; color: #007bff;">Welcome ' . $_SESSION["role"] . '<br><span style="color: #008000;">You logged in as Professor</span></div>';
} else {
    header("Location: index.php");}
?>
            <div class="card">
                <div class="card-body btn-group">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal"> 
                        ADD DATA
                    </button>
            </form> &nbsp;

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" onclick="exportTableToCSVuser('USerData_ConferencePublication.csv')" class="btn btn-success">Export to excel</button>
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
                                <th scope="col"> NAME OF TEACHER </th>
                                <th scope="col"> TITLE OF PAPER </th>
                                <th scope="col"> TITLE OF THE PROCEEDINGS OF THE CONFERENCE </th>
                                <th scope="col"> NAME OF THE CONFERENCE </th>
                                <th scope="col"> NATIONAL/INTERNATIONAL </th>
                                <th scope="col"> YEAR OF PUBLICATION </th>
                                <th scope="col"> ISBN/ISSN NUMBER OF PROCEEDING </th>
                                <th scope="col"> AFFILIATING INSTITUTE AT TIME OF PUBLICATION </th>
                                <th scope="col"> NAME OF PUBLISHER </th>
                                <th scope="col"> DETAILS OF PAPER PUBLISHED (IEEE FORMAT) WITH DATE  </th>
                                <th scope="col"> INDEXING </th>
                                <th scope="col"> OTHER INDEXING </th>
                                <th scope="col"> PAPER WEBLINK / DOI</th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS </th>
                            </tr>
                        </thead>
                        
                        <?php
                        $user = $_SESSION["role"];
                        
                        $result = "SELECT * FROM credentials WHERE username = '$user'";

                        $query = mysqli_query($connection, $result);
                        $queryresult = mysqli_num_rows($query); 
                            if($queryresult > 0){
                                while($row = mysqli_fetch_assoc($query)){ 
                                    $id = $row['id'];
                                    $branch = $row['branch'];
                                }  
                            }

                        $table_query = "SELECT * FROM conferencepublication WHERE user_id=$id";  
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
                                <td> <?php echo $developer['Academic_year']; ?> </td> 
                                <td> <?php echo $developer['Name_Of_The_Teacher']; ?> </td> 
                                <td> <?php echo $developer['Title_Of_The_Paper']; ?> </td>
                                <td> <?php echo $developer['Title_Of_The_Proceedings']; ?> </td>
                                <td> <?php echo $developer['Name_Of_The_Conference']; ?> </td>
                                <td> <?php echo $developer['National_Or_International']; ?> </td>
                                <td> <?php echo $developer['Year_Of_Publication']; ?> </td>
                                <td> <?php echo $developer['ISBN_Or_ISSN_Number']; ?> </td>
                                <td> <?php echo $developer['Affiliating_Institute']; ?> </td>
                                <td> <?php echo $developer['Name_Of_Publisher']; ?> </td>
                                <td> <?php echo $developer['Details_Of_Paper']; ?> </td>
                                <td> <?php echo $developer['Indexing']; ?> </td>
                                <td> <?php echo $developer['other']; ?> </td>
                                <!-- <td> <?php echo $developer['Paper_Weblink']; ?> </td> -->
                                <td><a href="<?php echo $developer['Paper_Weblink']; ?>" target="_blank"><?php echo $developer['Paper_Weblink']; ?></a></td>


                            
                                <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($developer['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
                            <!-- <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> -->
                            <!-- <a href="Paper_Details/<?php echo $developer['pdffile1']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
							<a href="Conference_Paper/<?php echo $developer['pdffile2']; ?>" target="_blank"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <a href="Conference_Certificate/<?php echo $developer['pdffile3']; ?>" target="_blank"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <!-- <a href="Application_Letter/<?php echo $developer['pdffile4']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
                            <!-- <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a> -->
							
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
                            <label> Academic Year </label>
                            <input type="text"  id="Academic_year" name="Academic_year" class="form-control" required>
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
                            <label> Name of the Teacher* </label>
                            <input type="text" id="Name_Of_The_Teacher" name="Name_Of_The_Teacher" class="form-control" placeholder="Name of the teacher" required>
                        </div>

                        <div class="form-group">
                            <label> Title of the Paper* </label>
                            <input type="text" id="Title_Of_The_Paper" name="Title_Of_The_Paper" class="form-control" placeholder="Title of the Paper " required>
                        </div>

                        <div class="form-group">
                            <label> Title of the proceedings of the conference* </label>
                            <input type="text" id="Title_Of_The_Proceedings" name="Title_Of_The_Proceedings" class="form-control" placeholder="Title of the proceedings of the conference" required>
                        </div>

                        <div class="form-group">
                            <label> Name of the Conference* </label>
                            <input type="text" id="Name_Of_The_Conference" name="Name_Of_The_Conference" class="form-control" placeholder="Name of the Conference" required>
                        </div>

                        <div class="form-group">
                            <label> National/International* </label>
                            <input id='National_Or_International' type="text" name="National_Or_International" class="form-control" placeholder="Enter Title" required>
                        </div>
                        
                        <div class="form-group">
                            <label> Year of Publication </label>
                            <input type="text" id="Year_Of_Publication" name="Year_Of_Publication" class="form-control" placeholder="Enter Year of Publication" required>
                        </div>


                        <div class="form-group">
                            <label> Enter ISBN/ISSN number </label>
                            <input type="text" id="ISBN_Or_ISSN_Number" name="ISBN_Or_ISSN_Number" class="form-control" placeholder="Enter ISBN/ISSN number">
                        </div>

                        <div class="form-group">
                            <label> Affiliating Institute at the time of Publication* </label>
                            <input type="text" id="Affiliating_Institute" name="Affiliating_Institute" class="form-control" placeholder="Affiliating Institute at the time of Publication" required>
                        </div>

                        <div class="form-group">
                            <label> Name of the Publisher* </label>
                            <input type="text" id="Name_Of_Publisher" name="Name_Of_Publisher" class="form-control" placeholder="Name of the Publisher" required>
                        </div>

                        <div class="form-group">
                            <label> Indexing </label>
                            <input type="text" id="Indexing" name="Indexing" class="form-control" placeholder="Indexing" required>
                        </div>

                        <!-- <div class="form-group">
                            <label>Indexing*</label>
                            <select name="Indexing" class="form-control" id="Indexing" required>
                                <option value="">--Select--</option>
                                <option value="SCI">SCI</option>
                                <option value="ESCI">ESCI</option>
                                <option value="SCOPUS">SCOPUS</option>
                                <option value="WEB OF SCIENCE">WEB OF SCIENCE</option>
                            
                                <option value="other">Other</option> 
                            </select>
                        </div> -->

                        <div class="form-group">
                            <label>  Any other Indexing </label>
                            <input type="text" name="other"  class="form-control" placeholder="any other indexing other than mentioned above">
                        </div>

                      

                        <div class="form-group">
                            <label> Datails of Paper Published(IEEE Format)* </label>
                            <input type="text" id="Details_Of_Paper" name="Details_Of_Paper" class="form-control" placeholder="Enter details of paper" required>
                        </div>

                  
                        <div class="form-group">
                            <label> Paper Weblink/ DOI </label>
                            <input type="text" id="Paper_Weblink" name="Paper_Weblink" class="form-control" placeholder="Enter Paper weblink/ DOI" required>
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
                                <th > ACADEMIC YEAR (JULY 1st -JUNE 30th )</th>
                                <th > NAME OF TEACHER </th>
                                <th > TITLE OF PAPER </th>
                                <th > TITLE OF THE PROCEEDINGS OF THE CONFERENCE </th>
                                <th > NAME OF THE CONFERENCE </th>
                                <th > NATIONAL/INTERNATIONAL </th>
                                <th > YEAR OF PUBLICATION </th>
                                <th > ISBN/ISSN NUMBER OF PROCEEDING </th>
                                <th > AFFILIATING INSTITUTE AT TIME OF PUBLICATION </th>
                                <th > NAME OF PUBLISHER </th>
                                <th > DETAILS OF PAPER PUBLISHED (IEEE FORMAT) WITH DATE  </th>
                                <th > INDEXING </th>
                                <th > OTHER INDEXING </th>
                                <th > PAPER WEBLINK / DOI</th>
                                <th > ACTION </th>
                                <th > STATUS </th>

                        </tr>
</thead>       
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `conferencepublication` WHERE user_id=$id AND (Academic_year LIKE '%$str%' OR  Name_Of_The_Teacher LIKE '%$str%' OR Title_Of_The_Paper LIKE '%$str%' OR Title_Of_The_Proceedings LIKE '%$str%' OR  Name_Of_The_Conference LIKE '%$str%' OR National_Or_International LIKE '%$str%'  OR Year_Of_Publication LIKE '%$str%' OR ISBN_Or_ISSN_Number LIKE '%$str%' OR Affiliating_Institute LIKE '%$str%' OR Name_Of_Publisher LIKE '%$str%' OR Details_Of_Paper LIKE '%$str%' OR Paper_Weblink LIKE '%$str%' OR Indexing LIKE '%$str%' OR STATUS LIKE '$str')";
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
                       
                       <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['Academic_year']; ?> </td> 
                                <td> <?php echo $row['Name_Of_The_Teacher']; ?> </td> 
                                <td> <?php echo $row['Title_Of_The_Paper']; ?> </td>
                                <td> <?php echo $row['Title_Of_The_Proceedings']; ?> </td>
                                <td> <?php echo $row['Name_Of_The_Conference']; ?> </td>
                                <td> <?php echo $row['National_Or_International']; ?> </td>
                                <td> <?php echo $row['Year_Of_Publication']; ?> </td>
                                <td> <?php echo $row['ISBN_Or_ISSN_Number']; ?> </td>
                                <td> <?php echo $row['Affiliating_Institute']; ?> </td>
                                <td> <?php echo $row['Name_Of_Publisher']; ?> </td>
                                <td> <?php echo $row['Details_Of_Paper']; ?> </td>
                                <td> <?php echo $row['Indexing']; ?> </td>
                                <td> <?php echo $row['other']; ?> </td>
                                <td><a href="<?php echo $row['Paper_Weblink']; ?>" target="_blank"><?php echo $row['Paper_Weblink']; ?></a></td>
                        
                        <td>

                            <!-- <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> -->
                            <!-- <a href="Paper_Details/<?php echo $row['pdffile1']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
							<a href="Conference_Paper/<?php echo $row['pdffile2']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <a href="Conference_Certificate/<?php echo $row['pdffile3']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <!-- <a href="Application_Letter/<?php echo $row['pdffile4']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a> -->
                            <!-- <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a> -->
							
                         
                            <?php if ($status == "approved") { ?>
    <!-- Code for when the status is approved -->
    <!-- You can hide the delete and edit buttons for the approved status -->
<?php } elseif ($status == "Sent Back") { ?>
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
                $('#Academic_year').val(data[1]);
                $('#Name_Of_The_Teacher').val(data[2]);
                
                $('#Title_Of_The_Paper').val(data[3]);
                $('#Title_Of_The_Proceedings').val(data[4]);
                $('#Name_Of_The_Conference').val(data[5]);
                $('#National_Or_International').val(data[6]);
               
				$('#Year_Of_Publication').val(data[7]);
                $('#ISBN_Or_ISSN_Number').val(data[8]);
                $('#Affiliating_Institute').val(data[9]);
                $('#Name_Of_Publisher').val(data[10]);
                $('#Details_Of_Paper').val(data[11]);
                $('#Indexing').val(data[12]);
                $('#Paper_Weblink').val(data[13]);
              
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
        csv = '\uFEFF' + csv;

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
        csv = '\uFEFF' + csv;

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