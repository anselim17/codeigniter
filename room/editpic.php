<?php
include('../pdoconnection.php');

if(isset($_GET['id']))
{
$roomid=$_GET['id'];
$sql = "SELECT * FROM tblrooms WHERE Room_ID ='$roomid'";
$result = $conn->query($sql);


while($row=$result->fetch())
  {
  echo "<img width=200 height=180 alt='Unable to View' src='" . $row["Image"] . "'>";
  }
	echo '<form action="editpicexec.php" method="post" enctype="multipart/form-data">';
	
	//echo "<img width=200 height=180 alt='Unable to View' src='" . $row1["image"] . "'>";
	echo '<br>';
			echo '<input type="hidden" name="roomid" value="'. $_GET['id'] .'">';
			echo 'Select Image';
			echo '<br>';
			echo '<input type="file" name="updateimage">'.'<br>';
			echo '<input type="submit" value="Upload">';
	echo '</form>';
			}
?>