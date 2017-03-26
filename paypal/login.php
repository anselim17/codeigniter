<!DOCTYPE html>
<?php
session_start();

$msg =  "";
if (isset($_POST['submit'])) {
    include('../connection.php');



    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $emaillower = strtolower($email);
    $hashedPW = hash('sha256', $password);
    $resultsql = "SELECT * FROM tblusers WHERE Email='$emaillower' And Password='$hashedPW'";
    $query = $conn->query($resultsql);
    if (empty($email)) {
        $msg =  "Invalid Email Address or Password!";
    }
    else if ($query->num_rows==1) {

    echo "<script>alert('Successfully To login PayPal')</script>";
    echo "<script>window.location='index.php';</script>";
                $_SESSION['email']=$emaillower;
        } else {
            $msg =  "Invalid Email Address or Password!";

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
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                    <div class="panel-heading">
                        <h3 class="panel-title">Confirmation Code</h3>
                        <p></p>
                        
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST">
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
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
                                <input name="submit" class="btn btn-lg btn-paypal btn-block" type="submit" value="Login"  style="margin-top:-25px;"/>

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
