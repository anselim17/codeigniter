<?php
include("connection.php");
session_start();
$id=$_POST["teacherid"];
$sectioname=$_POST["sectionname"];
$sql="select section_id from tblsection  where sectionname='".$sectioname."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$sectionid=$row["section_id"];

$sql2="update user set section_id='".$sectionid."' where id='".$id."'";
$result=mysqli_query($conn,$sql2);
if($result==1){
	echo "true";
}
else{
	echo "update fail";
}
mysqli_close($conn);



?>