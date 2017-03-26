	<?php
	session_start();
	include_once("connection.php");
	{
		$username=$_SESSION["username"];
		$sql="select * from user where username='".$username."'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
			
	}
		function getTeacher($conn, $isAll = false, $teacherName){
			$sql = "";
			
			if($isAll){
			$sql = "SELECT user.id,tblsection.sectionname,user.firstname,user.lastname,user.password,user.username,user.Status,user.emailaddress,user.role, user.address,user.contact,user.gender from user inner join tblsection on user.section_id=tblsection.section_id  WHERE user.role = 2";
			}else{
			$sql =  "SELECT user.id,tblsection.sectionname,user.firstname,user.lastname,user.password,user.username,user.Status,user.emailaddress,user.role, user.address,user.contact,user.gender from user inner join tblsection on user.section_id=tblsection.section_id  WHERE user.firstname LIKE '%$teacherName%' OR user.lastname LIKE '%$teacherName%' AND user.role = 2";
			}
			
			$result = $conn->query($sql);

			
			return $result;
		}
		function updateTeacher($conn, $firstname, $lastname, $username, $password, $emailaddress,$address,$contact,$gender, $id){


			$sql="update user set firstname ='$firstname', lastname = '$lastname', username = '$username', password = '$password', emailaddress='$emailaddress', address='$address', contact='$contact', gender='$gender' where id = $id";
			
			return $conn->query($sql);
		
		}



		if(isset($_POST['id'])){
			$result = updateTeacher($conn, $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'],  $_POST['emailaddress'], $_POST['address'], $_POST['contact'], $_POST['gender'], $_POST['id']);
			
			if($result === TRUE){
				echo '{"status": "success"}:::';
			}else{
				echo '{"status": "error"}:::';
			}

		}
		else if(isset($_GET['teacher'])){
			$teacher = $_GET['teacher'];
			
			$result = getTeacher($conn, false, $teacher);
		}
			else{
			$result = getTeacher($conn, true, null);
		}



		
		
		mysqli_close($conn);
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
	<h2>Teacher's Directory</h2><br><br>
	<form method="GET" action="admin_TeacherDirectory.php">
		<div class="input-group">
	      <input type="text" name="teacher" class="form-control" placeholder="Search Teacher...">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit">Go!</button>
	      </span>
	    </div>
	</form>
	<div>
		<table class="table">
			<tr>
				<th>name</th>
				<th>section</th>
				<th>actions</th>
			</tr>
			<?php 
			
				if($result->num_rows > 0){
					while ($r=mysqli_fetch_array($result)){
						if($r["role"]==2){
						echo "<tr>";
						echo "<td>" . $r['firstname'] . " " . $r['lastname'] . "</td>";
						echo "<td>".$r['sectionname']."</td>";
						echo "<td><a class='btn btn-primary viewdetail ' data-toggle='modal' data-target='#teacherModal' onclick=\"populateToModal('" . $r['firstname'] . "','" . $r['lastname'] . "','" . $r['username'] . "','" . $r['password'] . "','" . $r['emailaddress'] . "','" . $r['address'] . "','" . $r['contact'] . "',
							       '" . $r['gender'] . "','".$r['sectionname']."','" . $r['id'] . "', false)\">View Info</a>
						 <a class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#teacherModal\" onclick=\"populateToModal('" . $r['firstname'] . "','" . $r['lastname'] . "','" . $r['username'] . "','" . $r['password'] . "','" . $r['emailaddress'] . "','" . $r['address'] . "','" . $r['contact'] . "',
							       '" . $r['gender'] . "','".$r['sectionname']."','" . $r['id'] . "', true)\">Update Info</a>";
						if ($r['Status']=='Activate') {
							echo " <a class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#updateteacherstatus\" onclick=\"deleteModal('" . $r['id'] ."')\">Deactivate</a></td>";
						} else {
							echo " <a class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#updateteacherstatus\" onclick=\"deleteModal('" . $r['id'] ."')\">Activate</a></td>";
						}
						$_SESSION["id"]=$row["id"];
						echo "</tr>";
					}
				}
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
					<div class="modal fade" id="teacherModal" tabindex="-1" role="dialog"  aria-labelledby="teacher's modal">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						  </div>
						  <div class="modal-body">
						  	<center>
						  			<form method="POST" action="">
									<span  id="teacher_id" name="id" class="hidden"></span>
									<label for="firstname">Firstname:</label><input id="firstname" required type="text" name="firstname" /><br/><br>
									<label for="lastname">Lastname:</label><input id="lastname" required type="text" name="lastname" /><br/><br>
									<label for="username">Username:</label><input id="username" required type="text" name="username" /><br/><br>
									<label for="password">Password: </label><input id="password" required type="password" name="password" /><br/><br>
									<label for="email">Email Add:</label><input id="emailaddress" required type="text" name="email" /><br/><br>
									<label for="address">Address:</label><input id="address"  required type="text" name="address" /><br/><br>
									<label for="contact">Contact: </label><input id="contact"  required type="text" name="contact" /><br/><br>
									<label for="gender">Gender: </label><input id="gender"  required type="text" name="gender" /><br/><br>
									<label for="section">Section: </label><input id="sectionname"  required type="text" name="sectionname" /><br/><br>
								    <a  href="#"id="statusID"data-toggle="modal" data-target="#updateteachersection">Change Status</a>
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

						<!-- update section modals -->
					<div class="modal fade" id="updateteachersection" tabindex="-1" role="dialog"  aria-labelledby="teacher's modal">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						  </div>
						  <div class="modal-body">
						  	<center>
					  			<form method="POST" action="">
									<span  id="teacherid" name="teacherid" class="hidden"></span>
									<label for="sectionname">Section:</label>
									<?php 
									include('connection.php');
									$sqli = "SELECT * from tblsection";
									 $resulti = mysqli_query($conn,$sqli) or die(mysqli_error($conn));
									 echo '<select id="section_name" name="sectionname" style="width:125px;" required>';
								     while ($r = mysqli_fetch_array($resulti)) {
									echo "<option value='".$r['sectionname']."'>".$r['sectionname']."</option>";
								   mysqli_close($conn);
								 }
								?>
							</select><br/><br>
							</form>
							</form>
							</center>

						  </div>
						  <div class="modal-footer">
							<button id="buttonId" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						    <button id="buttonId1" type="button" class="btn btn-primary" onclick="updateTeacherSection()">Update</button>

						  </div>
						</div>
					  </div>
					</div>




						<!-- modals for delete  -->
					<div class="modal fade" id="updateteacherstatus" tabindex="-1" role="dialog" aria-labelledby="teacherdelete's modal">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Note: This will be changed permanently.</h4>
						  </div>
						  <div >
							<center>
							Are you sure you want to continue?
							</center>
						  </div>
						  <div class="modal-footer">
							<button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button id="updateteacher" type="button" class="btn btn-primary">Submit</button>
						  </div>
						</div>
					  </div>

					</div>
					<!--addsection modal-->
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
				
				 

				<script>
				function deleteModal(id){
				$("#updateteacher").click(function(e){
					window.location="admin_updateteacherstatus.php?tID=" + id;
				});
			}

				</script>
					 	<script>
					function viewTeacher(id){
						window.location = '/admin_TeacherDirectory.php?id=' + id;
					}
					
				function populateToModal(firstname, lastname, username, password, emailaddress, address, contact, gender, sectionname, id, isupdate){
						if (isupdate) {

							$('#sectionname').val(sectionname).prop('readonly',true);
							$('#firstname').val(firstname).prop('readonly', false);
							$('#lastname').val(lastname).prop('readonly', false);
							$('#username').val(username).prop('readonly', false);
							$('#emailaddress').val(emailaddress).prop('readonly',false);
							$('#address').val(address).prop('readonly', false);
							$('#contact').val(contact).prop('readonly', false);
							$('#gender').val(gender).prop('readonly', false);
							$('#password').val(password).prop('readonly', false);
							$('#teacher_id').text(id);
							$('#teacherid').text(id);
							$('#buttonId').show();
							$('#buttonId1').show();
							$('#statusID').show();
						}else{

							$('#sectionname').val(sectionname).prop('readonly',true);
							$('#firstname').val(firstname).prop('readonly', true);
							$('#lastname').val(lastname).prop('readonly', true);
							$('#username').val(username).prop('readonly', true);
							$('#emailaddress').val(emailaddress).prop('readonly',true);
							$('#address').val(address).prop('readonly', true);
							$('#contact').val(contact).prop('readonly', true);
							$('#gender').val(gender).prop('readonly', true);
							$('#password').val(password).prop('readonly', true);
							$('#teacher_id').text(id);					
							$('#buttonId1').hide();
							$('#statusID').hide();
						}
					}


					
					function updateTeacher(){
						$.post(
							'admin_TeacherDirectory.php', 
							{
								firstname: $('#firstname').val(), 
								lastname: $('#lastname').val(), 
								username: $('#username').val(), 
								password: $('#password').val(), 
								sectionname: $('#sectionname').val(),  
								emailaddress: $('#emailaddress').val(),  
								address: $('#address').val(),  
								contact: $('#contact').val(),  
								gender: $('#gender').val(),  
								id: $('#teacher_id').text()
							}, function (data){
								//console.log('data', data);
								var temp = data.split(':::')[0];
								var truData = JSON.parse(temp);
								
								if(truData.status == 'success'){
									alert("successfully updated");
									window.location="admin_TeacherDirectory.php";
						

								}else{
									alert("update fail");
									window.location="admin_TeacherDirectory.php";
									console.log('update fail', truData);
								}
								
								$('#teacherModal').modal('hide');
							}
						);
					}

				</script>
							<script>

			
	function updateTeacherSection(){
	        var sectionname=$('#section_name').val();  
	        var teacherid=$('#teacherid').text(); 

	     
	        var dataString = 'sectionname=' + sectionname + '&teacherid=' + teacherid  ;
	        $.ajax({
	        type: "POST",
	        url: "admin_updateteachersection.php",
	        data: dataString,
	        
	        success: function(result){
	                 var result=trim(result);
	               
	                 if(result=='true'){
	                  alert("Section successfully changed");
	                  window.location='admin_TeacherDirectory.php';
	             
	                 }else{
	                       alert(result);
	                

	              }
	        }
	        });

	  }

	      function trim(str){
	       var str=str.replace(/^\s+|\s+$/,'');
	       return str;
	  }
			  			</script>



				</div>
			
			</body>
		</html>