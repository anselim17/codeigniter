<?php

class Transaction{
 private $reservationid,$customerid,$userincharge,$datereserve,$datecheckin,$datecheckout,$amount,$status,$addexcess,$totalamount;

 public function ReservationID(){
  return $this->reservationid=$reservationid;
 }
  public function CustomerID(){
  return $this->customerid=$customerid;
 }
   public function Amount(){

  return $this->amount=$amount;
 }
  public function UserInCharge(){
  return $this->userincharge=$userincharge;
 }
   public function DateReserve(){
  return $this->datereserve=$datereserve;
 }
   public function DateCheckIn(){
  return $this->datecheckin=$datecheckin;
 }
  public function DateCheckOut(){
  return $this->datecheckout=$datecheckout;
 }
   public function Status(){
  return $this->status=$status;
 }
  public function AddExcess(){
    return $this->addexcess=$addexcess;
  }
  public function TotalAmount(){
    return $this->totalamount=$totalamount;
  }

 public function __construct($customerid,$datereserve,$datecheckin,$datecheckout,$amount,$totalamount,$status,$addexcess,$userincharge)
 {
  $this->CustomerID=$customerid;
  $this->Amount=$amount;
  $this->TotalAmount=$totalamount;
  $this->DateReserve=$datereserve;
  $this->DateCheckIn=$datecheckin;
  $this->DateCheckOut=$datecheckout;
  $this->UserInCharge=$userincharge;
  $this->Status=$status;
  $this->AddExcess=$addexcess;
 }

  public function AddTransaction()
  {
    $success=false;
    $sql="insert into tbltransaction (Customer_ID,DateReserve,DateIn,DateOut,Amount,TotalAmount,Status,AddExcess,Userincharge) values ('$this->CustomerID','$this->DateReserve','NULL',NULL,'$this->Amount','$this->TotalAmount','$this->Status','$this->AddExcess','$this->UserInCharge')";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=true;
}
catch (Exception $ex)
{
  $success=false;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}


  public static function UpdateAmount($amount,$totalamount,$datecheckin,$addexcess,$reservationid)
  {
    $status=0;
    $sql="update tbltransaction set Amount='$amount', TotalAmount='$totalamount' , DateIn='$datecheckin', AddExcess='$addexcess' where Reservation_ID='$reservationid'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $status=1;
}
catch (mysqlException $ex)
{
  $status=0;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $status;
}
 public static function UpdateBalance($amount,$totalamount,$reservationid)
  {
    $status=0;
    $sql="update tbltransaction set Amount='$amount', TotalAmount='$totalamount' where Reservation_ID='$reservationid'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $status=1;
}
catch (mysqlException $ex)
{
  $status=0;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $status;
}

  public  function CheckOut($reservationid,$userincharge,$confirmation)
  {
    $status=0;
    $sql="update tbltransaction set DateOut='$this->DateCheckOut', Status='Check Out'  where Reservation_ID='".transaction::GettransactionReservationID($confirmation)."'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=1;
}
catch (mysqlException $ex)
{
  $success=0;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}
  public  function CheckIn($reservationid,$userincharge,$confirmation)
  {
    $success=0;
    $sql="update tbltransaction set DateIn='$this->DateCheckIn',  Status='Check In'  where Reservation_ID='".transaction::GettransactionReservationID($confirmation)."'";
            
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=1;
}
catch (mysqlException $ex)
{
  $success=0;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}
  public  static function Reserve($userincharge,$amount,$status,$reservationid)
  {
    $success=0;
    $sql="update tbltransaction set UserInCharge='$userincharge' , Amount='$amount' , Status='$status' where Reservation_ID='".$reservationid."'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=1;
}
catch(mysqlException $ex)
{
  $success=0;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}

  public  static function CheckInStatus($datecheckin,$userincharge,$status,$reservationid)
  {
    $success=0;
    $sql="update tbltransaction set  DateIn='$datecheckin',UserInCharge='$userincharge' , Status='$status' where Reservation_ID='".$reservationid."'";
    
try
{
  include('../../connection.php');
  $query=mysqli_query($conn,$sql);
  $success=1;
}
catch (mysqlException $ex)
{
  $success=0;
  $ex->getMesssage();
}
  mysqli_close($conn);
return $success;
}





  public static function GettransactionReservationID($confirmation)
{
    $id="not found";
        $sql="select Reservation_ID from tblreservation 
              where tblreservation.Confirmation='$confirmation'";

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


  public static  function GetReservationCustomerID($confirmation)
  {
    $id="";
    $sql="select tbltransaction.Reservation_ID from tblreservation
         INNER JOIN tbltransaction ON tblreservation.Customer_ID=tbltransaction.Customer_ID where tblreservation.Confirmation='$confirmation'";

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
   $row=mysqli_fetch_assoc($query);
    $id=$row['Reservation_ID'];

    mysqli_close($conn);
          return $id;

  }


  public static function GetRID($curdate)
{
  $id="not found";
  $sql="select Reservation_ID from tblreservation 
  iNNER JOIN tbltransaction on tblreservation.Reservation_ID=tbltransaction.Reservation_ID  
  where tblreservation='$curdate' And tblreservation.Status='Pending'";

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
/*  public static function GetRID($reservationid)
{
  $id="not found";
  $sql="select Reservation_ID from tblreservation 
  iNNER JOIN tblusers on tblreservation.Customer_ID=tblusers.Customer_ID  where tblreservation.Reservation_ID='$reservationid' and tblreservation.Status='Check Out'";

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
} */



public static function transactionDelete($curdate) {
    $success=false;
    $sql="DELETE FROM tbltransaction WHERE DateReserve='".Transaction::GetRID($curdate)."' AND Status='Pending'";

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
  



}
?>