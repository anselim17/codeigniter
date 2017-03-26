<?php 
include_once("connection.php");
if  (isset($_GET['pID']))
{
	$pID=$_GET["pID"];
	$sqli= "SELECT * FROM user where id='$pID'";
	$res=mysqli_query($conn, $sqli);
	$row=mysqli_fetch_assoc($res);
	if ($row['Status']=='Activate') {
		$sql="update user set Status='Deactivate' where id ='$pID'";
		$result=mysqli_query($conn,$sql);
		echo "<script>window.location='admin_pupilDirectory.php'</script>";
		mysqli_close($conn);
	} else {
		$sql="update user set Status='Activate' where id ='$pID'";
		$result=mysqli_query($conn,$sql);
		echo "<script>window.location='admin_pupilDirectory.php'</script>";
		mysqli_close($conn);
	}
	

}

else
{
	echo "<script>alert('error');</script>";
	echo "<script>window.location='admin_pupilDirectory.php</script>";
			mysqli_close($conn);

}


?>