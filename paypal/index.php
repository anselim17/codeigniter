<!DOCTYPE html>
<?php
session_start();
 if (isset($_SESSION['email'])){ 
    $email=$_SESSION['email'];
    }
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>

    body {

        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="img/logo.PNG" style="width:250px;height:60px;"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="login.php"><u>Log Out</u></a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

         <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><!--
                    <div id="mc_embed_signup">
              <form role="form" action="" method="post" id="" name="" target="_blank" novalidate="">
                <div class="input-group input-group-lg">
                    <input type="" name="" class="form-control" id="" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="" id="" class="btn btn-default">Go!</button>
                    </span>
                </div>
                 </form>
                </div>-->
                <br>
                       <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">My Account</a>
                                </li><!--
                                <li><a href="#profile" data-toggle="tab">Profile</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">Messages</a>
                                </li>
                                <li><a href="#settings" data-toggle="tab">Settings</a>
                                </li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <?php
                                     include('../connection.php');
                                     $sql="select tblusers.FirstName,tblusers.LastName,tblpaypal.balance
                                           FROM tblusers INNER JOIN tblpaypal on tblusers.Customer_ID=tblpaypal.customer_id where tblusers.Email='".$email."'";
                                           $result=mysqli_query($conn,$sql);
                                           $row=mysqli_fetch_assoc($result);

                                           echo '<h4 style="color:orange">Welcome, '.ucfirst($row['FirstName']). ' ' .ucfirst($row['LastName']). '</h4>
                                    <p>Account Type: Premier Status: Unverified Get verifiedSending and Withdrawal Limits: View Limits</p>
                                    <h3>PayPal balance: '.number_format($row['balance'],2).' PHP</h3>';
                                 
                                           mysqli_close($conn);
                                    ?>


                                    <div class="col-lg-12">
                    <div class="panel panelnel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Name/Email</th>
                                            <th>Payment Status</th>
                                       
                                        
                                        </tr>
                                    </thead>
                                        <?php 
                                        include('../connection.php');
                                          $sql="select tblreservation.ReservationDate,tblreservation.Status,tblusers.FirstName,tblusers.LastName,tblusers.Email,tblpaypal.balance
                                           FROM tblreservation INNER JOIN tblusers on tblreservation.Customer_ID=tblusers.Customer_ID
                                           INNER JOIN tblpaypal on tblusers.Customer_ID=tblpaypal.customer_id where tblusers.Email='".$email."' AND tblreservation.transaction='Complete'";
                                            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['ReservationDate']?></td>
                                            <td>Reservation of Westview Pension House</td>
                                            <td>wesviewpenssionehotel@yahoo.com</td>
                                            <td>Completed</td>
                                            <?php } mysqli_close($conn);?>
                                     </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>  </div>
                              
                                <div class="tab-pane fade" id="profile">
                                    <h4>Profile Tab</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4>Messages Tab</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="settings">
                                    <h4>Settings Tab</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                      
                       
                    </div>
                </div>
            </div>
        </div>
    </header>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
