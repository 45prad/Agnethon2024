<?php 
include('../../config.php');
session_start();
?>
<!DOCTYPE html> 

<html lang="en">

<!-- Giitbygby -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Research Projects & Consultancies </title>

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
                <h2> Research Projects / Consultancies </h2>
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
                                <th scope="col"> RESEARCH PROJECT / CONSULTANCY </th>
                                <th scope="col"> NAME OF THE PROJECT/ENDOWNMENTS </th>
                                <th scope="col"> NAME OF THE PRINCIPAL INVESTIGATOR/CO-INVESTIGATOR </th>
                                <th scope="col"> DEPARTMENT OF PRINCIPAL INVESTIGATOR </th>
                                <th scope="col"> YEAR OF AWARD </th>
                                <th scope="col"> AMOUNT SANCTIONED </th>
                                <th scope="col"> DURATION OF THE PROJECT </th>
								<th scope="col"> NAME OF THE FUNDING AGENCY </th>
                                <th scope="col"> FUNDING AGENCY WEBSITE LINK </th>
                                <th scope="col"> TYPE(GOVT./NON-GOVT.) </th>
                                <th scope="col"> UPLOAD THE RELEVANT DOCUMENT </th>
                                <th scope="col"> STATUS </th>
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
                                    // $branch = $row['branch'];
                                }  
                            }

                        
                        $table_query = "SELECT * FROM researchprojectconsultancies WHERE Source='club' ORDER BY id ASC";  
                        $query_run = mysqli_query($connection, $table_query);
                        $query_result = mysqli_num_rows($query_run); ?>

                        <?php if($query_result > 0){
                                        while($developer = mysqli_fetch_assoc($query_run)){   
                                            ?>
                        <tbody> <!-- change -->
                            <tr>
                                <td> <?php echo $developer['id']; ?> </td> 
                                <td> <?php echo $developer['Type_Research_Project_Consultancy']; ?> </td> 
                                <td> <?php echo $developer['Name_Of_Project_Endownment']; ?> </td> 
                                <td> <?php echo $developer['Name_Of_Principal_Investigator_CoInvestigator']; ?> </td>
                                <td> <?php echo $developer['Department_Of_Principal_Investigator']; ?> </td>
                                <td> <?php echo $developer['Year_Of_Award']; ?> </td>
                                <td> <?php echo $developer['Amount_Sanctioned']; ?> </td>
                                <td> <?php echo $developer['Duration_Of_The_Project']; ?> </td>
                                <td> <?php echo $developer['Name_Of_The_Funding_Agency']; ?> </td>
                                <td> <?php echo $developer['Funding_Agency_Website_Link']; ?> </td>
                                <td> <?php echo $developer['Type_Govt_NonGovt']; ?> </td>
                                <td>
                                <a href="../../activity_coordinator/researchprojects-consultancies/uploadsindex1/<?php echo $developer['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip">
                            <i class="fa fa-download"></i>
                             <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
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
                    
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
                    </table>

                    <?php
        // Approve button logic
        if (isset($_POST['approve'])) {
            $id = $_POST['id'];
            $select = "UPDATE researchprojectconsultancies SET STATUS ='APPROVED' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Approved";
            header("Location: index.php");
        }

        // Reject button logic
        if (isset($_POST['reject'])) {
            $id = $_POST['id'];
            $select = "UPDATE researchprojectconsultancies SET STATUS ='REJECTED' WHERE id='$id'";
            $result = mysqli_query($connection, $select);
            echo "Data Rejected";
            header("Location: index.php");
        }

        // Approve Now button logic
if (isset($_POST['approve_now'])) {
    $id = $_POST['id'];
    $select = "UPDATE researchprojectconsultancies SET STATUS ='APPROVED' WHERE id='$id'";
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
                            <label>Select Research Project/Consultancy</label>
                            <select name="Type_Research_Project_Consultancy" class="form-control" required>
                                <option value="">--Select Type of Research--</option>
                                <option name="Type_Research_Project_Consultancy" id="Type_Research_Project_Consultancy" value="Research Project">Research Project</option>
                                <option name="Type_Research_Project_Consultancy" id="Type_Research_Project_Consultancy" value="Research Consultancy">Research Consultancy</option>
                            </select>
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
                            <label> Name of the Project/Endownments </label>
                            <input type="text" name="Name_Of_The_Project_Endownment" id="Name_Of_The_Project_Endownment"class="form-control" placeholder="Name of the Project/Endownment" required>
                        </div>

                        <div class="form-group">
                            <label> Name of the Principal Investigator/Co-investigator </label>
                            <input type="text" name="Name_Of_The_Principal_Investigator_CoInvestigator" id="Name_Of_The_Principal_Investigator_CoInvestigator"class="form-control" placeholder="Name of the Principal Investigator/Co-Investigator" required>
                        </div>

                        <div class="form-group">
                            <label> Department of Principal Investigator </label>
                            <input type="text" name="Department_Of_Principal_Investigator" id="Department_Of_Principal_Investigator"class="form-control" placeholder="Department of Principal Investigator">
                        </div>

                        <div class="form-group">
                            <label> Year of Award</label>
                            <input type="text" name="Year_Of_Award" id="Year_Of_Award"class="form-control" placeholder="Year of Award" required>
                        </div>

                        <div class="form-group">
                            <label> Amount Sanctioned</label>
                            <input type="text" name="Amount_Sanctioned" id="Amount_Sanctioned"class="form-control" placeholder="Amount Sanctioned" required>
                        </div>

                        <div class="form-group">
                            <label>Duration of the project</label>
                            <input type="text" name="Duration_Of_The_Project" id="Duration_Of_The_Project"class="form-control" placeholder="Duration of project" required>
                        </div>

                        <div class="form-group">
                            <label>Name of the Funding Agency</label>
                            <input type="text" name="Name_Of_The_Funding_Agency" id="Name_Of_The_Funding_Agency"class="form-control" placeholder="Enter Name of Agency" required>
                        </div>

                        <div class="form-group">
                            <label>Funding agency website link</label>
                            <input type="text" name="Funding_Agency_Website_Link" id="Funding_Agency_Website_Link"class="form-control" placeholder="Enter Link" required>
                        </div>

                        <div class="form-group">
                            <label>Select Govt./Non-Govt.</label>
                            <select name="Type_Govt_NonGovt" class="form-control" required>
                                <option value="">--Select Type of Publication--</option>
                                <option name="Type_Govt_NonGovt" id="Type_Govt_NonGovt"value="Government">Government</option>
                                <option name="Type_Govt_NonGovt" id="Type_Govt_NonGovt"value="Non-Government">Non-Government</option>
                            </select>
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
  

<!--Search data -->
<div id="srch" class="card-body">
                <h4> Search Data </h4>
                    <table class="table table-bordered ">
                    <thead>
                        <tr>
                        <th> ID </th>
                        <th> RESEARCH PROJECT / CONSULTANCY </th>
                        <th> NAME OF THE PROJECT/ENDOWNMENTS </th>
                        <th> NAME OF THE PRINCIPAL INVESTIGATOR/CO-INVESTIGATOR </th>
                        <th> DEPARTMENT OF PRINCIPAL INVESTIGATOR </th>
                        <th> YEAR OF AWARD </th>
                        <th> AMOUNT SANCTIONED </th>
                        <th> DURATION OF THE PROJECT </th>
						<th> NAME OF THE FUNDING AGENCY </th>
                        <th> FUNDING AGENCY WEBSITE LINK </th>
                        <th> TYPE(GOVT./NON-GOVT.) </th>
                        <th> UPLOAD THE RELEVANT DOCUMENT </th>
                        <th> STATUS </th>
                        </tr>
                    <thead>       
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `researchprojectconsultancies` WHERE Source='club' AND (id LIKE '%$str%' OR Type_Research_Project_Consultancy LIKE '%$str%' OR Name_Of_Project_Endownment LIKE '%$str%' OR Name_Of_Principal_Investigator_CoInvestigator LIKE '%$str%' OR Department_Of_Principal_Investigator LIKE '%$str%' OR Year_Of_Award LIKE '%$str%' OR Amount_Sanctioned LIKE '%$str%' OR Duration_Of_The_Project LIKE '%$str%' OR Name_Of_The_Funding_Agency LIKE '%$str%' OR Funding_Agency_Website_Link LIKE '%$str%' OR Type_Govt_NonGovt LIKE '%$str%' OR STATUS LIKE '%$str%')";
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
                        <td> <?php echo $row['Type_Research_Project_Consultancy']; ?> </td> 
                        <td> <?php echo $row['Name_Of_Project_Endownment']; ?> </td> 
                        <td> <?php echo $row['Name_Of_Principal_Investigator_CoInvestigator']; ?> </td>
                        <td> <?php echo $row['Department_Of_Principal_Investigator']; ?> </td>
                        <td> <?php echo $row['Year_Of_Award']; ?> </td>
                        <td> <?php echo $row['Amount_Sanctioned']; ?> </td>
                        <td> <?php echo $row['Duration_Of_The_Project']; ?> </td>
                        <td> <?php echo $row['Name_Of_The_Funding_Agency']; ?> </td>
                        <td> <?php echo $row['Funding_Agency_Website_Link']; ?> </td>
                        <td> <?php echo $row['Type_Govt_NonGovt']; ?> </td>
                        <td>

                            <a href="../../activity_coordinator/researchprojects-consultancies/uploadsindex1/<?php echo $row['pdffile1']; ?>" target = "_blank" class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                             <a class="edit btn-success editbtn" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <a class="delete btn-danger deletebtn" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                           
							
                            
                            
                            <!-- <button class="btn"><i class="fa fa-download"></i> Download</button> -->
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
                $('#Type_Research_Project_Consultancy').val(data[1]);
                $('#Name_Of_Project_Endownment').val(data[2]);
                $('#Name_Of_Principal_Investigator_CoInvestigator').val(data[3]);
                $('#Department_Of_Principal_Investigator').val(data[4]);
                $('#Year_Of_Award').val(data[5]);
                $('#Amount_Sanctioned').val(data[6]);
                $('#Duration_Of_The_Project').val(data[7]);
                $('#Name_Of_The_Funding_Agency').val(data[8]);
                $('#Funding_Agency_Website_Link').val(data[9]);
                $('#Type_Govt_NonGovt').val(data[10]);
                
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