<?php 
session_start();
include('../../connection.php');
include('../Class/addon.php');
    $user_check=$_SESSION['Customerid'];
    $sql = "SELECT * FROM tblusers WHERE Customer_ID = '$user_check'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $type=$row['Type'];

	if (isset($_GET['addonid']))
	{
    	$addon_id=$_GET['addonid'];
    
        if (Addon::reservationaddonDelete($addon_id)) {
        	if($type=='Staff')
        	{
            header('Location: ../pages/guestaddon.php');
        	}
        	else
        	{
            header('Location: ../pages/transaction.php');
            } 
        }
    }
?>