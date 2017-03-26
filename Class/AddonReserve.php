<?php

class AddonReserve{
 private $customerid,$reservationid,$item,$price,$quantity,$userincharge,$amount;

public function CustomerID(){
  return $this->customerid=$customerid;
 }
 public function ReservationID(){
  return $this->reservationid=$reservationid;
 }
 public function Item(){
  return $this->item=$item;
 }
  public function Price(){
  return $this->price=$price;
 }
 public function Quantity(){
  return $this->quantity=$quantity;
 }
  public function Amount(){
  return $this->amount=$amount;
 }
  public function UserInCharge(){
  return $this->userincharge=$userincharge;
 }
 public function __construct($customerid,$reservationid,$item, $quantity,$price,$amount,$userincharge)
 {

  $this->CustomerID=$customerid;
  $this->ReservationID=$reservationid;
  $this->Item=$item;
  $this->Quantity=$quantity;
  $this->Price=$price;
  $this->Amount=$amount;
  $this->UserInCharge=$userincharge;
 }

  public function AddonReserve()
  {
    $success=false;
    $sql="insert into tbladdonreserve (Customer_ID,Reservation_ID,item,quantity,price,amount,UserInCharge) values ('$this->CustomerID','$this->ReservationID','$this->Item','$this->Quantity', '$this->Price','$this->Amount','$this->UserInCharge')";
    
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


  public static function UpdateAddonReserve($item,$price,$quantity,$amount,$addonid)
  {
    $success=false;
    $sql="update tbladdonreserve set item='$item', price='$price', quantity='$quantity', amount='$amount'  where addonid='$addonid'";
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

 public function UpdateQuantity()
  {
    $success=false;
    $sql="update tbladdons set Quantitys='$this->Quantity'  where Item='$this->Item'";
    
try
{
  include('../connection.php');
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


 public function DeleteAddon()
   {

    $success=false;
    $sql="delete from tbladdons where addon_id='$this->AddonID'";

try
{
  include('../connection.php');
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
}


?>