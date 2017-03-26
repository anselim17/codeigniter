<?php 
class Reservation{
private $customerid,$categoryname,$roomid,$numberofdays,$nadult,$nchild,$excessadditional;  
private $status,$arrival,$departure,$addonpayable,$downpayment,$confirmation,$payable,$transaction;

 public function CustomerID()
 {
  return $this->customerid=$customerid;
 }
  public function CategoryName()
 {
  return $this->categoryname=$categoryname;
 }
  public function RoomID()
 {
  return $this->roomid=$roomid;
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
  public function NumberofAdult()
 {
  return $this->nadult=$nadult;
 }
  public function NumberofChild()
 {
  return $this->nchild=$nchild;
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
  public function Confirmation()
 {
  return $this->confirmation=$confirmation;
 }
   public function ExcessAditional()
 {
  return $this->excessadditional=$excessadditional;
 }



 public function __construct($customerid,$categoryname,$roomid,$arrival,$departure,$numberofdays,$nadult,$nchild,$status,$addonpayable,$downpayment,$excessadditional,$payable,$confirmation){

  $this->CustomerID=$customerid;
  $this->CategoryName=$categoryname;
  $this->RoomID=$roomid;
  $this->Arrival=$arrival;
  $this->Departure=$departure;
  $this->Payable=$payable;
  $this->NumberofDays=$numberofdays;
  $this->NumberofAdult=$nadult;
  $this->NumberofChild=$nchild;
  $this->Status=$status;
  $this->Addonpayable=$addonpayable;
  $this->Downpayment=$downpayment;
  $this->ExcessAditional=$excessadditional;
  $this->Confirmation=$confirmation;

   }

   public function AddReserve()
   {
    $success=false;


    //$from = DateTime::createFromFormat('d/m/Y', $this->Arrival)->format('Y-m-d');
    //$to = DateTime::createFromFormat('d/m/Y', $this->Departure)->format('Y-m-d');
    $from = $this->Arrival;
    $to = $this->Departure;
    $datenow=date('Y-m-d');

    $sql="insert into tblreservation (Customer_ID,CategoryName,Room_ID,ReservationDate,Arrival,Departure,NumberofDay,No_Adult,No_Child,Status, "
      . "AddonPayable,Downpayment,addexcess,Payable,Confirmation,transaction) values ("
      . "'$this->CustomerID','$this->CategoryName','$this->RoomID','$datenow','"
      . $from ."','". $to ."','$this->NumberofDays','$this->NumberofAdult','$this->NumberofChild','$this->Status','$this->Addonpayable','$this->Downpayment','$this->ExcessAditional','$this->Payable','$this->Confirmation',null)";
        
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



  public static function GetCustomerID($customerid)
{
  $id="not found";
  $sql="select Customer_ID from tblreservation where Customer_ID='$customerid'";

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


   public static function UpdateStatus($status,$downpayment,$confirmation)
  {

    $success=false;
$sql="update tblreservation set  Status='$status', Downpayment='$downpayment' where Confirmation='$confirmation'";
    
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

   public static function UpdateAddonPayable($addonpayable,$downpayment,$payable,$confirmation)
  {

    $success=false;     
$sql="update tblreservation set  AddonPayable='$addonpayable', Downpayment='$downpayment' ,Payable='$payable' where Confirmation='$confirmation'";
    
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


  public static function UpdateTranfer($categoryname,$roomid,$arrival,$departure,$numberofdays,$excessadditional,$payable,$reservationid)
  {

    $success=false;     
$sql="update tblreservation set  CategoryName='$categoryname',Room_ID='$roomid',Arrival='$arrival', Departure='$departure',NumberofDay='$numberofdays', addexcess='$excessadditional' ,Payable='$payable' where Reservation_ID='$reservationid'";
    
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

public static function CancelStatus($rid) {
    $success=false;
    $sql="UPDATE tblreservation set Status='Cancelled' WHERE Reservation_ID='$rid'";

    try {
      include('../../connection.php');
      $query=mysqli_query($conn,$sql);
      $success=true;
    } catch (mysqliException $ex) {
      $success=false;
      $ex->getMesssage();
    }
    mysqli_close($conn);
    return $success;
  }

    public static function GetReservationID($username)
{
  $id="not found";
  $sql="select Reservation_ID from tblreservation
  iNNER JOIN tblusers on tblreservation.Customer_ID=tblusers.Customer_ID  where tblusers.Username='$username'";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if ($row=mysqli_fetch_array($query))
   {
    $id=$row['Reservation_ID'];
  }
  else
  {
    $id=null;
    mysqli_close($conn);
  }
  return $id;
} 
  public static function GetRID($reservationid)
{
  $id="not found";
  $sql="select Reservation_ID from tblreservation 
  iNNER JOIN tblusers on tblreservation.Customer_ID=tblusers.Customer_ID  where tblreservation.Reservation_ID='$reservationid'";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if ($row=mysqli_fetch_array($query))
   {
    $id=$row['Reservation_ID'];
  }
  else
  {
    $id=null;
    mysqli_close($conn);
  }
  return $id;
} 
public static function ReservationEmpty($reservationid)
{
  $isEmpty=false;
  $sql="select Reservation_ID from tbltransaction where Reservation_ID='".Reservation::GetRID($reservationid)."' ";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql);
  
 $row=mysqli_fetch_array($query);
 $num=$row['Reservation_ID'];

  if ($num > 0)
    $isEmpty=false;
  else
    $isEmpty=true;
 
    mysqli_close($conn);
  return $isEmpty;
    
}
public static function AddonEmpty($reservationid)
{
  $isEmpty=false;
  $sql="select Reservation_ID from tbladdonreserve where Reservation_ID='".Reservation::GetRID($reservationid)."' ";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql);
  
 $row=mysqli_fetch_array($query);
 $num=$row['Reservation_ID'];

  if ($num > 0)
    $isEmpty=false;
  else
    $isEmpty=true;
 
    mysqli_close($conn);
  return $isEmpty;
    
}


  } 

