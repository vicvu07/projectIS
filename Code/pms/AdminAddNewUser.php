<?php
// error_reporting(-1);
// ini_set('display_errors', 'On');

 session_start(); 
if(!isset($_SESSION['admin_id'])) // to check user is admn or not
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
            
            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                      <label >First Name</label>
                      <input class="form-control" type="text" placeholder="Enter First Name ..." name="fname" required=""/>
                    </div>
                    <div class="form-group">
                      <label >Last Name</label>
                      <input class="form-control" type="text" placeholder="Enter Last Name ..." name="lname"  required=""/>
                    </div>
                    <div class="form-group">
                      <label >Email Address</label>
                      <input class="form-control" type="email" placeholder="Enter Email Address..." name="email"  required=""/>
                    </div>
                    <div class="form-group">
                      <label >Password</label>
                      <input class="form-control" type="password" placeholder="Enter Password..." name="password"  required=""/>
                    </div>
                    <div class="form-group">
                      <label >Gender </label> <br>
                      <input type="radio" name="gender" value="male" checked > Male
                      <input type="radio" name="gender" value="female"> Female
                     
                    </div>
                    <div><label >Upload Profile Image</label></div>
                    <div >
                      <input type="file" name="profile" required="" />
                    </div> <br>

                    <input  type="submit" class="btn btn-primary" name="createuser" value="Add" />
                  
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

  if(isset($_POST["createuser"])) // on submit extact above orm details
  {
    $function = new Operation();
    $userFname=$_POST['fname'];
    $userLname=$_POST['lname'];
    $userEmail=$_POST['email'] ; 
    $userPassword=$_POST['password'];
    $userGender=$_POST['gender'];
    $userStatus = 1;
    $uploaddir = '../images/Profile_Images/';
    $uploadfile = $uploaddir . basename($_FILES['profile']['name'].time());

    error_reporting(E_ALL);
    echo "<p>";
    if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadfile)) // upload user image
    {

    }
    else {
     echo "Upload image failed";
   }

   echo "</p>";
  
   
   $result = $function->insert('user',array('user_fname','user_lname','user_email','user_password','user_image','user_status','user_gender'),array("'$userFname'", "'$userLname'","'$userEmail'","'$userPassword'","'$uploadfile'","'$userStatus'","'$userGender'"));
   // $result = $function->insert('user',array('user_fname','user_lname','user_email','user_password','user_image','user_status','user_gender'),array("'"$_POST['fname']"'", "'"$_POST['lname']"'","'"$_POST['email']"'","'"$_POST['password']"'","'$imagePath'","'"$_POST['userstatus']"'","'"$_POST['gender']"'"));
   
    if($result === TRUE)
    {?>

        <script>
          alert("Add Member Succesfully");
        </script>  
   <?php
    }
    else
    {
    
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