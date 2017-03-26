<!DOCTYPE html>
<?php
session_start();
include('../../connection.php');
include("../../actions/session.php");
if (!isset($login_session)) {
    header("Location: ../../index.php");
} else {
    $user_check=$_SESSION['Customerid'];
    $sql = "SELECT * FROM tblusers WHERE Customer_ID = '$user_check'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['Type']!='Administrator') {
        header("Location: ../../index.php");
    }
}?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Westview Pension Houese | Admin Page - Manage Room</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS 
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">-->

    <!-- DataTables CSS 
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">-->

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="../dist/css/datepicker2.css" rel="stylesheet" type="text/css" /> 

     <script type="text/javascript" src="../js/datepicker.js"></script> 
    <script type="text/javascript" src="../js/datepicker1.js"></script>

    <!--modal modal-->
    <script src="../dist/js/jquery.js"></script>
    <!--search seacrh-->
    <script src="../dist/js/jquery-1.4.1.min.js"></script>
    <!--Modal sa room-->
    <script src="../dist/js/members.js"></script>
    <!--delete sa room-->
    <script src="../dist/js/confirmbox.js"></script>
    <!--auto fill-->
    <script  src="../dist/js/jquery-1.8.0.min.js"></script>


    <script  src="../dist/js/jquery.min.js"></script>

    <script  src="../dist/js/jquery.form.js"></script>

    <script src="../dist/src/facebox.js" ></script>
    <!--ajax-->
    <script  src="../dist/js/library.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--loading pic sa room-->
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '../dist/src/loading.gif',
        closeImage   : '../dist/src/closelabel.png'
      })
    })
  </script>

    <!--numeric only number-->
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

    <!--uplode -->
    <script>
    $(document).ready(function() {
    $('#myfile').change(function(){
    $('#path').val($(this).val());
      });
      });
    </script> 

    <style type="text/css">
      #facebox {
        position: absolute;
        border: thin solid silver;
        background-color: white;
        border-radius: 35px;
        padding-left: 50px;
        padding-top: 20px;
      }
  </style>
</head>
 <!--validate form-->
<script type="text/javascript" src="../js/validateform.js"></script>
<!--set difference-->
<script type="text/javascript" src="../js/setdiff.js"></script>
<body>

    <div style="background-color: rgb(44, 115, 231);" id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../pages/index.php"><span class="fa fa-cogs "></span> Westview Pension House - Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               <li class="dropdown">
                    <a href="../../index.php" target="_blank">
                        <i class="fa fa-share-square-o  fa-fw"></i> Visit website
                    </a>
                </li>
                  <li class="dropdown   ">
        <a aria-expanded="true" class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-star fa-fw"></i> 3 New Reservations
                        <span class="pull-right text-muted small">12 minutes ago</span>
                    </div>
                </a>
            </li>
        </ul></li>       
         <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Super User <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Super User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

                <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="../pages/index.php" ><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="../room/manageroom.php" class="active"><i class="fa fa-table fa-fw"></i> Manage Rooms</a>
                        </li>
                        <li>
                            <a href="../room/manageuser.php"><i class="fa fa-group fa-fw"></i> Manage Users</a>
                        </li>
                        <li>
                           <a href="../room/monthlyincome.php" ><i class="fa fa-calendar  fa-fw"></i> Monthly Income</a>
                        </li>
                         <li>
                            <a href="../room/comments.php"><i class="fa fa-envelope-o  fa-fw"></i> Comments</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Room </h1>
                </div>
                
        </div>
            
            <!--Room Category Modal-->
            <div class="row">

                <div class="col-lg-12">
                 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Current Room Details 
                        </div>
                            
                       
                         </div>

                           <div class="col-md-8">

                        <div class="form-group">
                            
                                    
                                    <?php 
                                    include("../../connection.php");
                                    $cid = mysqli_real_escape_string($conn, $_GET['cid']);
                                    $sql = "select tblrooms.Room_ID, tblcategories.CategoryName, tblrooms.Category_ID, 
                                    tblrooms.Rate,tblrooms.Discount, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Date_Start,tblrooms.Date_End,tblrooms.Image 
                                    FROM tblrooms INNER JOIN 
                                    tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID WHERE tblrooms.Room_ID = '$cid'";
                                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<input id='hiddenid' value='".$row['Room_ID']."' class='form-control' name='hiddenid' type='hidden' >
                                    <input id='rmid' value='".$row['Room_ID']."' onkeypress='return isNumberKey(event)' class='form-control' placeholder='Room Number' name='roomid' autofocus='' type='text' required>";
                                    $sqli = "SELECT CategoryName FROM tblcategories";
                                    $resulti = mysqli_query($conn,$sqli) or die(mysqli_error($conn));
                                    echo '<select id="ctyname" class="form-control" name="ctyname" required>';
                                    echo "<option value='".$row['CategoryName']."'>".$row['CategoryName']."</option>"; ?>
                                    </select>
                                    <input id="rate" value="<?php echo $row['Rate']; ?>" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Rate" name="rate" autofocus="" type="text" required>
                                    <label>Add Discount</label>
                                    <?php
                                   if ($row["Date_Start"]=='0000-00-00'||$row["Date_Start"]==null) { 
                                    $dis=0;
                                    $val = 'No Promo Set';
                                    } else { 
                                    $dis=$row["Discount"];
                                    $to = date_create($row["Date_Start"]);
                                    $from = date_create($row["Date_End"]);
                                    $Start = date_format($to, "d/m/Y");
                                    $End = date_format($from, "d/m/Y");
                                    }
                                    ?>
                                    <input id="discount" value="<?php echo "".$dis."";  ?>" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Discount" name="rate" autofocus="" type="text" required>
                                    <label>Description</label>
                                    <textarea id="descript" name="descript" class="form-control" rows="3"><?php echo $row['Description']; ?></textarea>
                                    <select id="status" class="form-control" name="status" required>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                    </select>
                                    <input id="adult" value="<?php echo $row['No_adult']; ?>" class="form-control" placeholder="Adult" onkeypress="return isNumberKey(event)" name="adult" autofocus="" type="text" required>
                                    <input id="child" value="<?php echo $row['No_child']; ?>" class="form-control" placeholder="Child" onkeypress="return isNumberKey(event)" name="child" autofocus="" type="text" required>
                                   <label>Add Promo Date</label>
                                        <input id="sd" style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" value="<?php echo "".$Start.""; ?>" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="start" id="sd" value="" maxlength="10" readonly placeholder="<?php echo "".$val.""; ?>" />
                                        <input id="ed" style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" value="<?php echo "".$End.""; ?>" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="end" id="ed" value="" maxlength="10" readonly placeholder="<?php echo "".$val.""; ?>" />
                                </div>
                                <div class="col-lg-6 col-lg-offset-7">
                                <div class="form-group">
                                <a href="manageroom.php" type="button" class="btn btn-default"  data-dismiss="modal">Cancel</a>
                                <button type="button" name="addcategory" onclick="validEditRoom()" class="btn btn-primary">Save</button>
                                </div>

                            </div>
                <!-- /.col-lg-12 -->
                      </div>
                      <div class="col-md-4">
                         <p>
                            <img class="img-responsive img-portfolio img-hover" src="<?php echo $row['Image']; ?>" alt="">
                        </p>
                        <label><?php echo $row['CategoryName']; ?></label>
                        </div>
                        
                        <!-- /.panel-heading -->
                   </div>
                   </div>   
            </div>
        </div>
        <?php }  mysqli_close($conn); ?>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    

</body>

</html>
