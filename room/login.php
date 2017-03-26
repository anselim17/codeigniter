<!DOCTYPE html>
<?php
session_start();
$customerid=$_SESSION['Customerid'];
$confirmation=$_SESSION['Confirmation'];


$msg =  "";
if (isset($_POST['submit'])) {
    include('../../connection.php');


        $sql = "select tblpaypal.balance,tblreservation.Payable,tblreservation.Reservation_ID
        FROM tblreservation INNER JOIN tblusers ON tblreservation.Customer_ID=tblusers.Customer_ID
        INNER JOIN tblpaypal ON tblreservation.Customer_ID=tblpaypal.customer_id
        WHERE  tblreservation.Customer_ID= '".$_SESSION['Customerid']."' AND tblreservation.Confirmation='".$confirmation."'"; 

            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            $row= mysqli_fetch_assoc($result);
            $amount=$row['Payable'];
            $paypalbalance=$row['balance'];
            $total=$paypalbalance -abs($amount);
            $reservationid=$row['Reservation_ID'];

    $email = $_POST['email'];
    $emaillower = strtolower($email);
    $resultsql = "SELECT * FROM tblusers WHERE Email='$emaillower' AND Customer_ID='$customerid'";
    $query = $conn->query($resultsql);
    if (empty($email)) {
        $msg =  "Please Enter Your Email Address!";
    }
    else if ($paypalbalance <= $amount ){
         echo "<script>alert('your balance is not enought to pay to amount, Please Contact the Owner of this Hotel For process your reservation right now ')</script>";
         echo "<script>window.location='../room/login.php';</script>";}
    else if ($query->num_rows==1) {

    $sql2="update tblpaypal set balance='".$total."' where Customer_ID='".$customerid."'";  //update reservation to confirmation
    $sql3="update tblreservation set Status='Confirmed', transaction='Complete' where Customer_ID='".$customerid."' AND Confirmation='".$confirmation."'";
    $sql4="update tblreservationnotify set Unread=1 where Confirmation='".$confirmation."'";
    $sql5="update tbltransaction set Status='Confirmed' where Reservation_ID='".$reservationid."' ";
    $result=mysqli_query($conn,$sql2);
    $result=mysqli_query($conn,$sql4);
    $result=mysqli_query($conn,$sql3);
    $result=mysqli_query($conn,$sql5);
    $to       = $emaillower;
    $subject  = "Thank's for login your paypal account";
    $url= 'http://westviewpensione.esy.es/paypal/login.php';
    $message  = 'Hi, you just received an email from Paypal by Westview Pension House !' . "</br>" .
                '<a rel="nofollow" href="'.$url.'";>Click For Login your Account Paypal</a></br>';
    $message .= '<p>If the link doesnt work, just copy the link below.</p>';
    $message .= '<p>http://westviewpensione.esy.es/paypal/login.php</p>';
    $headers  = 'From: westviewpension.com' . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset=utf-8';
    if (mail($to, $subject, $message, $headers)) {
                echo '<script type="text/javascript">';
                echo 'alert("Successfully Reserve with PayPal");';
                echo 'window.location.href = "completepaypal.php";';
                echo '</script>';
            } else {
                die('Failure: Email was not sent!');
                echo 'window.location.href = "../index.php";';
            }
        } else {
            $msg =  "Invalid your Email Address!";
        }
    }

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pay with a debit or credit card</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color:#fff;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default"><center><h5 style="color:rgb(255, 54, 0);">Choose a way to pay</h5></center>
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color:rgb(19, 81, 152);">Pay with PayPal account </h3>
                        <p><small><small>Log in to your PayPal account to complete the purchase</small></small></p>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST">
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                    
                                </div>
                                <label>
                                    <p style="color:red"><?php echo $msg; ?></p>
                                </label>
                                <!-- Change this to a button or input when using this as a form -->
                                <input name="submit" class="btn btn-lg btn-paypal btn-block" type="submit" value="Continue" />
                                <a href="../CustomerReservation/Payment.php" class="btn btn-lg btn-default btn-block">Cancel</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

