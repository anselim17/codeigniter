<?php 
session_start();
include('../../connection.php');
include('../Class/Reservation.php');
include('../Class/transaction.php');
    $user_check=$_SESSION['Customerid'];
    $sql = "SELECT * FROM tblusers WHERE Customer_ID = '$user_check'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $type=$row['Type'];

if (isset($_GET['resid']))
{
    $resid=$_GET['resid'];
    $sql="select * from tblreservation where Reservation_ID='$resid'";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($query);
    $confirmation=$row['Confirmation'];
    $status=$row['Status'];
        if ($status=="Pending") {
            Reservation::CancelStatus($resid);
            $sql="delete from tblreservationnotify where Confirmation='$confirmation'";
            $result=mysqli_query($conn,$sql);
            if ($type=="Staff")
            {
            echo '<script>';
            echo 'window.location.href = "../pages/transaction-staff.php";';
            echo '</script>';
            }
            else if ($type=="Administrator")
            {
            echo '<script>';
            echo 'window.location.href = "../pages/transaction.php";';
            echo '</script>';
            }
            else
            {
            echo '<script>';
            echo 'window.location.href="../../myhistory.php";';
            echo '</script>';
    
            }
        }
          else {
            echo '<script type="text/javascript">';
            echo 'alert("This Reservation has still reserve rooms . please Check out the Guest/s or Customer/s the transaction before Cancel the Reservation");';
            echo '</script>';
            if ($type=="Staff")
            {
            echo '<script>';
            echo 'window.location.href = "../pages/transaction-staff.php";';
            echo '</script>';
            }
            else if ($type=="Administrator")
            {
            echo '<script>';
            echo 'window.location.href = "../pages/transaction.php";';
            echo '</script>';
            }
            else
            {
            echo '<script>';
            echo 'window.location.href="../../myhistory.php";';
            echo '</script>';
        }
            mysqli_close($conn);
        }

}

?>