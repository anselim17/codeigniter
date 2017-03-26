<!DOCTYPE html>
<?php 
session_start();
include('../../connection.php');
if (!isset($_SESSION['Confirmation'])) {
    header("Location: ../../index.php");
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
            <div class="col-md-9 col-md-offset-2">

                <div class="login-panel panel panel-info"><center><h5 style="color:rgb(255, 54, 0);">Choose a way to pay</h5></center>
                    <div class="panel-heading">
                    <center>
                        <h2 class="panel-title" style="color:rgb(19, 81, 152);">Create a PayPal account</h2>
                        <p><small><small>And pay with your debit or credit card</small></small></p>
                    </center>
                    </div>
                   
                    <div class="panel-body">
                    <div class="col-md-12">
                    <div class="col-md-8 col-md-offset-2">
                        
                        <h1 class="page-header">Transaction Complete! You've just made a payment <small><a href="../../index.php" style="color:orange">Go back</a></small></h1>       
                    </div>
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
