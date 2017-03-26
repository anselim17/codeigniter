<?php

class transferroom{
 private $reservationid,$firstname,$lastname,$roomnumber, $categoryname,$rate,$datetransfer,$amount,$numbersofdays,$status,$userincharge;


  public function ReservationID(){
  return $this->reservationid=$reservationid;
 }
  public function FirstName(){
  return $this->firstname=$firstname;
 }
 public function LastName(){
  return $this->lastname=$lastname;
 }
  public function RoomNumber(){
  return $this->roomnumber=$roomnumber;
 }
 public function CategoryName(){
  return $this->categoryname=$categoryname;
 }
  public function Rate(){
  return $this->rate=$rate;
 }
  public function DateTransfer(){
  return $this->datetransfer=$datetransfer;
 }
   public function Numbersofday(){
  return $this->datetransfer=$datetransfer;
 }
 public function Amount(){
  return $this->amount=$amount;
 }
  public function Status(){
  return $this->status=$status;
 }
  public function UserInCharge(){
  return $this->userincharge=$userincharge;
 }
 public function __construct($reservationid,$firstname,$lastname,$roomnumber,$categoryname,$rate,$datetransfer,$numbersofdays,$amount,$status,$userincharge)
 {

  $this->ReservationID=$reservationid;
  $this->FirstName=$firstname;
  $this->LastName=$lastname;
  $this->RoomNumber=$roomnumber;
  $this->CategoryName=$categoryname;
  $this->Rate=$rate;
  $this->DateTransfer=$datetransfer;
  $this->Numbersofday=$numbersofdays;
  $this->Amount=$amount;
  $this->Status=$status;
  $this->UserInCharge=$userincharge;
 }

  public function TransferRoom()
  {
    $success=false;
    $sql="insert into tblroomtransfer (Reservation_ID,FirstName,LastName,previousRoomnumber,previousCategoryname,previousRate,previousInOut,Numbersofday,previousAmount,Status,UserInCharge) values ('$this->ReservationID','$this->FirstName','$this->LastName','$this->RoomNumber','$this->CategoryName','$this->Rate','$this->DateTransfer','$this->Numbersofday','$this->Amount','$this->Status','$this->UserInCharge')";
    
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



public static function transferDelete($transferDel) {
    $success=false;
    $sql="DELETE FROM tblroomtransfer WHERE transfer_id='$transferDel'";

    try {
      include('../../connection.php');
      $query=mysqli_query($conn,$sql);
      $success=true;
    } catch (Exception $ex) {
      $success=false;
      $ex->getMesssage();
    }
    mysqli_close($conn);
    return $success;
  }
}


?>