<?php
include('../../connection.php');
include('../Class/room.php');


if (isset($_FILES['updateimage']['tmp_name']))
{
  $roomid=$_POST['roomid'];
  $new_image_name = 'IMG' . uniqid() . '_' . date('Y-m-d') . '.jpg';
  $Image="photos/" .basename($new_image_name);
  $imageFileType = pathinfo($Image,PATHINFO_EXTENSION);    
  if (file_exists($Image)){
    echo "Image exists";
          
  } 

else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        
}

else{
	$room=new Room();  
   $room->RoomID=$roomid;
   $room->Image=$Image;
	if($room->Updateimage())
	{
	  move_uploaded_file($_FILES["updateimage"]["tmp_name"],"photos/" . $new_image_name);
		header("location:manageroom.php");

		}
	}
}


?>