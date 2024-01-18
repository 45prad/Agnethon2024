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
    <title> Student Paper Publication </title>

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
                <h2> Student Paper Publication</h2>
            </div>

            <?php 
if ($_SESSION["role"] == true) {
    echo '<form action="https://ims.fcrit.ac.in/superadmin/dashboard.php" method="post" style="position: absolute; top: 100px; right: 70px;">
            <button type="submit" class="btn btn-primary" style="background-color: blue; color: white;">HOME</button>
          </form>';
    
    echo '<div style="position: absolute; top: 100px; right: 200px; font-weight: bold; color: #007bff;">Welcome ' . $_SESSION["role"] . '<br><span style="color: #008000;">You logged in as SuperAdmin</span></div>';
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
                                <th scope="col"> Academic Year* </th>
                                <th scope="col"> Name of the student* </th>
                                <th scope="col"> Roll No.* </th>
                                <th scope="col"> Department* </th>
                                <th scope="col"> Year of Study* </th>
                                <th scope="col"> Title of the paper* </th>
                                <th scope="col"> Name of the conference/ Journal* </th>
                                <th scope="col"> National / International* </th>
								<th scope="col"> Year of Publication* </th>
                                <th scope="col"> ISBN/ISSN number * </th>
                                <th scope="col"> Name of the publisher* </th>
                                
                                <th scope="col"> Indexing * </th>
                                <th scope="col"> Other </th>
                                <th scope="col"> Paper Weblink/DOI </th>
                               
                                <th scope="col"> Action </th>
                                
                               
                            </tr>
                        </thead>
                        
                        <?php
                        $user = $_SESSION["role"];
                        
                        $result = "SELECT * FROM superadmin WHERE username = '$user'";

                        $query = mysqli_query($connection, $result);
                        $queryresult = mysqli_num_rows($query); 
                            if($queryresult > 0){
                                while($row = mysqli_fetch_assoc($query)){ 
                                    $id = $row['id'];
                                }  
                            }


                        $table_query = "SELECT * FROM paper_publication WHERE STATUS = 'approved' ORDER BY id ASC";
                        $query_run = mysqli_query($connection, $table_query);
                        $query_result = mysqli_num_rows($query_run); ?>

                        <?php if($query_result > 0){
                                        while($developer = mysqli_fetch_assoc($query_run)){   
                                            ?>
                        <tbody> <!-- change -->
                            <tr>
                                <td> <?php echo $developer['id']; ?> </td>
                                <td> <?php echo $developer['academic_year']; ?> </td> 
                                <td> <?php echo $developer['name_of_the_student']; ?> </td>
                                <td> <?php echo $developer['roll_number']; ?> </td>
                                <td> <?php echo $developer['Branch']; ?> </td>
                                <td> <?php echo $developer['year_of_study']; ?> </td>
                                <td> <?php echo $developer['title_of_the_paper']; ?> </td>
                                <td> <?php echo $developer['name_of_the_conference']; ?> </td>
                                <td> <?php echo $developer['national_or_international']; ?> </td>
								<td> <?php echo $developer['year_of_publication']; ?> </td>
                                <td> <?php echo $developer['ISBN_Or_ISSN_Number']; ?> </td>
                                <td> <?php echo $developer['name_of_publisher']; ?> </td>
                                <td> <?php echo $developer['indexing']; ?> </td>
                                <td> <?php echo $developer['other']; ?> </td>
                                <td><a href="<?php echo $developer['paper_link']; ?>" target="_blank"><?php echo $developer['paper_link']; ?></a></td>
                                <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($developer['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
                            <a href="../../student/paper_publication/IEEE_paper_format/<?php echo $developer['pdffile1']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<a href="../../student/paper_publication/certificate/<?php echo $developer['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <a href="../../student/paper_publication/conference_paper/<?php echo $developer['pdffile3']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>

                            
                            
                            <!-- <button class="btn"><i class="fa fa-download"></i> Download</button> -->
                        </td>
                                <!-- <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td> -->
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

  

<!--Search data -->
<div id="srch" class="card-body">
                <h4> Search Data </h4>
                    <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th> ID </th> 
                            <th> Academic Year* </th>
                                <th> Name of the student* </th>
                                <th> Roll No.* </th>
                                <th> Department* </th>
                                <th> Year of Study* </th>
                                <th> Title of the paper* </th>
                                <th> Name of the conference/ Journal* </th>
                                <th> National / International* </th>
								<th> Year of Publication* </th>
                                <th> ISBN/ISSN number * </th>
                                <th> Name of the publisher* </th>
                                <th> Indexing * </th>
                                <th> Other </th>
                                <th> Paper Weblink/DOI </th>
                                
                                <th> Action </th>
                               
                        </tr>
                    <thead>       
<?php 
    if (isset($_POST["submit"])) {
        $str = mysqli_real_escape_string($connection, $_POST["search"]);

        $sth = "SELECT * FROM `paper_publication` WHERE STATUS='approved' AND (academic_year LIKE '%$str%' OR name_of_the_student LIKE '%$str%' OR roll_number LIKE '%$str%' OR Branch LIKE '%$str%' OR  year_of_study LIKE '%$str%' OR title_of_the_paper LIKE '%$str%' OR name_of_the_conference LIKE '%$str%' OR year_of_publication LIKE '%$str%' OR ISBN_Or_ISSN_Number LIKE '%$str%' OR national_or_international LIKE '%$str%' OR indexing LIKE '%$str%' OR name_of_publisher LIKE '%$str%' OR paper_link LIKE '%$str%' OR other LIKE '%$str%')";
        
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
                        <td> <?php echo $row['academic_year']; ?> </td> 
                        <td> <?php echo $row['name_of_the_student']; ?> </td>
                        <td> <?php echo $row['roll_number']; ?> </td>
                        <td> <?php echo $row['Branch']; ?> </td>
                        <td> <?php echo $row['year_of_study']; ?> </td>
                        <td> <?php echo $row['title_of_the_paper']; ?> </td>
                        <td> <?php echo $row['name_of_the_conference']; ?> </td>
						<td> <?php echo $row['national_or_international']; ?> </td>
                        <td> <?php echo $row['year_of_publication']; ?> </td>
                        <td> <?php echo $row['ISBN_Or_ISSN_Number']; ?> </td>
                        <td> <?php echo $row['name_of_publisher']; ?> </td>
                        <td> <?php echo $row['indexing']; ?> </td>
                        <td> <?php echo $row['other']; ?> </td>
                        <td><a href="<?php echo $developer['paper_link']; ?>" target="_blank"><?php echo $row['paper_link']; ?></a></td>
                        <td>
                            <!--<a href="read.php?viewid=<?php echo htmlentities ($developer['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>-->
                            <a href="IEEE_paper_format/<?php echo $developer['pdffile1']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
							<a href="certificate/<?php echo $developer['pdffile2']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>
                            <a href="conference_paper/<?php echo $developer['pdffile3']; ?>"  class="download" title="Download" data-toggle="tooltip"><i class="fa fa-download"></i></a>

                            
                            
                            <!-- <button class="btn"><i class="fa fa-download"></i> Download</button> -->
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
                $('#academic_year').val(data[1]);
                $('#name_of_the_student').val(data[2]);
                $('#roll_number').val(data[3]);
                $('#Branch').val(data[4]);
                $('#year_of_study').val(data[5]);
                $('#title_of_the_paper').val(data[6]);
                $('#name_of_the_conference').val(data[7]);
				$('#national_or_international').val(data[8]);
                $('#year_of_publication').val(data[9]);
                $('#ISBN_Or_ISSN_Number').val(data[10]);
                $('#name_of_publisher').val(data[11]);
                $('#indexing').val(data[12]);
                $('#other').val(data[13]);
                $('#paper_link').val(data[14]);
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