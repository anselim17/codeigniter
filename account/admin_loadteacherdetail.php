<?php 
include_once("connection.php");
if (isset($_GET["userid"])){
	$userid=$_GET["userid"];

  $sql = "SELECT user.id,tblsection.sectionname,user.firstname,user.lastname,user.password,user.username,user.Status from user inner join tblsection on user.section_id=tblsection.section_id  WHERE user.role = 2 AND user.id='".$userid."'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $fname=$row["firstname"];

  echo '<center>
        <form method="POST" action="">
  		<span id="teacher_id" class="hidden" $row["id"]></span>
	    <label for="firstname">Firstname:</label><input  required type="text" name="firstname" value="'.$row["firstname"].'" /><br/><br>
		<label for="surname">Lastname:</label><input id="lastname" required type="text" name="lastname" value="'.$row["lastname"].'" /><br/><br>
		<label for="mobile">Username:</label><input id="username" required type="text" name="username"  value="'.$row["username"].'"/><br/><br>
		<label for="home">Password: </label><input id="password" required type="text" name="password" value="'.$row["password"].'" /><br/><br>
	  <label for="section">Section: </label><input id="sectionname" required type="text" name="sectionname" value="'.$row["sectionname"].'"/><br><br>
	    </form>
	    </center>';
	

}

	mysqli_close($conn);
?>

