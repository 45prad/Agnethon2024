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
    <title> BOOK CHAPTERS PUBLISHED </title>

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
                            <label>ACADEMIC YEAR*</label>
                            <select name="academic_year" class="form-control" required>
                                <option value="">--Select Year--</option>
                                <option name="academic_year" value="2019-20">2019-20</option>
                                <option name="academic_year" value="2020-21">2020-21</option>
                                <option name="academic_year" value="2021-22">2021-22</option>
                                <option name="academic_year" value="2022-23">2022-23</option>
                                <option name="academic_year" value="2023-24">2023-24</option>
                                <option name="academic_year" value="2024-25">2024-25</option>
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
                            <label> NAME OF THE TEACHER* </label>
                            <input type="text" name="Name_Of_The_Teacher" class="form-control" placeholder="Name of the teacher" required>
                        </div>
                        <div class="form-group">
                            <label>TITLE OF THE BOOK PUBLISHED* </label>
                            <input type="text" name="Title_Of_The_Book_Published" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label>Select National/International*</label>
                            <select name="National_Or_International" class="form-control" required>
                                <option value="">--Select Type of Publication--</option>
                                <option name="National_Or_International" value="National">National</option>
                                <option name="National_Or_International" value="International">International</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> YEAR OF PUBLICATION* </label>
                            <input type="number" name="Year_Of_Publication" class="form-control" placeholder="Enter Year" required>
                        </div>
                        <div class="form-group">
                            <label> ENTER ISBN/ISSN NUMBER* </label>
                            <input type="number" name="ISBN_Or_ISSN_Number" class="form-control" placeholder="Enter ISBN/ISSN number" required>
                        </div>
                        <div class="form-group">
                            <label> AFFILIATING INSTITUE AT THE TIME OF PUBLICATION* </label>
                            <input type="text" name="Affiliating_institute" class="form-control" placeholder="Enter Institute" required>
                        </div>

                        <div class="form-group">
                            <label> NAME OF PUBLISHER* </label>
                            <input type="text" name="Name_Of_The_Publisher" class="form-control" placeholder="Enter Name of Publisher" required>
                        </div>
                        <div class="form-group">
    <label>PAPER WEBLINK/DOI*</label>
    <input type="text"  name="paper_link" class="form-control" placeholder="weblink/DOI" required>
</div>
<!-- 
<script>
    // Get the input element
    var paperLinkInput = document.getElementById("paper_link");

    // Add an event listener to listen for changes in the input field
    paperLinkInput.addEventListener("input", function() {
        // Get the entered text
        var enteredText = paperLinkInput.value;

        // Create a hyperlink
        var hyperlink = '<a href="' + enteredText + '">' + enteredText + '</a';

        // Display the hyperlink
        document.getElementById("result").innerHTML = hyperlink;
    });
</script> -->

<!-- Display the generated hyperlink
<div id="result"></div> -->

                        <div class="form-group">
                            <label> SUBMIT INDEX PAGE OF BOOK SHOWING NAME OF AUTHOR </label>
                            <input type="file" name="pdffile1" id="pdffile1"  accept="application/pdf" /><br>
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
                        <div class="form-group">
                            <label> SUBMIT FRONT PAGE OF BOOK </label>						
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

                                        $allowedExtensions = array('pdf');
$uploadedFileExtension = pathinfo($_FILES['pdffile2']['name'], PATHINFO_EXTENSION);

if (!in_array($uploadedFileExtension, $allowedExtensions)) {
    // File type is not allowed (not a PDF)
    // You can handle the error or display a message to the user.
    echo "Invalid file type. Only PDF files are allowed.";
} else {
    // File type is valid, you can proceed with the upload.
    // Move the uploaded file to a designated directory.
    move_uploaded_file($_FILES['pdffile2']['tmp_name'], '"uploadsfrontit/' . $_FILES['pdffile2']['name']);
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

    <!-- DELETE POP UP FORM  -->
    <!-- dont make changes-->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Faculty Data </h5>
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
                <h2> BOOK CHAPTER/PUBLISHED</h2>
                
            </div>
            

            <?php 
if ($_SESSION["role"] == true) {
    echo '<form action="https://ims.fcrit.ac.in/professors/dashboard.php" method="post" style="position: absolute; top: 100px; right: 70px;">
            <button type="submit" class="btn btn-primary" style="background-color: blue; color: white;">HOME</button>
          </form>';
    
    echo '<div style="position: absolute; top: 100px; right: 200px; font-weight: bold; color: #007bff;">Welcome ' . $_SESSION["role"] . '<br><span style="color: #008000;">You logged in as Professor</span></div>';
} else {
    header("Location: index.php"); 
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
                                <th scope="col"> BRANCH </th>
                                <th scope="col"> NAME OF THE TEACHER </th>
                                <th scope="col"> TITLE OF THE BOOK/CHAPTER PUBLISHED </th>
                                <th scope="col"> NATIONAL/INTERNATIONAL </th>
                                <th scope="col"> YEAR OF PUBLICATION </th>
                                <th scope="col"> ISBN/ISSN NUMBER </th>
								<th scope="col"> AFFILIATING INSTITUTE AT TIME OF PUBLICATION </th>
                                <th scope="col"> NAME OF PUBLISHER </th>
                                <th scope="col"> PAPER WEBLINK/DOI </th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS</th>
                               
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

                        $table_query = "SELECT * FROM bookschapter WHERE user_id=$id";
                        
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
                                <td> <?php echo $developer['academic_year']; ?> </td>                                 
                                <td> <?php echo $developer['Branch']; ?> </td>
                                <td> <?php echo $developer['Name_Of_The_Teacher']; ?> </td> 
                                <td> <?php echo $developer['Title_Of_The_Book_Published']; ?> </td>
                                <td> <?php echo $developer['National_Or_International']; ?> </td>                                
                                <td> <?php echo $developer['Year_Of_Publication']; ?> </td>
                                <td> <?php echo $developer['ISBN_Or_ISSN_Number']; ?> </td>
                                <td> <?php echo $developer['Affiliating_institute']; ?> </td>
                                <td> <?php echo $developer['Name_Of_The_Publisher']; ?> </td>
                                <td><a href="<?php echo $developer['paper_link']; ?>" target="_blank"><?php echo $developer['paper_link']; ?></a></td>

                                <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($developer['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
                            <!-- <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> -->
                            
                            <a href="uploadsindexit/<?php echo $developer['pdffile1']; ?>" target="_blank"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<a href="uploadsfrontit/<?php echo $developer['pdffile2']; ?>" target="_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
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
                            <input type="text"  id="academic_year" name="academic_year" class="form-control" required>
                        </div>

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
                            <label> Name of the Teacher* </label>
                            <input type="text" name="Name_Of_The_Teacher" id="Name_Of_The_Teacher" class="form-control" placeholder="Name of the teacher" required>
                        </div>

                        <div class="form-group">
                            <label> Title of the Book Published* </label>
                            <input type="text"  id="Title_Of_The_Book_Published" name="Title_Of_The_Book_Published" class="form-control" placeholder="Enter Title" required>
                        </div>

                        <div class="form-group">
                            <label>Select National/International*</label>
                            <select id="National_or_International" name="National_Or_International" class="form-control" required>
                                <option id="National_or_International" name="National_Or_International" value="National">National</option>
                                <option id="National_or_International" name="National_Or_International" value="International">International</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Year of Publication* </label>
                            <input type="text" name="Year_Of_Publication" id="Year_Of_Publication" class="form-control" placeholder="Enter Year" required >
                        </div>
                        <div class="form-group">
                            <label> Enter ISBN/ISSN number* </label>
                            <input type="text" name="ISBN_Or_ISSN_Number" id="ISBN_Or_ISSN_Number" class="form-control" placeholder="Enter ISBN/ISSN number" required >
                        </div>

                        <div class="form-group">
                            <label> Affiliating Institute at the time of publication* </label>
                            <input type="text" name="Affiliating_institute" id="Affiliating_institute" class="form-control" placeholder="Enter Institute name" required>
                        </div>

                        <div class="form-group">
                            <label> Name of publisher* </label>
                            <input type="text" name="Name_Of_The_Publisher" id="Name_Of_The_Publisher" class="form-control" placeholder="Enter Name of Publisher" required>
                        </div>

                        <div class="form-group">
                            <label> Paper Weblink/DOI* </label>
                            <input type="text" name="paper_link" id="paper_link" class="form-control" placeholder="Enter link" required>
                        </div>


<!--                         
                        <div class="form-group">
                            <label> SUBMIT INDEX PAGE OF BOOK SHOWING NAME OF AUTHOR </label>
                            <input type="file" name="pdffile1" id="pdffile1" accept="application/pdf" /><br>
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
                                        $targetDirectory = "uploadsindexit/";
                                        $targetFilePath = $targetDirectory . $_FILES['pdffile1']['name'];   

                                        // Check if a file with the same name exists
                                            if (file_exists($targetFilePath)) {
                                            // If a file with the same name exists, delete it
                                            unlink($targetFilePath);
                                            }

                                        // Upload the new PDF file
                                        if (move_uploaded_file($_FILES['pdffile1']['tmp_name'], $targetFilePath)) {
                                            echo "File uploaded and replaced successfully.";
                                        } else {
                                            echo "Error uploading file.";
                                        }
                                    }
                                        
                                    </script><br>

                                    
						</div>
                        <div class="form-group">
                            <label> SUBMIT FRONT PAGE OF BOOK </label>						
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

                                        $allowedExtensions = array('pdf');
$uploadedFileExtension = pathinfo($_FILES['pdffile2']['name'], PATHINFO_EXTENSION);

if (!in_array($uploadedFileExtension, $allowedExtensions)) {
    // File type is not allowed (not a PDF)
    // You can handle the error or display a message to the user.
    echo "Invalid file type. Only PDF files are allowed.";
} else {
    $targetDirectory = "uploadsfrontit/";
    $targetFilePath = $targetDirectory . $_FILES['pdffile2']['name'];   

     // Check if a file with the same name exists
     if (file_exists($targetFilePath)) {
            // If a file with the same name exists, delete it
            unlink($targetFilePath);
        }

        // Upload the new PDF file
        if (move_uploaded_file($_FILES['pdffile2']['tmp_name'], $targetFilePath)) {
            echo "File uploaded and replaced successfully.";
        } else {
            echo "Error uploading file.";
        }
    }                                  
                                    </script><br>
						</div>			 -->


                    <!-- </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="insertbutton" name="insertdata" class="btn btn-primary" onClick="datechecker() ">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div> -->

                         

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
                                <!-- <th scope="col"> ID </th> -->
                                <th scope="col"> ACADEMIC YEAR* </th>
                                <th scope="col"> BRANCH* </th>
                                <th scope="col"> NAME OF THE TEACHER* </th>
                                <th scope="col"> TITLE OF THE BOOK/CHAPTER PUBLISHED* </th>
                                <th scope="col"> NATIONAL/INTERNATIONAL* </th>
                                <th scope="col"> YEAR OF PUBLICATION* </th>
                                <th scope="col"> ISBN/ISSN NUMBER* </th>
								<th scope="col"> AFFILIATING INSTITUTE AT TIME OF PUBLICATION* </th>
                                <th scope="col"> NAME OF PUBLISHER* </th>
                                <th scope="col"> PAPER WEBLINK/DOI* </th>
                                <th scope="col"> ACTION </th>
                                <th scope="col"> STATUS</th>
                        </tr>
                    <thead>       


<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `bookschapter` WHERE user_id=$id AND (Branch LIKE '%$str%' OR Name_Of_The_Teacher LIKE '%$str%' OR Title_Of_The_Book_Published LIKE '%$str%' OR paper_link LIKE '%$str%' OR Name_Of_The_Publisher LIKE '%$str%' OR National_Or_International LIKE '$str' OR ISBN_Or_ISSN_Number LIKE '%$str%' OR Year_Of_Publication LIKE '%$str%' OR Affiliating_institute LIKE '%$str%' OR STATUS LIKE '$str' OR academic_year LIKE '%$str%') ";
        
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
                                <td> <?php echo $row['academic_year']; ?> </td>                                 
                                <td> <?php echo $row['Branch']; ?> </td>
                                <td> <?php echo $row['Name_Of_The_Teacher']; ?> </td> 
                                <td> <?php echo $row['Title_Of_The_Book_Published']; ?> </td>
                                <td> <?php echo $row['National_Or_International']; ?> </td>                                
                                <td> <?php echo $row['Year_Of_Publication']; ?> </td>
                                <td> <?php echo $row['ISBN_Or_ISSN_Number']; ?> </td>
                                <td> <?php echo $row['Affiliating_institute']; ?> </td>
                                <td> <?php echo $row['Name_Of_The_Publisher']; ?> </td>
                              
                                 <td><a href="<?php echo $row['paper_link']; ?>" target="_blank"><?php echo $row['paper_link']; ?></a></td>
                        <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($row['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
                            <!-- <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> -->
                            <a href="uploadsindexit/<?php echo $row['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<a href="uploadsfrontit/<?php echo $row['pdffile2']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <!-- <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a> -->
							
                            
                            
                            <!-- <button class="btn"><i class="fa fa-download"></i> Download</button> -->

                             
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
                $('#academic_year').val(data[1]);
                $('#Branch').val(data[2]);
                $('#Name_Of_The_Teacher').val(data[3]);
                $('#Title_Of_The_Book_Published').val(data[4]);
                $('#National_Or_International').val(data[5]);
                $('#Year_Of_Publication').val(data[6]);
                $('#ISBN_Or_ISSN_Number').val(data[7]);
                $('#Affiliating_institute').val(data[8]);
                $('#Name_Of_The_Publisher').val(data[9]);
                $('#paper_link').val(data[10]);
                $('#pdffile1').val(data[11]);
                $('#pdffile2').val(data[12]);
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