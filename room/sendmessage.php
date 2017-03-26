<?php
session_start();
include('../../connection.php');
if (isset($_POST['submit'])) {
	if (!isset($_SESSION['Customerid'])) {
		echo '<script type="text/javascript">';
        echo 'alert("Please Login first");';
        echo 'window.location.href = "../../index.php";';
        echo '</script>';
	} else {
		$customerid = mysqli_real_escape_string($conn, $_POST["customerid"]);
		$fname = $_POST['fname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$comment = mysqli_real_escape_string($conn, $_POST["comment"]);
		if (empty($fname)||empty($email)||empty($phone)||empty($comment)) {
			echo '<script type="text/javascript">';
	        echo 'alert("Please fill the form");';
	        echo 'window.location.href = "../../index.php";';
	        echo '</script>';
		}else {
		$sql = "INSERT INTO tblcomment (Customer_ID, Comments)
			VALUE ('$customerid','$comment')";
			if($conn ->query($sql) === TRUE) {
				echo '<script type="text/javascript">';
	            echo 'alert("Thank you for sending your feedbacks");';
	            echo 'window.location.href = "../../index.php";';
	            echo '</script>';
			}
		}
	}
}

?>