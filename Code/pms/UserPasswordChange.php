<?php
  session_start();  
    if(!isset($_SESSION['user_id']))
    {       
      header("location:../Logout.php");    
    }
  ?>

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
  $myId=$_SESSION['user_id'];
  $sql = "SELECT * FROM user WHERE user_id = '".$myId."'";
  $result = $func->select_with_condition(array('*'),'user',"user_id = '".$myId."'");
  while($row = $result->fetch_assoc())
  {
    $fname=$row["user_fname"];
    $lname=$row["user_lname"];
    $email=$row["user_email"];
    $password=$row["user_password"];         
    //$gender=$row["gender"];
    $image=$row["user_image"];
  }

  ?>     


  

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include 'template/sidebar2.html'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <?php include 'template/navbar2.php'; ?>
      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid  ">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Change User Password</h1>
          <!-- DataTales Example -->
          <div class="mb-5 row ">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="center col-3"></div>
            <div class="center col-6">
             <div class = "card">
              <div class = "card-body">           

                  <form  action="#" method="post">	
                    <div class="form-group text-center">
                        <img src="<?php echo "$image";?>" style ="border-radius:50%; " width="100" height="100"  >
                        <p><?php echo $fname." ".$lname ?></p>
                    </div>
                    <div  class= "form-group">
                        <input class="form-control" type="password" placeholder="Enter Current Password" name="currentpassword"  required>
                      </div> 

                      <div class= "form-group" >
                        <input class="form-control" type="password" placeholder="Enter New Password" name="password"  required>
                      </div>
                  
                      <div class= "form-group" >
                        <button class="btn btn-primary" type="submit" name="updatePassword">Update Password</button>
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
      
      <?php include 'template/footer2.html'; ?>

      
    </div>
    
    
  <br>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  
  <!-- //main -->

  <?php
if(isset($_POST['updatePassword']))
{
  
  //$sql="UPDATE user  set user_password ='" . $_POST['password'] . "'  WHERE user_id ='" . $myId . "'"; 
   if ($_POST['currentpassword'] == $password){
    $result = $func->update('user',array("user_password ='" . $_POST['password'] . "'"),"user_id ='" . $myId . "'"); 
   }
   else {
       echo "wrong current password!" ;
    }
   

  if ($result === TRUE) 
  {
    ?>
    <form id="myForm" action="UserPasswordChange.php" method="post">
      <input type="hidden" name="myId" id="myId" value="<?php echo $myId; ?>">
    </form>   
    <?php        
  }
  else
  {
   echo "Cannot update";
 }      
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