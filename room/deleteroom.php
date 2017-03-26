
<?php 
include('../pdoconnection.php');
include('../Class/room.php');
include('../Class/categories.php');
if (isset($_GET['roomid']))
{
  	$roomid=$_GET['roomid'];

	$sql="SELECT * FROM tblrooms WHERE Room_ID='$roomid'";
	$result = $conn->query($sql);
	$row =$result->fetch(PDO::FETCH_ASSOC);

            if (!Room::RoomEmpty($roomid))
            {
                echo "This Room has still promo rooms. please delete all promo rooms before this";
            }

            else
            {

            $Image="photos/";
            $imageFileType = pathinfo($Image,PATHINFO_EXTENSION); 
           	$room= new Room();
          	$room->RoomID=$roomid;
		      	$room->CategoryID=(string)Category::GetCategoryID($row['Category_ID']);
 	   	      $room->Rate=$row['Rate'];
   			    $room->Descript=$row['Description'];
			      $room->Status=$row['Status'];
			     $room->Noadult=$row['No_adult'];
			     $room->Nochild=$row['No_child'];
			     $room->Image=$row['Image'];            	

    
        	if ($room->Deleteroom()) {
          unlink($imageFileType .$row['Image']);
          header("Location: manageroom.php");
			    }
}
}
?>