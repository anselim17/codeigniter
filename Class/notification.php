<?php
class Notifier{
 private $fuser,$touser,$message,$daterecieved,$unread;

 public function FromUser()
 {
  return $this->fuser=$fuser;
 }
 public function ToUser()
 {
 	return $this->touser=$touser;
 }

public function Message()
 {
 	return $this->message=$message;
 }
 public function DateRecieved()
 {
  return $this->daterecieved=$daterecieved;
 }
 public function Unread()
 {
  return $this->unread=$unread;
 }


 public function __construct($fuser,$touser,$message){

  $this->FromUser=$fuser;
  $this->ToUser=$touser;
  $this->Message=$message;
 
   }

   public function NotifyUser()
   {
    $success=false;
    $datenow=date('Y-m-d');
    $s=1;
    $sql="insert into tblnotifications (FromUser,ToUser,Message,DateRecieved,Unread) values ('$this->FromUser','$this->ToUser','$this->Message','$datenow',2)";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=true;
}
catch (mysqliException $ex)
{
  $success=false;
  $ex-getMesssage();
}
  mysqli_close($conn);
return $success;
}
public static function GetID($username,$password)
{
  $id="";
  $sql="select Customer_ID from tblusers where Username='$username' and Password='$password'";

  include ('../connection.php');
  $query=mysqli_query($conn,$sql);
   if ($row=mysqli_fetch_array($query))
   {
    $id=$row['Customer_ID'];
  }
  else
  {
    $id=null;
    mysqli_close($conn);
  }
  return $id;
} 
   
}
 ?>