<?php session_start(); 
if(!isset($_SESSION['admin_id']))  // admin check
{
  session_destroy();
  header("location:../Logout.php");    
}?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body id="page-top">
<?php 
	require '../Classes/init.php';
  $func = new Operation();  
    $imagePath="";
    $myId=$_SESSION['admin_id'];
    $task_id=$_REQUEST['task_id'];

    $myId=$_SESSION['admin_id']; // getting admin_id
    $task_id=$_REQUEST['task_id'];  // getting task_id

    //$sql = "SELECT * FROM task WHERE task_id = '".$task_id."'"; // query will task details by task_id
    $result = $func->select_with_condition(array('*'),'task',"task_id = '".$task_id."'");
    while($row = $result->fetch_assoc())
    {
      $taskName=$row["task_name"]; // task details
      $taskIssueDate=$row["task_issuedate"];
      $taskDeadLine=$row["dead_line"];
      $taskDetails=$row["task_details"];
      $taskReceiver=$row["task_receiver"];
      
    }
    //$sql = "SELECT * FROM user WHERE user_id = '".$taskReceiver."'"; // query will fetch task receiver details by user_id
    $result = $func->select_with_condition(array('*'),'user',"user_id = '".$taskReceiver."'");
    while($row = $result->fetch_assoc())
    {
    $userImage=$row["user_image"];
    }

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
        <div class="container-fluid  ">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Task Update</h1>
          <!-- DataTales Example -->
          <div class="mb-5 row ">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="center col-3"></div>
            <div class="center col-6">
             <div class = "card">
              <div class = "card-body">
                <form method="POST">
                        <div class="form-group">
                          <label >Task Name</label>
                          <input class="form-control" type="text" name="taskName" value =" <?php echo $taskName; ?>" />
                        </div>

                        <?php 
          
                          $date1 = substr_replace($taskIssueDate,'T',11,0); // date conversion
                          $issueDate = preg_replace('/\s+/', '', $date1);
                          $date2 = substr_replace($taskDeadLine,'T',11,0);
                          $deadLine = preg_replace('/\s+/', '', $date2);

                        ?>
                        <div class="form-group">
                          <label >Task Issue Date</label>
                          <input class="form-control" type="datetime-local"  name="taskIssueDate" value="<?php  echo $issueDate; ?>" > 
                        </div>
                        <div class="form-group">
                          <label >Task Dealine</label>
                          <input class="form-control" type="datetime-local" name="taskDeadLine" value="<?php echo $deadLine; ?>" >
                        </div>
                        <div class="form-group">
                          <label >Task Details</label>
                          <textarea class="form-control" id="mytextarea" name ="taskDetails"  ><?php echo $taskDetails; ?></textarea>
                        </div>
                        <div>
                        <button class="btn btn-primary" type="submit" name="updateTask" >Update</button>
                        </div>
                        
                        
                  </form>
                 </div>
                </div>  
                
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
  if(isset($_POST['updateTask']))   // onset taskUpdate button 
  {
    // query will update task by task_id
  // $sql="UPDATE task set task_name='" . $_POST['taskName'] . "', task_issuedate='" . $_POST['taskIssueDate'] . "', dead_line='" . $_POST['taskDeadLine'] . "', task_details='".$_POST['task_details']."' WHERE task_id ='" . $task_id . "'";
    
    $result = $func->update('task',array("task_name='" . $_POST['taskName'] . "'", "task_issuedate='" . $_POST['taskIssueDate'] . "'", "dead_line='" . $_POST['taskDeadLine'] . "'", "task_details='".$_POST['taskDetails']."'"),"task_id ='" . $task_id . "'"); 

    if ($result === TRUE) 
    { 
      ?>

      <form id="myForm" action="AdminTaskDetails.php" method="post">
      <input type="hidden" name="task_id" id="task_id" value="<?php echo $task_id; ?>">
    </form>

    <?php
  }
  else
  {
    echo "Cannot update";
  }

  }

  if(isset($_POST['back']))
  {
  header("location:AdminTaskDetails.php");  
  }  

  ?>
  <script type="text/javascript">
    document.getElementById('myForm').submit();
  </script>
    
     


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