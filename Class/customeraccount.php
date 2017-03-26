<?php
class CustomerAccount{
 private $firstname,$lastname,$city,$address,$province,$country,$username,$password,$contact,$email;

 public function Firstname()
 {
  return $this->firstname=$firstname;
 }
 public function Lastname()
 {
 	return $this->lastname=$lastname;
 }

public function City()
 {
 	return $this->city=$city;
 }
public function Address()
 {
 	return $this->address=$address;
 }
public function Province()
 {
 	return $this->province=$province;
 }
public function Country()
 {
 	return $this->country=$country;
 }
public function Username()
 {
 	return $this->username=$username;
 }
public function Password()
 {
 	return $this->password=$password;
 }
 public function Email()
 {
 	return $this->email=$email;
 }

public function Contact()
 {
 	return $this->contact=$contact;
 }




 public function __construct($firstname,$lastname,$city,$address,$province,$country,$username, $password,$contact,$email){

  $this->Firstname=$firstname;
  $this->Lastname=$lastname;
  $this->City=$city;
  $this->Address=$address;
  $this->Province=$province;
  $this->Country=$country;
  $this->Username=$username;
  $this->Password=$password;
  $this->Contact=$contact;
  $this->Email=$email;
 
   }

   public function AddUser()
   {
    $success=false;
    $sql="insert into tblusers (FirstName,LastName,City,Address,Province,Country,Username,Password,Contact,Email) values ('$this->Firstname','$this->Lastname','$this->City','$this->Address','$this->Province','$this->Country','$this->Username','$this->Password','$this->Contact','$this->Email')";
    
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