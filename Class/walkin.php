<?php 
class Walkin{
private $categoryname,$roomid,$numberofdays,$contact ;  
private $firstname,$lastname,$status,$arrival,$departure,$addonpayable,$downpayment,$payable;


  public function RoomID()
 {
  return $this->roomid=$roomid;
 }
 public function CategoryName()
 {
  return $this->categoryname=$categoryname;
 }

  public function FirstName()
 {
  return $this->firstname=$firstname;
 }
 public function LastName()
 {
  return $this->lastname=$lastname;
 }

  public function Contact()
 {
  return $this->contact=$contact;
 }

 public function Arrival()
 {
    return $this->arrival=$arrival;
 }

public function Departure()
 {
  return $this->departure=$departure;
 }
 public function NumberofDays()
 {
  return $this->numberofdays=$numberofdays;
 }
   public function Status()
 {
  return $this->status=$status;
 }
  public function Addonpayable()
 {
  return $this->addonpayable=$addonpayable;
 }
 public function Downpayment()
 {
  return $this->downpayment=$downpayment;
 }
 public function Payable()
 {
  return $this->payable=$payable;
 }



 public function __construct($roomid,$categoryname,$firstname,$lastname,$contact,$arrival,$departure,$numberofdays,$status,$addonpayable,$downpayment,$payable){


  $this->RoomID=$roomid;
  $this->CategoryName=$categoryname;
  $this->FirstName=$firstname;
  $this->LastName=$lastname;
  $this->Contact=$contact;
  $this->Arrival=$arrival;
  $this->Departure=$departure;
  $this->NumberofDays=$numberofdays;
  $this->Status=$status;
  $this->Addonpayable=$addonpayable;
  $this->Downpayment=$downpayment;
  $this->Payable=$payable;

   }

   public function AddWalkin()
   {
    $success=false;
    $sql="insert into tblwalkins (Room_ID,CategoryName,FirstName,LastName,Contact,Arrival,Departure,NumberofDays,Status,Addonpayable,Downpayment,Amount) values ('$this->RoomID','$this->CategoryName','$this->FirstName','$this->LastName','$this->Contact','$this->Arrival','$this->Departure','$this->NumberofDays','$this->Status','$this->Addonpayable','$this->Downpayment','$this->Payable')";
      
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=true;
}
catch (mysqliException $ex)
{
  $success=false; 
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}



  public static function GetCustomerID($customerid)
{
  $id="not found";
  $sql="select Customer_ID from tblwalkins where Customer_ID='$customerid'";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
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


   public static function UpdateStatus($status,$downpayment,$customerid)
  {

    $success=false;
$sql="update tblwalkins set  Status='$status', Downpayment='$downpayment' where Customer_ID='$customerid'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=true;
}
catch (mysqliException $ex)
{
  $success=false; 
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}

   public static function UpdateAddonPayable($addonpayable,$customerid)
  {

    $success=false;     
$sql="update tblwalkins set  Addonpayable='$addonpayable' where Customer_ID='$customerid'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=true;
}
catch (mysqliException $ex)
{
  $success=false; 
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}


   public static function UpdateTransfer($categoryname,$roomid,$arrival,$departure,$numberofdays,$payable,$customerid)
  {

    $success=false;     
$sql="update tblwalkins set  CategoryName='$categoryname',Room_ID='$roomid',Arrival='$arrival', Departure='$departure',NumberofDays='$numberofdays',Amount='$payable' where Customer_ID='$customerid'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=true;
}
catch (mysqliException $ex)
{
  $success=false; 
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}



  } 
  /*public static function GetCustomerReservationID($customerid)
{
  $id="not found";
  $sql="select Customer_ID from tblcustomers where Customer_ID='".Reservation::GetCustomerID($customerid)."'";

  include ('../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
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
} */



/*public static function Date($reserve,$arrival,$departure)
{
  $code=1;
  $sql="select * from tblreservation 
  where Arrival between '$arrival' and '$departure' || Arrival <='$arrival' 
  and Departure >='$departure' || Arrival <='$arrival' and Departure >='$departure' ";
  $sql = "SELECT * FROM tblreservation WHERE (Arrival BETWEEN '$arrival' and '$departure') 
  or (Departure BETWEEN '$arrival' and '$departure')  ";

$sql="SELECT r.* FROM tblrooms r LEFT JOIN tblreservation b ON b.Room_ID = r.Room_ID WHERE b.Reservation_ID='$reserve' 
OR (b.Departure >= '$arrival' AND b.Arrival >= '$departure') 
OR (b.Departure <= '$arrival' AND b.Departure <= '$departure')";

    include('../connection.php');
    $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($query);
    if($row)
    {
      $code=1;
    }
    else
    {
      $code=0;
    }
    return $code;
  }*/
