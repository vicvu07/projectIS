<?php
session_start(); 
   if(!isset($_SESSION['admin_id']))  // check admin or not
   {
    header("location:../Logout.php");    
}?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php 
	require '../Classes/init.php';
  $func = new Operation();
  $imagePath="";
  $myId=$_SESSION['admin_id'];
	?>

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include 'template/sidebar.html'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <?php include 'template/navbar.php'; ?>
      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Home Page</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
            <form class="user" action="#" method="post">
                    <div class="form-group">
                      <label >Project Title</label>
                      <input type="text" class="form-control" type="text" name="projectname" placeholder="Enter Project Name ..."  required="" ></input>
                    </div>
                    <div class="form-group">
                      <label >Project Details</label>
                      <textarea class="form-control" id="mytextarea" name ="projectdetails" rows="3" placeholder="Enter Project Details..."></textarea>
                    </div>
                    
                   
                        
                    <input  type="submit" class="btn btn-primary" name="submit" id="submit" value="ADD PROJECT" />
                  
                  </form>
            </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      
      <?php include 'template/footer.html'; ?>

      
    </div>
    
    
  <br>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  
  <!-- //main -->
	<?php
if(isset($_POST['submit'])) //on submit 
{  
   $function = new Operation();
   $projectName = $_POST['projectname']; // get above form details in variable
   $projectDescription = $_POST['projectdetails'];
   $projectStatus = 1;

   echo "$projectName";

    if ($_POST['projectname']==null || $_POST['projectdetails']==null ) // empty field submission check
    {
     echo '<span style="color:red"> First Enter Something<br></span>';
    } 
    
    else
    {
        $result = $func->insert('project',array('project_name','project_description','project_status'),array("'$projectName'","'$projectDescription'","'$projectStatus'"));

        if ($result === TRUE)  //insert form details in project table
        {
          ?>
          <script>
          
           alert("Add Project Succesfully");
           </script>  
          
         <?php
       }
       else
       {
         echo "not added";
       }
    }
  
}

?>
  

  

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  

</body>

</html>