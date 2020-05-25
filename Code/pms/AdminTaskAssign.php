<?php session_start(); 
if(!isset($_SESSION['admin_id'])) //check admin
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

	$userId=$_REQUEST['user_id']; // getting user_id
  $myId=$_SESSION['admin_id'];  // getting admin_id

	
    $result = $func->select_with_condition(array('*'),'user',"user_id = '".$userId."'");//query will fetch user details by user_id
	while($row = $result->fetch_assoc())
	{       
		$image=$row["user_image"];
		$userFname=$row["user_fname"];
		$userLname=$row["user_lname"];
	}


	$result1 = $func->select_with_condition(array('*'),'admin',"admin_id = '".$myId."'"); // query will fetch admin details by admin_id
	while($row = $result1->fetch_assoc())
	{       
		$myName=$row["admin_name"];
		$myProfile=$row["admin_image"];
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
                      <label >Task Title</label>
                      <input type="text" class="form-control" type="text" name="task_name" required="" placeholder="Enter Task Title..."></input>
                    </div>
                    <div class="form-group">
                      <label >Task Details</label>
                      <textarea class="form-control" id="mytextarea" name ="task_details" rows="3" placeholder="Enter Task's Details..."></textarea>
                    </div>
                    <div class="form-group">
                      <label >Task Deadline</label>
                      <input class="form-control" type="datetime-local" id="exampleFormControlTextarea1" name="deadline" required=""></input>
                    </div>
                    <div >
                      <label >Task Project</label><br>
                      <select class="form-control" name="projects" > <br>
							        <?php 
							        	 //will give all projects in select 
							        	$result = $func->selectAll('project');    //box(drop down)
							          	while($row = $result->fetch_assoc())
							        	{       
								        	echo "<option value=".$row['project_id'].">".$row['project_name']."</option>";
								        }
                      ?>
                      

							</select>
						</div>	
                   
                    <br>      
                    <input  type="submit" class="btn btn-primary" name="assign" value="Assign" />
                  
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

    if(isset($_POST['assign'])) // onset assign button 
    {
      $taskName=$_POST['task_name'];  // getting following details from the form
      $taskDetail=$_POST['task_details'];
      $taskDeadLine=$_POST['deadline'] ; 
      $taskProject=$_POST['projects'];
      
      // $sql = "INSERT INTO task (task_name,task_details,task_project,dead_line,task_receiver,task_sender,task_sender_name,task_sender_image)
      // VALUES ('$taskName', '$taskDetail','$taskProject','$taskDeadLine','$userId','$myId','$myName','$myProfile')";
        
          $result = $func->insert('task',array('task_name','task_details','task_project','dead_line','task_receiver','task_sender','task_sender_name','task_sender_image'),array("'$taskName'", "'$taskDetail'","'$taskProject'","'$taskDeadLine'","'$userId'","'$myId'","'$myName'","'$myProfile'"));

        // insert above fetched details into task 
      if ($result === TRUE) 
      {
         
        echo '<meta http-equiv=Refresh content="0;url=AdminHome.php?reload=1">';       
      }
      else
      {
        echo "Cannot update";
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