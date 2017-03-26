<?php

 Class Notifier
{
 
 public static function NotifyReservation($confirmation,$user,$message)
 {
 	$sql ="insert into tblreservationnotify (Confirmation,ReservationName,Message,Unread) values ('$confirmation','$user','$message',1)";

  include ('../../connection.php');

 	$result=mysqli_query($conn,$sql);
 	mysqli_close($conn);
 }

}

?>