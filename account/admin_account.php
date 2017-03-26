<?php
session_start();
include_once("connection.php");
if (isset($_SESSION["username"]))
{
	$username=$_SESSION["username"];
	$sql="select * from user where username='".$username."'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
}
?>
	
<?php 

if(isset($_POST["addsecretquestion"])){
	$id=0;
	$question=$_POST["question"];
	$answerA=$_POST["answerA"];
	$answerB=$_POST["answerB"];
	$answerC=$_POST["answerC"];
	$answerD=$_POST["answerD"];
	$answer=$_POST["answer"];


	$sql="insert into tblsecretquestion (id,question,answerA,answerB,answerC,answerD,dummy_answer) values ('".$id."','".$question."','".$answerA."','".$answerB."','".$answerC."','".$answerD."','".$answer."')";
   $result=mysqli_query($conn,$sql);
   if ($result){
   	echo "<script>alert('Successfully Added Question');</script>";
   	echo "<script>window.location='adminform.php';</script>";
   }
   else{
   	   	echo "<script>alert('Failure');</script>";
   	echo "<script>window.location='adminform.php';</script>";

   }
}
?>
	<html>
		<head>
			<title>KiddieMDAS | admin_Account_Details</title>

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
							<img src="<?php echo $row["avatar"];?>" class="img-circle" alt="User Image" style="min-height: 50px; width: auto;">
						</div>		
								<div class="pull-left info"><p><?php if ($row["role"]== 2){echo "Teacher";}else{echo "Administrator";}?></p>
						</div>
						</div>
						<ul class="sidebar-menu">
							<li class="header">MAIN NAVIGATION</li>
							<li class="treeview">
								<a href="#"><i class="fa fa-graduation-cap"></i> <span>Teacher</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
									<li class="active"><a href="admin_addteacher.php"><i class="fa fa-circle-o"></i>Add Teacher</a></li>
									<li><a href="admin_TeacherDirectory.php"><i class="fa fa-circle-o"></i>View Teacher</a></li>
								</ul>
							<li>
						</ul>
						<ul class="sidebar-menu">
							<li class="treeview">
								<a href="#"><i class="fa fa-child"></i> <span>Pupil</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
								<li class="active"><a href="admin_pupilDirectory.php"><i class="fa fa-circle-o"></i>View Pupil</a></li>
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
						</ul>
						<ul class="sidebar-menu">
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
				
				<div class="content-wrapper">
					<section class="content-header">
						<h1>Dashboard<small>Control panel</small></h1>
						
						<ol class="breadcrumb"><li><a href="#"><i class="fa fa-home"></i> Home</a></li></ol>
					</section>
					
					<section class="content">
						<div class="row">
							<div class="col-lg-3 col-xs-6">
								<!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
							</div>
						</div>

					
			<h2>Account Info</h2>
				<div>
				<form method="POST" action="" enctype="multipart/form-data">
					<form class="form-horizontal" action='' method="POST">

						  <fieldset>
						    <div id="legend">
						      <legend class="">Register</legend>
						    </div>
						    <div class="form-group">
						     
						      <label class="control-label"  for="firstname">Firstname</label>
						      <div class="controls">
						        <input type="text" id="firstname" name="firstname" placeholder="" class="form-control" value="<?php echo $row["firstname"];?>">
						        
						      </div>
						    </div>
						 
						    <div class="form-group">
						   
						      <label class="control-label" for="lastname">Lastname</label>
						      <div class="controls">
						        <input type="text" id="lastname" name="lastname" placeholder="" class="form-control" value="<?php echo $row["lastname"];?>">
						        
						      </div>
						    </div>
						 
						    <div class="form-group">
						  
						      <label class="control-label" for="username">Username</label>
						      <div class="controls">
						        <input type="username" id="username" name="username" placeholder="" class="form-control" value="<?php echo $row["username"];?>">
						      
						      </div>
						    </div>
						 
						    <div class="form-group">
						     
						      <label class="control-label"  for="password">Password</label>
						      <div class="controls">
						        <input type="password" id="password" name="password" placeholder="" class="form-control" value="<?php echo $row["password"];?>">
						        
						      </div>
						    </div>

						    <div class="form-group">
						     
						      <label class="control-label"  for="email">Email Add</label>
						      <div class="controls">
						        <input type="email" id="email" name="email" placeholder="" class="form-control" value="<?php echo $row["emailaddress"];?>">
						        
						      </div>
						    </div>

						    <div class="form-group">
						     
						      <label class="control-label"  for="address">Address</label>
						      <div class="controls">
						        <input type="address" id="address" name="address" placeholder="" class="form-control" value="<?php echo $row["address"];?>">
						        
						      </div>
						    </div>

						    <div class="form-group">
						     
						      <label class="control-label"  for="contact">Contact</label>
						      <div class="controls">
						        <input type="contact" id="contact" name="contact" placeholder="" class="form-control" value="<?php echo $row["contact"];?>">
						        
						      </div>
						    </div>

						    <div class="form-group">
						     
						      <label class="control-label"  for="gender">Gender</label>
						      <div class="controls">
						        <input type="gender" id="gender" name="gender" placeholder="" class="form-control" value="<?php echo $row["gender"];?>">
						        
						      </div>
						    </div>
						  </fieldset>

					<br class="clear" />
		         <input type="file" name="updateimage" /><br>
		         <button type="submit" name="edit" value="Submit" class="btn btn-primary">Submit</button>
		    </form>
		</div>
		    <?php 
		    if (isset($_POST["edit"])){
		    	$firstname=$_POST["firstname"];
		    	$lastname=$_POST["lastname"];
		    	$user=$_POST["username"];
		    	$password=$_POST["password"];
		    	if (isset($_FILES['updateimage']['tmp_name']))
				{
		    	  $new_image_name = 'IMG' . uniqid() . '_' . date('Y-m-d') . '.jpg';
				  $Image="images/" .basename($new_image_name);
				  $imageFileType = pathinfo($Image,PATHINFO_EXTENSION);    
				  if (file_exists($Image)){
				    echo "<script>alert('Image exists.');</script>"; 
				     echo "<script>window.location='admin_account.php';</script>;";
				    } 
				else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				      && $imageFileType != "gif" ) {
				      echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>"; 
				   echo "<script>window.location='admin_account.php';</script>;";
				  }

				else{
		    	$sql="update user set firstname='".$firstname."', lastname='".$lastname."', username='".$user."', password='".$password."',avatar='".$Image."' where username='".$username."'";	
		    	$result=mysqli_query($conn,$sql);
		    	 move_uploaded_file($_FILES["updateimage"]["tmp_name"],"images/" . $new_image_name);
		    	 echo "<script>alert('successfully updated account');</script>";
		    	 echo "<script>window.location='admin_account.php';</script>";
		    }
}

		    }
		    ?>

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
				
<!-- modals xa add secret question-->
				<div class="modal fade" id="addsecretquestion" tabindex="-1" role="dialog" aria-labelledby="teacher's modal">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Secret Question</h4>
					  </div>
					  <div class="modal-body">
						<center>
							<form method="POST" action="">
								<label for="question">Question:</label><input  required type="text" name="question" style="width:300px; height:50px;" /><br/><br>
								<label for="AnswerA">Answer A:</label><input  required type="text" name="answerA" /><br/><br>
								<label for="AnswerB">Answer B:</label><input  required type="text" name="answerB" /><br/><br>
								<label for="AnswerC">Answer C:</label><input  required type="text" name="answerC" /><br/><br>
								<label for="AnswerD">Answer D:</label><input  required type="text" name="answerD" /><br/><br>
								<label for="answer"></label><select name="answer">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option></select><br/><br>
					
						</center>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input  type="submit" class="btn btn-primary" name="addsecretquestion" value="Add">
					</form>
					  </div>
					</div>
				  </div>
				</div>
				
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
			<!--<script type="text/javascript">

				$(window).load(function(){
					$('#firstname').val(window.localStorage.getItem("firstname"));
					$('#lastname').val(window.localStorage.getItem("lastname"));
					$('#username').val(window.localStorage.getItem("username"));
					$('#password').val(window.localStorage.getItem("password"));
					$('#imageForm').prop('action', '/arnil/fileupload.php?id=' + window.localStorage.getItem('id'));
					$('#avatar').attr('src', window.localStorage.getItem('avatar'));
				});


			</script>-->
			</div>
		
		</body>
	</html>