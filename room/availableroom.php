<!DOCTYPE html>
<?php 
session_start();
include('../../connection.php');
include("../../actions/session.php");
include('../../actions/admin/changepassword.php');
if (!isset($login_session)) {
    header("Location: ../../index.php");
} else {
    $user_check=$_SESSION['Customerid'];
    $sql = "SELECT * FROM tblusers WHERE Customer_ID = '$user_check'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
     $user=$row['Username'];
    if ($row['Type']=='User') {
        header("Location: ../../index.php");
    } else if ($row['Type']=='Administrator') {
        header("Location: index.php");
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
  <script  src="../js/selectroom.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--loading pic sa room-->

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
                   <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" data-toggle='modal' data-target='#adminprofile'><i class="fa fa-user fa-fw"></i> Super User Profile</a>
                        </li>
                        <li><a href="#" data-toggle='modal' data-target='#changepwd'><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <form method="POST" action="../../actions/logout.php">
                        <li class="divider"></li>
                        <li>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-sign-out fa-fw"></i><input style="background-color: transparent;border: transparent;" type="submit" name="logout" value="Logout">
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
                            <a href="../pages/index-staff.php" ><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                         <a href="../pages/transaction-staff.php" ><i class="fa fa-shopping-cart"></i>Transaction</a>
                        </li>
                        <li>
                         <a href="../room/availableroom.php" class="active" ><i class="fa fa-home"></i> Available Room</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Room</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!--Room Category Modal-->
   
            <!-- /.row -->


                <div class="col-lg-4">
                  <div class="form-group">
                    <label  style="color:#444;"><h3><i class=" " style="color:#444;"></i> From:</h3></label>
                        <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="start" id="sd" value="" maxlength="10" readonly />
                     </div> 
                  </div>
                     <div class="col-lg-4">
                     
                    <div class="form-group">
                        <label  style="color:#444;"><h3><i class="  " style="color:#444;"></i> To:</h3></label>
                            <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="end" id="ed" value="" maxlength="10" readonly />
                         </div> 
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Check for available Rooms
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow:auto">
                                <table class="table table-striped">

                                    <thead><tr>
                                    <th>RoomNumber</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Discount</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>QtyAdult</th>
                                    <th>QtyChild</th>
                                    <th>Promo Start</th>
                                    <th>Promo End</th>
                                    <th>Image</th>
                                    
                                    </tr></thead>
                                   
                                    <?php
                                    include("../../connection.php");
                                    $sql = "select tblrooms.Room_ID, tblcategories.CategoryName, tblrooms.Category_ID, 
                                    tblrooms.Rate,tblrooms.Discount, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Date_Start,tblrooms.Date_End,tblrooms.Image 
                                    FROM tblrooms INNER JOIN 
                                    tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID";

                                     $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));


                                    echo "<tbody id='viewroomavailable'>";
                                     while($row=mysqli_fetch_assoc($result)) {
                                    $arrival=date_create($row['Date_Start']);
                                    $departure=date_create($row['Date_End']);    
                                    echo"<tr><td>" .$row["Room_ID"]. "</td>
                                     <td> ".$row["CategoryName"]. "</td>
                                     <td> ".$row["Rate"]. "</td>
                                     <td> ".$row["Discount"]. "%</td>
                                     <td> ".$row["Description"]. "</td>
                                     <td> ".$row["Status"]. "</td>
                                     <td> ".$row["No_adult"]. "</td>
                                     <td> ".$row["No_child"]. "</td>";
                                     if ($row['Date_Start']==""  || $row['Date_Start']=="0000-00-00")
                                     {
                                        echo "<td>No set Promo</td>";
                                     }
                                     else
                                     {
                                      echo "<td> ".date_format($arrival,"Y/m/d"). "</td>";
                                       
                                     }
                                  if ($row['Date_End']=="" || $row['Date_Start']=="0000-00-00" )
                                     {
                                        echo "<td>No set Promo</td>";
                                     }
                                     else
                                     {
                                       
                                         echo "<td> ".date_format($departure,"Y/m/d"). "</td>";
                                       
                                     }

                                    echo "<td><a rel='facebox'><img id='imagelist' style='border: thin solid silver;float: left;padding: 5px;width: 70px;height: 70px;margin: 0 5px 0 0;' src=".$row['Image']. "></td>
                                     </tr>"; ?>
                                    <!-- delete room -->

                <div class="modal fade" id="deleteroom" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="deleteLabel">Note: This will be deleted permanently.</h4>
                            </div>
                            <div class="modal-body">
                                <center>Are you sure you want to delete the Room?</center>
                            </div>
                            <div class="modal-footer">
                            <?php  echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                <button type='button' data-dismiss='modal' id='delroomid' class='btn btn-primary'>Proceed</button>"; 
                                ?>
                            </div>
                        </div>
                                    <!-- /.modal-delete -->
                    </div>
                                <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="editroom" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="editLabel">Edit Room Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input value="<?php echo $row['Room_ID']; ?>" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Room Number" name="roomid" autofocus="" type="text" required>
                                    <?php 
                                    include("../../connection.php");
                                    $sqli = "SELECT * from tblcategories";
                                    $resulti = mysqli_query($conn,$sqli) or die(mysqli_error($conn));
                                    echo '<select class="form-control" name="categoryname" required>';
                                    while ($r = mysqli_fetch_assoc($resulti)) {
                                        echo "<option value='".$r['CategoryName']."'>".$r['CategoryName']."</option>"; }
                                    ?>
                                    </select>
                                    <input value="<?php echo $row['Rate']; ?>" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Rate" name="rate" autofocus="" type="text" required>
                                    <label>Description</label>
                                    <textarea name="descript" class="form-control" rows="3"><?php echo $row['Description']; ?></textarea>
                                    <select class="form-control" name="status" required>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                    </select>
                                    <input value="<?php echo $row['No_adult']; ?>" class="form-control" placeholder="Adult" onkeypress="return isNumberKey(event)" name="adult" autofocus="" type="text" required>
                                    <input value="<?php echo $row['No_child']; ?>" class="form-control" placeholder="Child" onkeypress="return isNumberKey(event)" name="child" autofocus="" type="text" required>
                                   <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" value="<?php echo $row['Date_Start']; ?>" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="start" id="sd" value="" maxlength="10" readonly />
                                   <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="start" id="sd" value="" maxlength="10" readonly />
                                    
                        
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                                <button type="button" name="addcategory" onclick="valideditAddon()" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                                    <!-- /.modal-content -->
                    </div>
                                <!-- /.modal-dialog --> 
                                
                </div> <?php } mysqli_close($conn); ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                </div>


                 <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="roomDetails" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">New Add Room</h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="Addroom.php"  method="post" enctype="multipart/form-data"  class="uploadform">
                            <fieldset>
                               
                                <div class="form-group">
                                    <input onkeypress="return isNumberKey(event)" class="form-control" placeholder="Room Number" name="roomid" autofocus="" type="text" required>
                                     <select class="form-control" name="categoryname" required>
                                        <?php
                                        include("../../connection.php");
                                        $sql="select CategoryName from tblcategories";
                                        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                                        while ($row1=mysqli_fetch_array($result)){ ?>
                                        <option><?php echo $row1['CategoryName']; ?> </option>
                                        <?php } ?>
                                </select>
                                    <input class="form-control" onkeypress="return isNumberKey(event)" placeholder="Rate" name="rate" autofocus="" type="text" required>
                                     <label>Description</label>
                                            <textarea name="descript" class="form-control" rows="3"></textarea>
                                    <select class="form-control" name="status" required>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                    <input class="form-control" placeholder="Adult" onkeypress="return isNumberKey(event)" name="adult" autofocus="" type="text" required>
                                     <input class="form-control" placeholder="Child" onkeypress="return isNumberKey(event)" name="child" autofocus="" type="text" required>
                                    <div class="form-group">
                                    <input name="image" type="file"/>
                                 </div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input value="Save" name="addroom" type="submit" id="submitbtn" class="btn  btn-primary btn-block">
                                 <input value="Cancel" data-dismiss="modal"  class="btn btn-default btn-block">
                                 
                            </fieldset>
                        </form>
                                        </div>
                                        <div class="modal-footer">
                                       
                                        </div>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>
            </div>
        </div>
         <!-- admin profile modal -->
                                            <div class="modal fade" id="adminprofile" tabindex="-1" role="dialog" aria-labelledby="roomDetails" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Super User Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <?php
                                        include("../../connection.php");
                                        $sql="select * from tblusers where Customer_ID='$user_check'";
                                        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                                        while ($row=mysqli_fetch_array($result)) { ?>
                                            <form role="form" method="POST" action="../../actions/edit-profile.php">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="id" type="hidden" value="<?php echo $row['Customer_ID']?>" class="form-control">
                                            <input name="fname" value="<?php echo $row['FirstName']?>" class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lname" value="<?php echo $row['LastName']?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input name="username" value="<?php echo $row['Username']?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input name="contact" value="<?php echo $row['Contact']?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input name="email" value="<?php echo $row['Email']?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input name="city" value="<?php echo $row['City']?>" class="form-control">
                                        </div>
                                        
                                        
                                    
                                       </div>

                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-2 pull-right">
                                         <input name="submit" type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                        <div class="col-md-2 pull-right">
                                         <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                        </form><?php } mysqli_close($conn);?>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- admin change password -->
                                            <div class="modal fade" id="changepwd" tabindex="-1" role="dialog" aria-labelledby="changepass" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Super User Change Password</h4>
                                        </div>
                                        <form action="" method="POST"> 
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                            <input class="form-control" value="<?php echo $user_check ?>" name="oid" type="hidden">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input name="oldpassword" type="password" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input name="newpassword" type="password" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Retype Password</label>
                                                <input name="retypepassword" type="password" class="form-control" required>
                                            </div>
                                       </div>

                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input name="save" type="submit" class="btn btn-primary" value="Change Password">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->
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
