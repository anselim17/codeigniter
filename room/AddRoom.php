  <?php
  
include("../pdoconnection.php");  
include("../Class/room.php");
include("../Class/categories.php"); 


if (isset($_POST['addroom']))
{
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
$Roomid=$_POST['roomid'];
$Categoryname=$_POST['categoryname'];
$Rate=$_POST['rate'];
$Discount=0;
$Descript=$_POST['descript'];
$Status=$_POST['status'];
$Adult=$_POST['adult'];
$Child=$_POST['child'];

$room->RoomID=$Roomid;
$room->CategoryID=Category::GetcID($Categoryname);
$room->Rate=$Rate;
$room->Discount=$Discount;
$room->Descript=$Descript;
$room->Status=$Status;
$room->Noadult=$Adult;
$room->Nochild=$Child;
$room->Start=null;
$room->End=null;
$room->Image=$Image;

  if ($room->Addroom()){
  move_uploaded_file($_FILES["image"]["tmp_name"],"photos/" .$new_image_name);
  echo "success";
  header("Location:manageroom.php");
  }

}
}
else {echo "error";
header("Location:manageroom.php");
}
?>
