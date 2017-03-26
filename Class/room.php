<?php

class Room{
 private $hiddenid,$roomid,$categoryid, $rate,$discount,$status,$maxadult,$maxchild;
 private $descript,$type,$start,$end,$image;

 public function RoomID(){
  return $this->roomid=$roomid;
 }
 public function HiddenID(){
  return $this->hiddenid=$hiddenid;
 }
  public function CategoryID(){
  return $this->categoryid=$categoryid;
 }
 public function Rate(){
  return $this->rate=$rate;
 }
 public function Discount(){
  return $this->discount=$discount;
 }
  public function Descript(){
  return $this->descript=$descript;
 }
  public function Status(){
  return $this->status=$status;
 }
  public function Noadult(){
  return $this->maxadult=$maxadult;
 }
  public function Nochild(){
  return $this->maxchild=$maxchild;
 }
public function Start(){
  return $this->start=$start;
 }
  public function End(){
  return $this->end=$end;
 }

  public function Image(){
  return $this->image=$image;
 }


 public function Addroom()
   {

    $success=true;
 $query="INSERT INTO  tblrooms (Room_ID,Category_ID,Rate,Discount,Description,Status,No_adult,No_child,Date_Start,Date_End,Image) values (:Roomid,:Categoryid,:Rate,:Discount,:Descript,:Status,:Adult,:Child,:Start,:End,:Image)";

  
 try
{
   include("../pdoconnection.php"); 
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':Roomid',$this->RoomID);
  $stmt->bindParam(':Categoryid',$this->CategoryID);
  $stmt->bindParam(':Rate',$this->Rate);
  $stmt->bindParam(':Discount',$this->Discount);
  $stmt->bindParam(':Descript',$this->Descript);
  $stmt->bindParam(':Status',$this->Status);
  $stmt->bindParam(':Adult' ,$this->Noadult);
  $stmt->bindParam(':Child' ,$this->Nochild);
  $stmt->bindParam(':Start' ,$this->Start);
  $stmt->bindParam(':End',$this->End);
  $stmt->bindParam(':Image',$this->Image);
  $stmt->execute();
  $success=true;
  }
catch (PDOException $e)
{ 
  $success=false;
  echo "Error: " . $e->getMessage();
}
return $success;
$conn=null;
}

/*public static function UpdateStatus($roomid)
{
  

  $sql="select * from tblrooms where Room_ID='$roomid'";
  include ('../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
  $row=mysqli_fetch_array($query);
  $Discount=$row['Discount'];
  $Discount=0 .'%';
  $updte="update tblrooms set  Discount='$Discount' where Room_ID='$roomid'";
  $result=mysqli_query($conn,$updte) or die(mysqli_error($conn)); 
  mysqli_close($conn);
  
} */

 public function Updateroom()
   {

 $query="update tblrooms set Room_ID=:Roomid ,Discount=:Discount, Rate=:Rate,Description=:Descript ,Status=:Status, No_adult=:Adult, No_child=:Child,Date_Start=:Start,Date_End=:End where Room_ID=:Hiddenid ";
 try
{

   include("../pdoconnection.php"); 
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':Hiddenid',$this->HiddenID);
  $stmt->bindParam(':Roomid',$this->RoomID);
  //$stmt->bindParam(':Categoryid',$this->CategoryID);
  $stmt->bindParam(':Rate',$this->Rate);
  $stmt->bindParam(':Discount',$this->Discount);
  $stmt->bindParam(':Descript',$this->Descript);
  $stmt->bindParam(':Status',$this->Status);
  $stmt->bindParam(':Adult' ,$this->Noadult);
  $stmt->bindParam(':Child' ,$this->Nochild);
  $stmt->bindParam(':Start' ,$this->Start);
  $stmt->bindParam(':End',$this->End);
  $stmt->execute();
  $success=true;
  }
catch (PDOException $e)
{ 
  $success=false;
  echo "Error: " . $e->getMessage();
}
return $success;
$conn=null;
}
 public function Updateimage()
   {

 $query="update tblrooms set Image=:Image where Room_ID=:Roomid ";
 try
{

   include("../pdoconnection.php"); 
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':Roomid',$this->RoomID);
  $stmt->bindParam(':Image',$this->Image);

  $stmt->execute();
  $success=true;
  }
catch (PDOException $e)
{ 
  $success=false;
  echo "Error: " . $e->getMessage();
}
return $success;
$conn=null;
}

   public function Deleteroom()
     {

    $success=true;
   $query="delete from tblrooms where Room_ID='$this->RoomID'";

   try
  {
     include("../pdoconnection.php"); 
    $conn->exec($query);
   
    }
  catch (PDOException $e)
  { 
    $success=false;
    echo "Error: " . $e->getMessage();
  }
  return $success;
  $conn=null;
  }

  public static function GetRoomID($roomid)
{
  $id="not found";
  $sql="select Room_ID from tblrooms where Room_ID='$roomid'";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if ($row=mysqli_fetch_array($query))
   {
    $id=$row['Room_ID'];
  }
  else
  {
    $id=null;
    mysqli_close($conn);
  }
  return $id;
} 
public static function RoomEmpty($roomid)
{
  $isEmpty=false;
  $sql="select Room_ID from tblpromotion where Room_ID='".Room::GetRoomID($roomid)."' ";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql);
  
 $row=mysqli_fetch_array($query);
 $num=$row['Room_ID'];

  if ($num > 0)
    $isEmpty=false;
  else
    $isEmpty=true;
 
    mysqli_close($conn);
  return $isEmpty;
    
}
}

?>

