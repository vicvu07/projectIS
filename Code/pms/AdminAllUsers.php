<?php session_start(); 
if(!isset($_SESSION['admin_id']))  // admin check
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

  <style>
    
    table tr td:first-child{ border-top-left-radius: 25px;
      border-bottom-left-radius: 5px;}
      table tr td:last-child{ border-top-right-radius: 5px;
        border-bottom-right-radius: 25px;}
        .body
        {
          background-color: #9ccef8;
        }
        div.field {

          width: 540px;
          height: 318px;
          overflow: auto;
        }

         .switch {
       position: relative;
       display: inline-block;
       width: 60px;
       height: 34px;
   }

   .switch input {
       opacity: 0;
       width: 0;
       height: 0;
   }

   .slider {
       position: absolute;
       cursor: pointer;
       top: 0;
       left: 0;
       right: 0;
       bottom: 0;
       background-color: red;
       -webkit-transition: .4s;
       transition: .4s;
   }

   .slider:before {
       position: absolute;
       content: "";
       height: 26px;
       width: 26px;
       left: 4px;
       bottom: 4px;
       background-color: white;
       -webkit-transition: .4s;
       transition: .4s;
   }

   input:checked + .slider {
       background-color: green;
   }

   input:focus + .slider {
       box-shadow: 0 0 1px #2196F3;
   }

   input:checked + .slider:before {
       -webkit-transform: translateX(26px);
       -ms-transform: translateX(26px);
       transform: translateX(26px);
   }

   /* Rounded sliders */
   .slider.round {
       border-radius: 36px;
   }

   .slider.round:before {
       border-radius: 50%;
   }
        
      </style>

</head>

<body id="page-top">
<?php 
  require '../Classes/init.php';
  $func = new Operation();
  $imagePath="";
    $myId=$_SESSION['admin_id']; // getting admin_id
    $result = $func->selectAll('user');// query will fetch all users
    ?>

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include 'template/sidebar.html'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <?php include 'template/navbar.php';?>
      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Members</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Members</th>
                      <th>Assign Task</th>
                      <th>Member's Status</th>
                      <th>Switch Status</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                if ($result->num_rows > 0) 
                { 
                  while($row = $result->fetch_assoc()) {   
                    ?>
                <tr align="left">
                <td><a href="AdminUserDetails.php?user_id=<?php echo $row["user_id"]; ?>">
                <img src="<?php echo $row["user_image"];?> " alt="No Profile" width="42" height="42" style=" border-radius: 50%;">
                <?php echo $row["user_fname"]." ".$row["user_lname"]; ?>
                </a></td>
             <td><a href="AdminTaskAssign.php?user_id=<?php echo $row["user_id"]; ?>" class="btn btn-outline-primary">ASSIGN TASK</a></td>
             <?php if($row["user_status"]==1)
             { ?>
           <td style="color: green;"><?php echo "✔" ;?></td>
            <?php }  else
            {
            ?>
              <td style="color: red;"><?php echo "✘" ;?></td>

            <?php } ?>
            <td >
              <label class="switch">
                <input type="checkbox" name="enabledisable" value="1" <?php echo ($row['user_status']=='1' ? 'checked' : ''); ?> onclick="activate_deactivate_user(this.checked ? 1 : 0,<?php echo $row['user_id'];?>)" >
                <span class="slider round"></span></label>
              </td>
          
          </tr>  
              <?php 
      
      } ?>   
            </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      
      <?php include 'template/footer.html'; ?>

      
    </div>
    
    <?php 
      
      
    }
    else
    {
      echo "<h2>no task so far</h2>";
    }
    ?>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    /*function to activate deactivate user*/
    function activate_deactivate_user(val,user_id){
      $.ajax({
        type:'post',
        url:'AdminActivateDeactivateUser.php',
        data:{val:val,user_id:user_id},
        success:function(result){
          $("#field").html(result);
          location.reload(true);
      }
    });
    }
    /* //function to activate deactivate user*/
  </script>
  

</body>

</html>