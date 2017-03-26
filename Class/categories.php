<?php

class Category{
 private $categoryid;
 private $categoryname;

 public function CategoryID(){
  return $this->categoryid=$categoryid;
 }
  public function CategoryName(){
  return $this->categoryname=$categoryname;
 }
 public function __construct($categoryid, $categoryname)
 {
  $this->CategoryID=$categoryid;
  $this->CategoryName=$categoryname;
 }

  public function AddCategory()
  {
    $success=false;
    $sql="insert into tblcategories (CategoryName) values ('$this->CategoryName')";
    
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


  public function UpdateCategory()
  {
    $success=false;
    $sql="update tblcategories set CategoryName='$this->CategoryName'  where Category_ID='$this->CategoryID'";
    
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

public function DeleteCategory() {

    $success=false;
    $sql="delete from tblcategories where Category_ID='$this->CategoryID'";
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


public static function GetCategoryID($categoryname)
{
  $id="not found";
  $sql="select * from tblcategories where Category_ID='$categoryname'";

  include ('../../connection.php');
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

public static function GetcID($categoryname)
{
  $id="not found";
  $sql="select Category_ID from tblcategories where CategoryName='$categoryname'";

  include ('../../connection.php');
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

  include ('../../connection.php');
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

  include ('../../connection.php');
  $query=mysqli_query($conn,$sql);
  
 $row=mysqli_fetch_array($query);
 $num=$row['COUNT(Category_ID)'];

  if ($num > 0)
    $isEmpty=false;
  else
    $isEmpty=true;
 
    mysqli_close($conn);
  return $isEmpty;
    
}

}
?>