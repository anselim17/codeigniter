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
    $user=$row['Username'];
    $type=$row['Type'];
    if ($row['Type']=='User') {
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
                <a class="navbar-brand" href="../pages/index.php"><span class="fa fa-cogs "></span> Westview Pension House - <?php echo $user; ?></a>
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
                    <h1 class="page-header">Room Transfer</h1>
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
                                    $rid = mysqli_real_escape_string($conn, $_GET['rid']);
                                    $sql = "select * from tblreservation WHERE Reservation_ID='$rid'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $_SESSION['Reservation_ID']=$rid;
                                    $_SESSION['type']=$type;
                                    $_SESSION['user']=$user;
                                    ?>

                         <div class="col-lg-4">
                         <div class="form-group">
                         <label  style="color:#444;"><h3><i class=" " style="color:#444;"></i> Check In Date:</h3></label>
                         <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="start" id="sd"  placeholder="<?php echo $row['Arrival'];?>" maxlength="10" readonly />
                     </div> 
                  </div>
                         <div class="col-lg-4">
                         <div class="form-group">
                            <label  style="color:#444;"><h3><i class="  " style="color:#444;"></i> Check Out Date:</h3></label>
                            <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="end" id="ed" placeholder="<?php echo $row['Departure'];?>" maxlength="10" readonly />
                         </div> 
                        </div>
                    </div>
                </div>
                                    <?php mysqli_close($conn); ?>
  
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Available for Rooms
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow:auto">
                                <table class="table table-striped">

                                    <thead><tr>
                                    <th>RoomNumber</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>QtyAdult</th>
                                    <th>QtyChild</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                    </tr></thead>
                                   <tbody id='selectroomdetail'>
                                   </tbody>
                               </table>
                   </div>
                   </div>   
            </div>
        </div>

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

    <script type="text/javascript">
    $(document).on("click", ".transferroom", function(e){
        e.preventDefault();
        var roomid= $(this).data('roomid');
        dataEdit = 'roomid='+roomid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url:'../CustomerReservation/loadroomdetail.php',
            success:function(data) {
              $(".modal-body").html(data);             
            }
          });

    });
</script>
    

</body>

</html>
