<?php
session_start();
include_once("connection.php");
{
	$username=$_SESSION["username"];
	$sql="select * from user where username='".$username."'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
		
}

	function updateSubject($conn, $subject, $sectionid){

		$sql="update tblsection set sectionname ='$subject' where section_id ='$sectionid'";
		
		return $conn->query($sql);
	
	}



	if(isset($_POST['section_id'])){
		$result = updateSubject($conn,$_POST['subject'], $_POST['section_id']);
		
		if($result === TRUE){
			echo '{"status": "success"}:::';
		}else{
			echo '{"status": "error"}:::';
		}
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
			<title>KiddieMDAS | admin_teacher_Directory</title>

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
						<ol class="breadcrumb"><li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Dashboard</li></ol>
					</section>
					
					<section class="content">
						<div class="row">
							<div class="col-lg-3 col-xs-6">
								<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
							</div>
						</div>
						<center>
<h2>View Sections</h2><br><br>
<div>
	<table class="table">
		<tr>
			<th>Section</th>
			<th>Update</th>
		</tr>
		<?php 
		include_once("connection.php");
		$sql="select * from tblsection";
		$result=$conn->query($sql);
			if($result->num_rows > 0){
				while ($r=mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>" .$r['sectionname'] ." </td>";
					echo "<td><a class=\"btn btn-primary\" data-toggle=\"modal\"  data-target=\"#sectionModal\" onclick=\"sectionToModal('".$r['section_id']."',
						'" . $r['sectionname'] . "', true)\">Update</a></td>";
					echo "</tr>";
				}
				mysqli_close($conn);
}
			
			/*for($i = 0; $i < 10; $i++){
				echo "<tr>";
				echo "<td>teacher $i</td>";
				echo "<td>section $i</td>";
				echo "<td><a class=\"btn btn-primary\">View</a> <a class=\"btn btn-primary\">Update</a> <a class=\"btn btn-primary\">Delete</a></td>";
				echo "</tr>";
			}*/
		?>
		<!--<tr>  
			<td>teacher 1</td> 
			<td>section 1</td>
			<td><a class="btn btn-primary">Update</a><a class="btn btn-primary">Delete</a></td>
		</tr> -->
	</table>
</div>
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
						<b>Version</b> 2.3.0
					</div>
						<strong>Copyright &copy; 2014-2015 <a href="">Almsaeed asdasdStudio</a>.</strong> All rights reserved.
				</footer>
				
				<aside class="control-sidebar control-sidebar-dark">
					<ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
				<div class="tab-content">
					<div class="tab-pane" id="control-sidebar-home-tab"></div>
				</div>
				</aside>
				
				<!-- view modals -->
				<div class="modal fade" id="sectionModal" tabindex="-1" role="dialog"  aria-labelledby="teacher's modal">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"></h4>
					  </div>
					  <div class="modal-body">
					  	<center>
					  			<form method="POST" action="">
								<span  id="section_id" name="section_id" class="hidden"></span>
								<label for="subject">Subject:</label><input id="subject" required type="text" name="subject"/><br/><br>
							</form>
						</center>

					  </div>
					  <div class="modal-footer">
						<button id="buttonId" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					    <button id="buttonId1" type="button" class="btn btn-primary" onclick="updateSubject()">Update</button>

					  </div>
					</div>
				  </div>
				  </div>
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
			
			 

			<script>
			function deleteModal(id){
			$("#updateteacher").click(function(e){
				window.location="admin_updateteacherstatus.php?tID=" + id;
			});
		}

			</script>
				 	<script>

			function sectionToModal(section_id,subject, isupdate){
					if (isupdate) {

						$('#subject').val(subject).prop('readonly',false);
						$('#section_id').text(section_id);
						$('#buttonId').show();
						$('#buttonId1').show();
						$('#statusID').show();
					}else{

						$('#subject').val(subject).prop('readonly',true);
						$('#section_id').text(id);					
						$('#buttonId1').hide();
						$('#statusID').hide();
					}
				}


				
				function updateSubject(){
					$.post(
						'viewsection.php', 
						{subject: $('#subject').val(), section_id: $('#section_id').text()},
						function(data){
							//console.log('data', data);
							var temp = data.split(':::')[0];
							var truData = JSON.parse(temp);
							if(truData.status == 'success'){
								alert("Successfully Updated Section");
								window.location="viewsection.php";
					

							}else{
								alert("update fail");
								console.log('update fail', truData);
							}
							
						}
					);
				}

			/*	function deleteTeacher(teacher_id){
				$.post(
						'TeacherDirectory.php', 
						{teacherid: $('#teacher_id')},
						function(data){
							var temp = data.split(':::')[0];
							var truData = JSON.parse(temp);
							
							if(truData.status == 'success'){
								console.log('delete success', truData);
							}else{
								console.log('delete error', truData);
							}
						}
					);
					
				}*/

			</script>




			</div>
		
		</body>
	</html>