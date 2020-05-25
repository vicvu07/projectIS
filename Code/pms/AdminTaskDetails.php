<?php session_start(); 
if(!isset($_SESSION['admin_id'])) // admin check
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

  <script type="text/javascript">
/* function to save comments in the DB */
      function subm(){        
        var comment=$("#comment").val();
        var task_id=$("#task_id").val();
        var mineId=$("#mineId").val();
        var recId=$("#recId").val();
        var myName=$("#myName").val();
        var myImage=$("#myImage").val();      

        //Get Current Time in Javascript
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var currentTime = date+' '+time;
        //var currentTime = "2020-06-03 10:37:47";
      
        jQuery.ajax({
          url: "AdminCommentSave.php",
          data:{comment:comment,task_id:task_id,mineId:mineId,recId:recId,myName:myName,myImage:myImage,currentTime:currentTime}, 
          type: "POST",
          dataType:('html'),
          success:function(data){
            $("#").html(data);
          },
          error:function (){}
        });    
      };
/* //function to save comments in the DB */
  </script>
</head>

<body id="page-top">
<?php 
	require '../Classes/init.php';
  $func = new Operation();  
  $imagePath="";
  $myId=$_SESSION['admin_id'];
  $task_id=$_REQUEST['task_id'];

  //$sql = "SELECT * FROM task WHERE task_id = '".$task_id."'";  
  $result = $func->select_with_condition(array('*'),'task',"task_id = '".$task_id."'");//query for extracting task data

  while($row = $result->fetch_assoc())
  {
    $taskName=$row["task_name"];
    $taskIssueDate=$row["task_issuedate"];
    $taskDeadLine=$row["dead_line"];
    $taskDetails=$row["task_details"];
    $taskReceiver=$row["task_receiver"];
    $taskDisplay=$row["task_display"];
    $taskProject=$row["task_project"];
    $taskStatus=$row["task_status"];
    
  }

 // $sql1 ="SELECT * FROM user WHERE user_id = '".$taskReceiver."'";
  $result1 = $func->select_with_condition(array('*'),'user',"user_id = '".$taskReceiver."'"); // query for task receiver's info
  while($row = $result1->fetch_assoc())
  {
    $userImage=$row["user_image"];
    $userFname=$row["user_fname"];
    $userLname=$row["user_lname"];        
  }

  //$sql2 = "SELECT * FROM admin WHERE admin_id = '".$myId."'"; // query for task sender info
  $result2 = $func->select_with_condition(array('*'),'admin',"admin_id = '".$myId."'");
  while($row = $result2->fetch_assoc())
  {
    $myName=$row["admin_name"];
    $myImage=$row["admin_image"];
  } 

 // $sql3 = "SELECT * FROM project WHERE project_id = '".$taskProject."'"; // query for project info
  $result3 = $func->select_with_condition(array('*'),'project',"project_id = '".$taskProject."'");
  while($row = $result3->fetch_assoc())
  {
    $projectName=$row["project_name"];
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
          <h1 class="h3 mb-2 text-gray-800">Task Details</h1>
          <!-- DataTales Example -->
          <div class="mb-5 row ">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            
            <div class="col-5">
             <div class = "card">
              <div class = "card-body">
                <div id="countdown" style="color: gray; float: right;"></div><br>
                <form method="GET">
                        <div class="form-group">
                          <label >Task Name</label>
                          <input class="form-control" type="text" name="taskname" value =" <?php echo $taskName; ?>" readonly/>
                        </div>
                        <div class="form-group">
                          <label >Task Issue Date</label>
                          <input class="form-control" type="text"  name="taskissuedate" value="<?php echo $taskIssueDate; ?>" readonly />
                        </div>
                        <div class="form-group">
                          <label >Task Dealine</label>
                          <input class="form-control" type="text"  name="taskdealine" id="taskdeadline" value="<?php echo $taskDeadLine; ?>" readonly />
                        </div>
                        <div class="form-group">
                          <label >Task Details</label>
                          <textarea class="form-control" id="mytextarea" name ="taskdetails"  readonly><?php echo $taskDetails; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label >Task Receiver</label>
                          <input class="form-control" type="text" name="taskreceiver" value =" <?php echo "$userFname"." "."$userLname"; ?>" readonly/>
                        </div>
                        <div class="form-group">
                          <label >Project Name</label>
                          <input class="form-control" type="text" name="projectname" value =" <?php echo $projectName; ?>" readonly/>
                        </div>
                        <div class="form-group">
                          <label >Task Status</label>
                          <input class="form-control" type="text" name="taskstatus" value =" <?php echo $taskStatus; ?>" readonly/>
                        </div>

                        
                      

                        
                        <p id="currenttime"></p>
                        <div>
                         <a class="btn btn-primary" href="AdminTaskUpdate.php?task_id=<?php echo $task_id; ?>" role="button">Update</a>

                        </div>
                        
                        
                  </form>
                 </div>
                </div>  
                
            </div>

            <div class="col-7">
              <div class ="card">
              <div class="card-body">
                <div class="panel panel-default" style="height: 613px;">
                  <div style="height:10px;"></div>
                  <span style="margin-left:10px;">Chat Box</span><br>
                  <span style="font-size:10px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech to avoid banning of account</i></span>
                  <div style="height:10px;"></div>
                  <div id="load_comments" style="margin-left:10px; max-height:320px; overflow-y:scroll;"></div>
                </div> 
                <div class="input-group">
                <form method="POST" name="f1" id="f1">
                    <input type="text" id="comment" class="form-control" placeholder="Type message..." name ="comment"></input>
                    <input type="number" name="task_id" id="task_id" value=<?php echo "$task_id";?> hidden > 
                    <input type="number" name="mineId" id="mineId" value=<?php echo "$myId";?> hidden>
                    <input type="number" name="recId" id="recId" value=<?php echo "$taskReceiver";?> hidden>
                    <input type="hidden" name="myName" id="myName" value=<?php echo "$myName";?> >
                    <input type="text" name="myImage" id="myImage" value=<?php echo "$myImage";?> hidden>
                    <input type="button" class="btn" name="submit" id="submit" value="SUBMIT" onclick="subm();">
                  </form>

                </div>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>

        /* function to refresh comment display area in every 2 sec */
        var auto_refresh = setInterval(
          function ()
          {
            $('#load_comments').load('AdminCommentCount.php?task_id=<?php echo $task_id; ?>').fadeIn("slow");
            scrollBac();
          }, 1000); // refresh  in every 1 seconds

        /*function to show or hide task */
        function show_hide_task(val,task_id) {
          $.ajax({
            type:'post',
            url:'AdminShowHideTask.php',
            data:{val:val,task_id:task_id},
            success:function(result){
              if(result==1)
              {
                $('#str'+task_id).html('Show');
              }
              else
              {
                $('#str'+task_id).html('Hide');
              }
            }
          });
        }
        /* function to delete comment*/
        function delete_comment(comment_id) {    
        if(confirm('Are you sure to remove this comment ?'))
        {
          $.ajax({
            type:'post',
            url:'AdminDeleteComment.php',
            data:{comment_id:comment_id},
            success:function(result){
              if(result==1)
              {
                $('#str'+comment_id).html('Show');
              }
              else
              {
                $('#str'+comment_id).html('Hide');
              }
            }
          });
         }
        }

        /*--//function to delete comments--*/

        /*function to show/hide comments*/
        function hide_show_comments(val,comment_id) {
          $.ajax({
            type:'post',
            url:'AdminShowHideComments.php',
            data:{val:val,comment_id:comment_id},
            success:function(result){

            }
          });
        }
        /*--//function to show/hide comments--*/

        /*function to sroll back at last position*/
        var scrolled = false;
        function scrollBac(){
          if(!scrolled){
           var element = document.getElementById("load_comments");
           element.scrollTop = element.scrollHeight;
         }
       }

       $("#load_comments").on('scroll', function(){
         scrolled=true;
       });
       /* */

       /*clock --> will show time remaining to deadline*/
    var deadLine=$("#taskdeadline").val();
    var end = new Date(deadLine);
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').style = "color: white; background-color:red; float:right";
            document.getElementById('countdown').innerHTML = 'EXPIRED!';
            

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);
        document.getElementById('countdown').style = "color: blue; float:right";
        document.getElementById('countdown').innerHTML = 'Expiring in ';
        document.getElementById('countdown').innerHTML += days + 'days ';
        document.getElementById('countdown').innerHTML += hours + 'hrs ';
        document.getElementById('countdown').innerHTML += minutes + 'mins ';
        document.getElementById('countdown').innerHTML += seconds + 'secs';
    }

    timer = setInterval(showRemaining, 1000);
       /*clock*/
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