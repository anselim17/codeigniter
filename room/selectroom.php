<!DOCTYPE html>
<?php
session_start();
include('../../connection.php');
include('../../actions/select-action.php');
if (isset($_SESSION['Customerid'])) {
    $user_check=$_SESSION['Customerid'];
    $sql = "SELECT * FROM tblusers WHERE Customer_ID = '$user_check'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $login_session = $row['Customer_ID'];
    $verification = $row['Verification'];
} //end?>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Westview Pension House - Cebu</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../hotelpage/css/bootstrap.min.css" rel="stylesheet">
    <!--Icon-->
     <link href="../../hotelpage/images/westview.png" type="image/png" rel="icon">
    <!-- Custom CSS -->
    <link href="../../hotelpage/css/modern-business.css" rel="stylesheet">
    <link href="../../hotelpage/css/westview.css" rel="stylesheet">
    <link href="../../hotelpage/css/bootstrap-social/bootstrap-social.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <script type="text/javascript" src="../../hotelpage/js/main.js"></script>
    <link href="../../hotelpage/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- own style -->

<script src="../js/jquery-1.4.1.min.js"></script>
<script src="../js/register.js"></script>
<script src="../js/jquery.js"></script>
<script  src="../js/jquery-1.8.0.min.js"></script>

  <SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>


</head>

<body>
<?php
error_reporting(0);
session_start();

if (isset($_SESSION['Customerid'])) {
  if (isset($_POST['checkroom'])) {
    $from=$_POST['start'];
    $to=$_POST['end'];
    //$numberofdays = $_POST['numberofdays'];


    $d = new DateTime();
    $s = \DateTime::createFromFormat('d/m/Y', $from);
    $e = \DateTime::createFromFormat('d/m/Y', $to);
    $date = $d->format('Y-m-d');
    $arrival = $s->format('Y-m-d');
    $departure = $e->format('Y-m-d');
    $diff2= date_diff($s, $e);// compute xa old arrival ug CURRENT arrival
    $numberofdays = $diff2->d;
  } else {
    $from=$_SESSION['from'];
    $to=$_SESSION['to'];
    //$numberofdays = $_SESSION['numdays'];

    $d = new DateTime();
    $s = \DateTime::createFromFormat('d/m/Y', $from);
    $e = \DateTime::createFromFormat('d/m/Y', $to);
    $date = $d->format('Y-m-d');
    $arrival = $s->format('Y-m-d');
    $departure = $e->format('Y-m-d');
    $diff2= date_diff($s, $e);// compute xa old arrival ug CURRENT arrival
    $numberofdays = $diff2->d;
  }
} else if (isset($_SESSION['numdays'])) {
  $from=$_SESSION['from'];
  $to=$_SESSION['to'];
  //$numberofdays = $_SESSION['numdays'];

  $d = new DateTime();
  $s = \DateTime::createFromFormat('d/m/Y', $from);
  $e = \DateTime::createFromFormat('d/m/Y', $to);
  $date = $d->format('Y-m-d');
  $arrival = $s->format('Y-m-d');
  $departure = $e->format('Y-m-d');
  $diff2= date_diff($s, $e);// compute xa old arrival ug CURRENT arrival
  $numberofdays = $diff2->d;
} else {
  $from=$_POST['start'];
  $to=$_POST['end'];
  $from2=date_create($from);
  $to2=date_create($to);
  //$numberofdays = $_POST['numberofdays'];

  $d = new DateTime();
  $s = \DateTime::createFromFormat('d/m/Y', $from);
  $e = \DateTime::createFromFormat('d/m/Y', $to);
  $date = $d->format('Y-m-d');
  $arrival = $s->format('Y-m-d');
  $departure = $e->format('Y-m-d');
  $diff2= date_diff($s, $e);// compute xa old arrival ug CURRENT arrival
  $numberofdays = $diff2->d;
  //$from = DateTime::createFromFormat('d/m/Y', $this->Arrival)->format('Y-m-d');
  //$to = DateTime::createFromFormat('d/m/Y', $this->Departure)->format('Y-m-d');
}
?>
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
                <div class="nav-bar-head">
                <div class="head-logo">
                <div class=" logo">
                            <a href="index.php">
                                <a href="../../index.php" style="left:22px;top:36px;">
                                <img id="header-logo" src="../../hotelpage/images/westview.png">
                            </a>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
 
                     <li>
                        <h4 style="color:#fff">Westview Pension House - Cebu  <i class="fa fa-phone"> </i> (+64) 1234 567 890 </h4 >
                    </li>
       
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container" style="margin-top:65px;">

            <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                Select Rooms 

         <!-- /input-group -->   
                </h2>
                <ol class="breadcrumb">
                    <?php 
                        echo "<li style='font-weight:bold;'>Check In : <span id='dFrom'>" . $from . "</span></li>"; 
                        echo "<li style='font-weight:bold;'>Check Out : <span id='dTo'>" . $to . "</span></li>";
                        echo "<li style='font-weight:bold;'>Nights : <span id='numDays'>" . $numberofdays . "</span></li>";  
                    ?>
                    <li><a href="../../index.php">Change Date</a></li>
                </ol>
            </div>
        </div>
  


<?php
  include("../connection.php");
  include("../Class/Reservation.php");

/* $sql = "select  tblrooms.Room_ID,tblcategories.Category_ID, tblcategories.CategoryName, 
                tblrooms.Rate, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Image 
                 FROM tblrooms INNER JOIN 
                tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID";*/

$sql="select tblrooms.Room_ID, tblcategories.CategoryName, 
  tblrooms.Rate,tblrooms.Discount, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Date_Start,tblrooms.Date_End, tblrooms.Image 
  FROM tblrooms INNER JOIN 
  tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID  WHERE
  tblrooms.Room_ID NOT IN
  (select Room_ID from tblreservation WHERE tblreservation.Reservation_ID is null
  OR tblreservation.Departure > '$arrival' AND tblreservation.Arrival < '$departure' AND tblreservation.Status!='Cancelled' AND tblreservation.Status!='Check Out'
  Union
  select Room_ID from tblwalkins WHERE Customer_ID is null
  OR Departure >= '".$arrival."' AND Arrival <= '".$departure."') ORDER by tblrooms.Date_Start ASC";

     $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

while($row = mysqli_fetch_assoc($result))
{
if ($row['Status']=='Available' )
{

        
          echo "
                <div class='row' style='margin-top:10px;'>
            <div class='col-md-1 text-center'>
                <p><i class='fa fa-camera fa-4x'></i></p>
            </div>
           <div class='col-md-3'>
                <a href='#".$row['Room_ID']."".$row['No_child']."' class='portfolio-link' data-toggle='modal'>
                    <img  class='img-responsive img-hover'   src='../../adminpage/room/" .$row["Image"] . "' alt=''>
                </a>
            </div>
            <div class='col-md-5' style='margin-top:-20px;'>
                <h3>
                    Room Number: ".$row['Room_ID']."</a>
                </h3>
                <p >  ";
                 if (isset($_SESSION['Customerid'])) {
                 	if ($verification==1) {
                 		echo "<button value='".$row['Room_ID']."'  class='Reserve btn btn-promo4 btn-sm' />Reserve</button>";
                 	} else { echo "<button class='btn btn-promo4 btn-sm' disabled/>Please verify your account</button>"; }
                } else {
                    echo "<a href='#portfolioModal1' class='portfolio-link btn btn-promo4 btn-sm' data-toggle='modal' />Reserve</a>";
                }
            echo "<p><ul class='nav'>
                <li>Status : ".$row['Status']." Room</li>
                <li>Room Type : ".$row['CategoryName']."</li>
                <li>Room Rate : ".$row['Rate']."</li>
                <li>Room Description : ".$row['Description']."</li>
                <li>Max Child : ".$row['No_child']."</li>
                <li>Max Adult : ".$row['No_adult']."</li>";
                $promofrom = $row['Date_Start'];
                $promoto = $row['Date_End'];

                if ($arrival < $promoto && $departure > $promofrom  && $row['Discount']>0) {
                  echo "<li style='font-weight:bold'>Promo!</li>";
                  echo "<li>Discount : ".$row['Discount']."%</li>
                  <li>Promo Start : ".$row['Date_Start']."</li>
                  <li>Promo End : ".$row['Date_End']."</li>";
                }
                echo "</ul></p>
            </div>
        </div>
        

        <hr>";
      }
        else
        {
          echo "error";
        }

        $_SESSION["arrival"]=$arrival;
        $_SESSION["departure"]=$departure;
        $_SESSION["numberofdays"]=$numberofdays;

         $room_id=$row['Room_ID'];
          $categoryname=$row['CategoryName'];
          $adult=$row['No_adult'];
          $child=$row['No_child'];
          $rate=$row['Rate'];
           $_SESSION["date"] = array("arrival" => $arrival,
          "departure" => $departure,
           "numberofdays" => $numberofdays 


    );

         

          $payable=  $rate * $numberofdays; 
          $total=number_format($payable);
         $_SESSION["total"] =$total;
  mysqli_close($conn);
      }
 ?>    
            <div class='portfolio-no-modal modal fade'  tabindex='-1' role='dialog' aria-hidden='true'>
            <div class="modal-dialog">
                                    <div cslass="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel" style="color:#337AB7;"><?php echo "Room Number: ".$row['Room_ID'];?></h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="panel-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="<?php echo $row['Room_ID'].'-details';?>">
                                    <p>Expect such amenities and services with your stay: </p>
                                    <p><ul class="list-bullet">
                                    Description : 
                                    <li><?php echo $row['Description'];?></li>
                                    </ul></p>
                                   <!-- <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>-->
                                <hr>
                                </div>
                                <div class="tab-pane fade" id="<?php echo $row['Room_ID'].'IMG';?>">
                                
                                <img class="img-responsive " src="<?php echo $row["Image"];?>" alt="">
    
                                <hr>  
          
                                </div>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#<?php echo $row['Room_ID'].'-details';?>" data-toggle="tab"><i class="fa fa-align-left"></i> Details</a>
                                </li>
                                <li><a href="#<?php echo $row['Room_ID'].'IMG';?>" data-toggle="tab"><i class="fa fa-camera"></i> Images</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                                        </div>
                        
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
        <div class="room-modal modal fade" id="<?php echo $row['Room_ID'].''.$row['No_child'];?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div style="background-image: url(&quot;<?php echo $row["Image"] . '';?>&quot;); background-size: 100% 100%; background-repeat: no-repeat;" class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            
        </div>
    </div>

<!-- addons model -->
        
                                
                                <div class="modal fade" id="moreinfo" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="deleteLabel">Note: This will be deleted permanently.</h4>
                                        </div>
                                        <div class="modal-body">
                                        <center>
                                            Are you sure you want to proceed?
                                        </center>
                                        </div>
                                        <div class="modal-footer">
                                          <button id='delreserve' type='button'  class='btn btn-primary' data-dismiss='modal'>Okey</button>"
                                        </div>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>

<div style="display: none; padding-right: 17px;" class="ReserveForm"  aria-labelledby="myModalLabel" aria-hidden="false">
  <div style="height: 100%;z-index:9999;position:fixed" class="modal-backdrop fade in"></div>
  <div class="modal-dialog" style="position:fixed;top:0px;bottom:0px;left:0px;right:0px;z-index:9999">
 <div class="modal-content" style="z-index:9999">
<div class="modal-header">
<a href="#" class="close" style="margin-top:-10px">X</a>
</div>
<form action="../CustomerReservation/Reserve.php" method="post" style="padding:0 40px">
<h3>Room Details</h3></center><div id="image_preview"><img src="../dist/src/no-image.jpg" style="height:115; width=175" ></div>

<div id="detailroom">
</div>
<div id="searchroomid">
</div>
</form>
</div>
</div>
</div>
  
</div>

    <!--Modal Login-->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="../../hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);; color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Sign In to continue</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><div class="circle-mask"> <canvas id="canvas" class="circle" width="96" height="96"></canvas></div></span>
                                    <?php echo "<input name='from' type='hidden' value='".$from."'>";
                                          echo "<input name='to' type='hidden' value='".$to."'>";
                                          echo "<input name='numdays' type='hidden' value='".$numberofdays."'>";
                                    ?>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
                                </div>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" value="" type="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <a class="portfolio-link" data-toggle="modal" href="#forgotpassword">Forgot Password</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn  btn-promo2 btn-block" name="submit" type="submit" value="Sign In" />
                                <a href="#registrationForm" data-toggle="modal" class="btn  btn-default btn-block">Create account</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Forgot Password-->
    <div class="portfolio-modal modal fade" id="forgotpassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="../../hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);; color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Forgot Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="../../actions/forgotpassword.php">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email Address" name="emailaddress" value="" type="email">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn  btn-promo2 btn-block" name="submit" type="submit" value="Submit" />
                                <a href="?" data-dismiss="modal" class="btn btn-default btn-block">Cancel</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Create Account modal-->
    <div class="portfolio-modal modal fade" id="registrationForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="../../hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-color: rgb(51, 122, 183); color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Create Account</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="../../actions/regredirect.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" placeholder="Name" name="fname" autofocus="" type="text" required>
                                    <input class="form-control" placeholder="Lastname" name="lname" autofocus="" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" value="" type="text" required>
                                    <input id="pass" class="form-control" placeholder="Password" name="password" type="password" required>
                                    <input id="repass" class="form-control" placeholder="Retype Password" name="retypepassword" type="password" required>
                                    <i id="check" class="fa" ></i><b id="validate-status"></b>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone" autofocus="" type="text" required>
                                    <input class="form-control" placeholder="Email Address" name="email" autofocus="" type="email" required>
                                    Gender: <input name="gender" value="Male" autofocus="" type="radio" required> Male
                                    <input name="gender" value="Female" autofocus="" type="radio"> Female
                                    <select class="form-control" name="country" required>
                                        <option value="-1" selected="">Select...</option>
                                        <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
                                        <option value="Albania" title="Albania">Albania</option>
                                        <option value="Algeria" title="Algeria">Algeria</option>
                                        <option value="American Samoa" title="American Samoa">American Samoa</option>
                                        <option value="Andorra" title="Andorra">Andorra</option>
                                        <option value="Angola" title="Angola">Angola</option>
                                        <option value="Anguilla" title="Anguilla">Anguilla</option>
                                        <option value="Antarctica" title="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina" title="Argentina">Argentina</option>
                                        <option value="Armenia" title="Armenia">Armenia</option>
                                        <option value="Aruba" title="Aruba">Aruba</option>
                                        <option value="Australia" title="Australia">Australia</option>
                                        <option value="Austria" title="Austria">Austria</option>
                                        <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas" title="Bahamas">Bahamas</option>
                                        <option value="Bahrain" title="Bahrain">Bahrain</option>
                                        <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
                                        <option value="Barbados" title="Barbados">Barbados</option>
                                        <option value="Belarus" title="Belarus">Belarus</option>
                                        <option value="Belgium" title="Belgium">Belgium</option>
                                        <option value="Belize" title="Belize">Belize</option>
                                        <option value="Benin" title="Benin">Benin</option>
                                        <option value="Bermuda" title="Bermuda">Bermuda</option>
                                        <option value="Bhutan" title="Bhutan">Bhutan</option>
                                        <option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                                        <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana" title="Botswana">Botswana</option>
                                        <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil" title="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi" title="Burundi">Burundi</option>
                                        <option value="Cambodia" title="Cambodia">Cambodia</option>
                                        <option value="Cameroon" title="Cameroon">Cameroon</option>
                                        <option value="Canada" title="Canada">Canada</option>
                                        <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
                                        <option value="Chad" title="Chad">Chad</option>
                                        <option value="Chile" title="Chile">Chile</option>
                                        <option value="China" title="China">China</option>
                                        <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia" title="Colombia">Colombia</option>
                                        <option value="Comoros" title="Comoros">Comoros</option>
                                        <option value="Congo" title="Congo">Congo</option>
                                        <option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
                                        <option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
                                        <option value="Croatia" title="Croatia">Croatia</option>
                                        <option value="Cuba" title="Cuba">Cuba</option>
                                        <option value="Curaçao" title="Curaçao">Curaçao</option>
                                        <option value="Cyprus" title="Cyprus">Cyprus</option>
                                        <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
                                        <option value="Denmark" title="Denmark">Denmark</option>
                                        <option value="Djibouti" title="Djibouti">Djibouti</option>
                                        <option value="Dominica" title="Dominica">Dominica</option>
                                        <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador" title="Ecuador">Ecuador</option>
                                        <option value="Egypt" title="Egypt">Egypt</option>
                                        <option value="El Salvador" title="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea" title="Eritrea">Eritrea</option>
                                        <option value="Estonia" title="Estonia">Estonia</option>
                                        <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji" title="Fiji">Fiji</option>
                                        <option value="Finland" title="Finland">Finland</option>
                                        <option value="France" title="France">France</option>
                                        <option value="French Guiana" title="French Guiana">French Guiana</option>
                                        <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon" title="Gabon">Gabon</option>
                                        <option value="Gambia" title="Gambia">Gambia</option>
                                        <option value="Georgia" title="Georgia">Georgia</option>
                                        <option value="Germany" title="Germany">Germany</option>
                                        <option value="Ghana" title="Ghana">Ghana</option>
                                        <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
                                        <option value="Greece" title="Greece">Greece</option>
                                        <option value="Greenland" title="Greenland">Greenland</option>
                                        <option value="Grenada" title="Grenada">Grenada</option>
                                        <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam" title="Guam">Guam</option>
                                        <option value="Guatemala" title="Guatemala">Guatemala</option>
                                        <option value="Guernsey" title="Guernsey">Guernsey</option>
                                        <option value="Guinea" title="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana" title="Guyana">Guyana</option>
                                        <option value="Haiti" title="Haiti">Haiti</option>
                                        <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                        <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras" title="Honduras">Honduras</option>
                                        <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
                                        <option value="Hungary" title="Hungary">Hungary</option>
                                        <option value="Iceland" title="Iceland">Iceland</option>
                                        <option value="India" title="India">India</option>
                                        <option value="Indonesia" title="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq" title="Iraq">Iraq</option>
                                        <option value="Ireland" title="Ireland">Ireland</option>
                                        <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
                                        <option value="Israel" title="Israel">Israel</option>
                                        <option value="Italy" title="Italy">Italy</option>
                                        <option value="Jamaica" title="Jamaica">Jamaica</option>
                                        <option value="Japan" title="Japan">Japan</option>
                                        <option value="Jersey" title="Jersey">Jersey</option>
                                        <option value="Jordan" title="Jordan">Jordan</option>
                                        <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya" title="Kenya">Kenya</option>
                                        <option value="Kiribati" title="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait" title="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia" title="Latvia">Latvia</option>
                                        <option value="Lebanon" title="Lebanon">Lebanon</option>
                                        <option value="Lesotho" title="Lesotho">Lesotho</option>
                                        <option value="Liberia" title="Liberia">Liberia</option>
                                        <option value="Libya" title="Libya">Libya</option>
                                        <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania" title="Lithuania">Lithuania</option>
                                        <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
                                        <option value="Macao" title="Macao">Macao</option>
                                        <option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                                        <option value="Madagascar" title="Madagascar">Madagascar</option>
                                        <option value="Malawi" title="Malawi">Malawi</option>
                                        <option value="Malaysia" title="Malaysia">Malaysia</option>
                                        <option value="Maldives" title="Maldives">Maldives</option>
                                        <option value="Mali" title="Mali">Mali</option>
                                        <option value="Malta" title="Malta">Malta</option>
                                        <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique" title="Martinique">Martinique</option>
                                        <option value="Mauritania" title="Mauritania">Mauritania</option>
                                        <option value="Mauritius" title="Mauritius">Mauritius</option>
                                        <option value="Mayotte" title="Mayotte">Mayotte</option>
                                        <option value="Mex?co" title="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco" title="Monaco">Monaco</option>
                                        <option value="Mongolia" title="Mongolia">Mongolia</option>
                                        <option value="Montenegro" title="Montenegro">Montenegro</option>
                                        <option value="Montserrat" title="Montserrat">Montserrat</option>
                                        <option value="Morocco" title="Morocco">Morocco</option>
                                        <option value="Mozambique" title="Mozambique">Mozambique</option>
                                        <option value="Myanmar" title="Myanmar">Myanmar</option>
                                        <option value="Namibia" title="Namibia">Namibia</option>
                                        <option value="Nauru" title="Nauru">Nauru</option>
                                        <option value="Nepal" title="Nepal">Nepal</option>
                                        <option value="Netherlands" title="Netherlands">Netherlands</option>
                                        <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand" title="New Zealand">New Zealand</option>
                                        <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
                                        <option value="Niger" title="Niger">Niger</option>
                                        <option value="Nigeria" title="Nigeria">Nigeria</option>
                                        <option value="Niue" title="Niue">Niue</option>
                                        <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway" title="Norway">Norway</option>
                                        <option value="Oman" title="Oman">Oman</option>
                                        <option value="Pakistan" title="Pakistan">Pakistan</option>
                                        <option value="Palau" title="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama" title="Panama">Panama</option>
                                        <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay" title="Paraguay">Paraguay</option>
                                        <option value="Peru" title="Peru">Peru</option>
                                        <option value="Philippines" title="Philippines">Philippines</option>
                                        <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
                                        <option value="Poland" title="Poland">Poland</option>
                                        <option value="Portugal" title="Portugal">Portugal</option>
                                        <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar" title="Qatar">Qatar</option>
                                        <option value="Réunion" title="Réunion">Réunion</option>
                                        <option value="Romania" title="Romania">Romania</option>
                                        <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda" title="Rwanda">Rwanda</option>
                                        <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
                                        <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
                                        <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa" title="Samoa">Samoa</option>
                                        <option value="San Marino" title="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal" title="Senegal">Senegal</option>
                                        <option value="Serbia" title="Serbia">Serbia</option>
                                        <option value="Seychelles" title="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore" title="Singapore">Singapore</option>
                                        <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                        <option value="Slovakia" title="Slovakia">Slovakia</option>
                                        <option value="Slovenia" title="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia" title="Somalia">Somalia</option>
                                        <option value="South Africa" title="South Africa">South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                        <option value="South Sudan" title="South Sudan">South Sudan</option>
                                        <option value="Spain" title="Spain">Spain</option>
                                        <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan" title="Sudan">Sudan</option>
                                        <option value="Suriname" title="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland" title="Swaziland">Swaziland</option>
                                        <option value="Sweden" title="Sweden">Sweden</option>
                                        <option value="Switzerland" title="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand" title="Thailand">Thailand</option>
                                        <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo" title="Togo">Togo</option>
                                        <option value="Tokelau" title="Tokelau">Tokelau</option>
                                        <option value="Tonga" title="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia" title="Tunisia">Tunisia</option>
                                        <option value="Turkey" title="Turkey">Turkey</option>
                                        <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
                                        <option value="Uganda" title="Uganda">Uganda</option>
                                        <option value="Ukraine" title="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
                                        <option value="United States" title="United States">United States</option>
                                        <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay" title="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                                        <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
                                        <option value="Yemen" title="Yemen">Yemen</option>
                                        <option value="Zambia" title="Zambia">Zambia</option>
                                        <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <input class="form-control" placeholder="City/State" name="city" autofocus="" type="text" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input value="Create an Account" name="submit" type="submit" class="btn  btn-primary btn-block">
                                 <input value="Cancel" data-dismiss="modal"  class="btn btn-default btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="container">

      <footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>Copyright 2015 by Westview Pensione House. All Rights Reserved.</p>

                </div>
            </div>
        </footer>
</div>
   <script src="../../hotelpage/js/jquery.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
     <script src="../../hotelpage/js/bootstrap.min.js"></script>

    <script src="../js/selectroom.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".close").click(function(e){
        $(".ReserveForm").fadeOut("slow");
      });
    });
    $(document).ready(function() {
      $(".Reserve").click(function(e){
        $(".close").fadeIn("slow");
      });
    });
    </script>
</body>
</html>

