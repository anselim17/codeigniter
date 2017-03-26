<?php
session_start();
include_once("connection.php");
if (isset($_SESSION["username"]))
{
	$username=$_SESSION["username"];
	$sql="select * from user where username='".$username."'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
		
}

// if(isset($_GET['alert'])){
// 	$message = $_GET['alert'];
// 	echo "<script>alert('$messsage');</script>";
// }

if (isset($_POST["register"]))
{
$username=$_POST["username"];
// $pword=$_POST["password"];
$pword = randomPassword();
$sectioname=$_POST["sectioname"];
$status="active";
$role=2;
  $sql2="select section_id from tblsection where sectionname='$sectioname'";
  $result=mysqli_query($conn,$sql2);
  $row=mysqli_fetch_assoc($result);
  $sectionid=$row["section_id"];

$sql="insert into user (section_id,username,password,role,Status) values ('$sectionid','$username','$pword','$role','$status')";
$result=mysqli_query($conn,$sql);
if ($result==true)
{
echo '<script>alert("Successfully Added!\nUsername: '. $username . '\nPassword: ' . $pword . '");</script>';
echo "<script>window.location='admin_addteacher.php';</script>";
}
else
{
echo "<script>alert('failed to registered');</script>";
echo "<script>window.location='admin_addteacher.php';</script>";
}
mysqli_close($conn);
// unset($conn);
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>
	
	<html>
		<head>
			<title>KiddieMDAS | admin_addteacher</title>

			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
			<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
			<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		</head>
		<body class="hold-transition skin-blue sidebar-mini">
			<div class="wrapper">
				<header class="main-header">
					<a href="adminform.php" class="logo"><span class="logo-lg"><b>KiddieMDAS</b></span></a>
					<nav class="navbar navbar-static-top" role="navigation">
						<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
								      <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Manage Account</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="admin_account.php" class="btn btn-default btn-flat">Account Settings</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>	
								<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
							</ul>
						</div>
					</nav>
				</header>
				
				<aside class="main-sidebar">
					<section class="sidebar">
						<div class="user-panel">
							<div class="pull-left image">
								<img id="avatar" src="<?php echo $row['avatar'] ?>"  class="img-circle" alt="User Image" style="min-height: 50px; width: auto;">
							</div>
							<div class="pull-left info"><p>Administrator</p>
						</div>
						</div>
						<ul class="sidebar-menu">
							<li class="header">MAIN NAVIGATION</li>
							<li class="treeview">
								<a href="#"><i class="fa fa-graduation-cap"></i> <span>Teacher</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
									<li class="active"><a href="admin_addteacher.php"><i class="fa fa-circle-o"></i>Add Teacher</a></li>
									<li><a href="admin_TeacherDirectory.php"><i class="fa fa-circle-o"></i>Teacher`s Directory</a></li>
								</ul>
							<li>
						</ul>
						<ul class="sidebar-menu">
							<li class="treeview">
								<a href="#"><i class="fa fa-child"></i> <span>Pupil</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
								<li class="active"><a href="admin_pupilDirectory.php"><i class="fa fa-circle-o"></i>Pupil's Directory</a></li>
								</ul>
							<li>
						</ul>
						<ul class="sidebar-menu">
							<li class="treeview">
								<a href="#"><i class="fa fa-child"></i> <span>Section</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
								<li><a href="#" data-toggle="modal" data-target="#addsection"><i class="fa fa-circle-o"></i>Add Section</a></li>
								<li><a href="admin_viewsection.php" ><i class="fa fa-circle-o"></i>View Section</a></li>
	
								</ul>
							<li>
						</ul><ul class="sidebar-menu">
							<li class="treeview">
								<a href="#"><i class="fa fa-child"></i> <span>Report</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
								<li><a href="#" data-toggle="modal" data-target="#"><i class="fa fa-circle-o"></i>View Pupil score per Quarter </a></li>
								<li><a href="#" data-toggle="modal" data-target="#"><i class="fa fa-circle-o"></i>Top Score</a></li>
								</ul>
							<li>
						</ul>
					</section>
				</aside>

							<!-- modals -->
				<div class="modal fade" id="addsection" tabindex="-1" role="dialog" aria-labelledby="section's modal">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					  </div>
					  <div class="modal-body">
						<center>
							<form method="POST" action="">
								<span id="section" class="hidden"></span>
								<label for="section">Section:</label><input  required type="text" name="section" /><br/><br>
								<!--<br/><br>
								<br class="clear" />
								<input type="submit" name="register" value="Submit" />
								<input type="button" name="cancel" class="floatright" value="Cancel" /><br class="clear"/> -->
		
						</center>
					  </div>
					  <div class="modal-footer">
						<button id="buttonId" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" name="addsection" class="btn btn-primary" value="Add" >
					</form>
					  </div>
					</div>
				  </div>
				</div>
				<?php
				if (isset($_POST["addsection"])){
					$sectionname=$_POST["section"];
					$sql="insert into tblsection (sectionname) values ('".$sectionname."')";
					$result=mysqli_query($conn,$sql);
					echo "<script>alert('successfully added section');</script>";
					echo "<script>window.location='adminform.php';</script>";
					mysqli_close($conn);
				}
				?>

				
				<div class="content-wrapper">
					<section class="content-header">
						<h1>Dashboard<small>Control panel</small></h1>
						<ol class="breadcrumb"><li><a href="#"><i class="fa fa-home"></i> Home</a></li></ol>
					</section>
					
					<section class="content">
						<div class="row">
							<div class="col-lg-3 col-xs-6">
							<!--	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
							</div>
						</div>
					<center>
	<h2>Registration for Teacher</h2><br><br>
<form method="POST" action="">
<label for="mobile">Username:</label><input required type="text" name="username" /><br/><br>
<!-- <label for="home">Password: </label><input  type="password" name="password" /><br/><br> -->
<label for="home">Section: </label>
<?php
include_once("connection.php");
    $sqli = "SELECT * from tblsection";
   $resulti = mysqli_query($conn,$sqli) or die(mysqli_error($conn));
    echo '<select name="sectioname" style="width:125px;" required>';
        while ($r = mysqli_fetch_array($resulti)) {
     echo "<option value='".$r['sectionname']."'>".$r['sectionname']."</option>";
     mysqli_close($conn);
      }
  ?>
</select>
</br>
<br class="clear" />
<input type="submit" name="register" value="Submit" />
<input type="button" name="cancel" class="floatright" value="Cancel" /><br class="clear"/>
</form>

						<div class="col-lg-3 col-xs-6">
							<div class="col-lg-3 col-xs-6"></div>
						</div>
						<div class="row">
							<section class="col-lg-7 connectedSortable"></section>
							<section class="col-lg-5 connectedSortable"></section>
						</div>
					</section>
				</div>
				
				<footer class="main-footer">
					<div class="pull-right hidden-xs">
						<b>Version</b> 1.0
					</div>
						<strong>Copyright &copy; 2015-2016 <a href="">google.com</a>.</strong> All rights reserved.
				</footer>
				
				<aside class="control-sidebar control-sidebar-dark">
					<ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
				<div class="tab-content">
					<div class="tab-pane" id="control-sidebar-home-tab"></div>
				</div>
				</aside>
				
				<!-- modals -->
				<div class="modal fade" id="teacherModal" tabindex="-1" role="dialog" aria-labelledby="teacher's modal">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					  </div>
					  <div class="modal-body">
						<center>
							<form method="POST" action="">
								<span id="teacher_id" class="hidden"></span>
								<label for="firstname">Firstname:</label><input id="firstname" required type="text" name="firstname" /><br/><br>
								<label for="surname">Lastname:</label><input id="lastname" required type="text" name="lastname" /><br/><br>
								<label for="mobile">Username:</label><input id="username" required type="text" name="username" /><br/><br>
								<label for="home">Password: </label><input id="password" required type="password" name="password" /><br/><br>
								<!--<br/><br>
								<br class="clear" />
								<input type="submit" name="register" value="Submit" />
								<input type="button" name="cancel" class="floatright" value="Cancel" /><br class="clear"/> -->
							</form>
						</center>
					  </div>
					  <div class="modal-footer">
						<button id="buttonId" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="buttonId1" type="button" class="btn btn-primary" onclick="updateTeacher()">Update</button>
					  </div>
					</div>
				  </div>
				</div>
			<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
			<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
			<script>
			  $.widget.bridge('uibutton', $.ui.button);
			</script>
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<script src="plugins/morris/morris.min.js"></script>
			<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
			<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
			<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
			<script src="plugins/knob/jquery.knob.js"></script>
			<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
			<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
			<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
			<script src="plugins/fastclick/fastclick.min.js"></script>
			<script src="dist/js/app.min.js"></script>
			<script src="dist/js/pages/dashboard.js"></script>
			<script src="dist/js/demo.js"></script>	
			<script type="text/javascript">
			   //  $(window).load(function(){
			   //   $('#avatar').attr('src', window.localStorage.getItem('avatar'));
			   //  });
			   // </script> 	
			</div>
		
		</body>
	</html>