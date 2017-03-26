<?php

class Addon {
 private $addonid, $item,$price,$quantity;

public function AddonID(){
  return $this->addonid=$addonid;
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
 public function __construct($item, $price,$quantity)
 {


  $this->Item=$item;
  $this->Price=$price;
  $this->Quantity=$quantity;
 }

  public function Addon()
  {
    $success=false;
    $sql="insert into tbladdons (item,price,quantity) values ('$this->Item','$this->Price', '$this->Quantity')";
    
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


  public function UpdateAddon()
  {
    $success=false;
    $sql="update tbladdons set item='$this->Item', price='$this->Price', '$this->Quantity'  where addon_id='$this->AddonID'";
    
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

 public static function UpdateQuantity($quantity,$item)
  {
    $success=false;
    $sql="update tbladdons set quantity='$quantity'  where item='$item'";
    
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


  /*public function UpdateAddon()
  {
    $success=false;
    $sql="update tbladdons set item='$this->Item', price='$this->Price', quantity='$this->Quantity'  where addon_id='$this->AddonID'";
    
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
}*/
//
public static function addonUpdate($addItem,$addPrice,$addQuantity,$addID)
{
  $success=false;
  $sql="update tbladdons set item='$addItem', price='$addPrice', quantity='$addQuantity'  where addon_id='$addID'";

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
//
 public function DeleteAddon()
   {

    $success=false;
    $sql="delete from tbladdons where addon_id='$this->AddonID'";

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

  public static function AddonsDelete($addon_id) {
    $success=false;
    $sql="DELETE FROM tbladdons WHERE addon_id='$addon_id'";

    try {
      include('../../connection.php');
      $query=mysqli_query($conn,$sql);
      $success=true;
    } catch (mysqliException $ex) {
      $success=false;
      $ex-getMesssage();
    }
    mysqli_close($conn);
    return $success;
  }

  public static function reservationaddonDelete($addon_id) {
    $success=false;
    $sql="DELETE FROM tbladdonreserve WHERE addonid='$addon_id'";

    try {
      include('../../connection.php');
      $query=mysqli_query($conn,$sql);
      $success=true;
    } catch (mysqliException $ex) {
      $success=false;
      $ex-getMesssage();
    }
    mysqli_close($conn);
    return $success;
  }

  public static function commentDelete($comment_ID) {
    $success=false;
    $sql="DELETE FROM tblcomment WHERE Comment_ID='$comment_ID'";

    try {
      include('../../connection.php');
      $query=mysqli_query($conn,$sql);
      $success=true;
    } catch (mysqliException $ex) {
      $success=false;
      $ex-getMesssage();
    }
    mysqli_close($conn);
    return $success;
  }
}
/*public static function GetCategoryID($categoryname)
{
  $id="not found";
  $sql="select Category_ID from tblcategories where CategoryName='$categoryname'";

  include ('../connection.php');
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if ($row=mysqli_fetch_array($query))
   {
    $id=$row['Category_ID'];
  }
  else
  {
    $id=null;
    mysqli_close($conn);
  }
  return $id;
} 

public static function GetCategoryName($id)
{
  $name="not found";
  $sql="select CategoryName from tblcategories where Category_ID='$id'";

  include ('../connection.php');
  $query=mysqli_query($conn,$sql);
   if ($row=mysqli_fetch_array($query))
   {
    $name=$row['CategoryName'];
  }
  else
  {
    $name=null;
    mysqli_close($conn);
  }
  return $name;
} 
public static function CAtegoryEmpty($categoryname)
{
  $isEmpty=false;
  $sql="select COUNT(Category_ID) from tblrooms where Category_ID='".Category::GetCategoryID($categoryname)."' ";

  include ('../connection.php');
  $query=mysqli_query($conn,$sql);
  
 $row=mysqli_fetch_array($query);
 $num=$row['COUNT(Category_ID)'];

  if ($num > 0)
    $isEmpty=false;
  else
    $isEmpty=true;
 
    mysqli_close($conn);
  return $isEmpty;
    
}*/

?>