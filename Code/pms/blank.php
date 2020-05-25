<?php 
// error_reporting(-1);
// ini_set('display_errors', 'On');
session_start(); 
if(!isset($_SESSION['admin_id'])) // check admin or not
{
  session_destroy();
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
  // $sql = "SELECT * FROM admin WHERE admin_id = '".$myId."'";
   $result = $func->select_with_condition(array('*'),'admin',"admin_id = '".$myId."'");
   while($row = $result->fetch_assoc())
   {         
    $imagePath=$row["admin_image"];
    $fname=$row['admin_name'];
  }
  //$myId=$_SESSION['admin_id']; // getting my id from session
  //$sql = "SELECT * FROM task INNER JOIN user ON  task_receiver=user_id"; // query for user  
  $result1 = $func->select_with_join('*','task','user','INNER JOIN','task_receiver=user_id');   
  //require '../Classes/init.php';
  // $func = new Operation();
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
          <h1 class="h3 mb-2 text-gray-800">Coming Soon!</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
               <p class=" mb-2 text-gray-800">This feature will be updated as soon as posible.</p>
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