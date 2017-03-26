<?php 
include('../../connection.php');
include('../Class/room.php');
include('../Class/categories.php');


$room=new Room();
$hideID=$_POST['hiddenid'];
$Roomid=$_POST['roomid'];
$Categoryname=$_POST['categoryname'];
$Discount=$_POST['discount'];
$Rate=$_POST['rate'];
$Descript=$_POST['descript'];
$Status=$_POST['status'];
$Adult=$_POST['adult'];
$Child=$_POST['child'];
$from=$_POST['start'];
$to=$_POST['end'];

if (empty($from)||empty($to)) {
	$sql="select * from tblrooms where Room_ID='$hideID'";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	$HiddenID = $row['Room_ID'];

	$room->HiddenID=$HiddenID;
	$room->RoomID=$Roomid;
	$room->CategoryID=(string)Category::GetCategoryID($Categoryname);
	$room->Discount=$Discount;
	$room->Rate=$Rate;
	$room->Descript=$Descript;
	$room->Status=$Status;
	$room->Noadult=$Adult;
	$room->Nochild=$Child;
	$room->Start=$from;
	$room->End=$to;

	if ($room->Updateroom()){
		echo "success";
	}
} else {
	if (empty($Discount)||$Discount==0) {
		echo "Insert a value on Discount Amount to add Promo";
	} else {
		$Start = \DateTime::createFromFormat('d/m/Y', $from)->format('Y-m-d');
		$End= \DateTime::createFromFormat('d/m/Y', $to)->format('Y-m-d');
		
		$sql="select * from tblrooms where Room_ID='$hideID'";
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
		$HiddenID = $row['Room_ID'];

		$room->HiddenID=$HiddenID;
		$room->RoomID=$Roomid;
		$room->CategoryID=(string)Category::GetCategoryID($Categoryname);
		$room->Discount=$Discount;
		$room->Rate=$Rate;
		$room->Descript=$Descript;
		$room->Status=$Status;
		$room->Noadult=$Adult;
		$room->Nochild=$Child;
		$room->Start=$Start;
		$room->End=$End;

		if ($room->Updateroom()){
			echo "success";
		}
	}
}

?>
