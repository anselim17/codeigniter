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
    if ($row['Type']=='User') {
        header("Location: ../../index.php");
    } else if ($row['Type']=='Staff') {
        header("Location: ../pages/index-staff.php");
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

    <title>Westview Pension House - Admin | Manage User</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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
              <!--  <li class="dropdown open">
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
           
            </li>-->

        
                    <!-- /.dropdown-messages -->
                
                <!-- /.dropdown -->
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" data-toggle='modal' data-target='#adminprofile'><i class="fa fa-user fa-fw"></i> Super User Profile</a>
                        </li>
                        <li><a href="#"><a href="#" data-toggle='modal' data-target='#changepwd'><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <form method="POST" action="../../actions/logout.php">
                        <li class="divider"></li>
                        <li>&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-sign-out fa-fw"></i><input style="background-color: transparent;border: transparent;" type="submit" name="logout" value="Logout">
                        </li>
                        </form>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="../pages/index.php" ><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                         <a href="../pages/transaction.php" ><i class="fa fa-shopping-cart"></i>Transaction</a>
                        </li>
                        <li>
                            <a href="../room/manageroom.php"><i class="fa fa-table fa-fw"></i> Manage Rooms</a>
                        </li>
                        <li>
                            <a href="../room/manageuser.php" class="active"><i class="fa fa-group fa-fw"></i> Manage Users</a>
                        </li>
                        <li>
                            <a href="../pages/historypayment.php" ><i class="fa fa-calendar  fa-fw"></i>History of Payment</a>
                        </li>
                         <li>
                            <a href="../room/comments.php"><i class="fa fa-envelope-o  fa-fw"></i> Comments</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-13">
                    <h1 class="page-header"><i class="fa fa-group fa-fw"> </i> Manage Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Guest Registered
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper" style="overflow:auto">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <th>Gender</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Verification</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $selsql = "SELECT * FROM tblusers";
                                    $dresult = $conn->query($selsql);
                                    if ($dresult->num_rows>0) {
                                        while ($r = $dresult->fetch_assoc()) {
                                            if ($r['Type']=='User') {
                                                echo "<tr>";
                                                echo "<td>".$r['FirstName']."</td>";
                                                echo "<td>".$r['LastName']."</td>";
                                                echo "<td>".$r['Username']."</td>";
                                                echo "<td>".$r['Contact']."</td>";
                                                echo "<td>".$r['Email']."</td>";
                                                echo "<td>".$r['Gender']."</td>";
                                                echo "<td>".$r['Type']."</td>";
                                                echo "<td>".$r['Active']."</td>";
                                                if($r['Verification']==1){
                                                    echo "<td>Verified</td>";
                                                } else {
                                                    echo "<td>Not Verified</td>";
                                                }
                                                if ($r['Active']=="Activate") {
                                                    echo "<td><a href='../../actions/edit-action.php?id=".$r['Customer_ID']."' class='btn btn-danger btm-sm'> Deactivate</a></td>";
                                                } else {
                                                    echo "<td><a href='../../actions/edit-action.php?id=".$r['Customer_ID']."' class='btn btn-primary btm-sm'> Activate</a></td>";
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>
        
        <!-- /#page-wrapper -->
         <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Staff Registered / <a href="#" style="color:#23527C;" data-toggle="modal" data-target="#addnewA"> Add New Account </a>
                        </div>
                        <div class="modal fade" id="addnewA" tabindex="-1" role="dialog" aria-labelledby="newaccountL" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="newaccountL">Add new account</h4>
                                        </div>
                                        <div class=" panel panel-default">
                    
                    <div class="panel-body">
                        <form action="../../actions/admin/regredirect.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" placeholder="Name" name="fname" autofocus="" type="text" required>
                                    <input class="form-control" placeholder="Lastname" name="lname" autofocus="" type="text" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="type" required>
                                        <option value="Staff">Staff</option>
                                        <option value="Administrator">Administrator</option>
                                    </select>
                                    <input class="form-control" placeholder="Username" name="username" value="" type="text" required>
                                    <input id="pass" class="form-control" placeholder="Password" name="password" type="password" required>
                                    <input id="repass" class="form-control" placeholder="Retype Password" name="retypepassword" type="password" required>
                                    <i id="check" class="fa" ></i><b id="validate-status"></b>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone" autofocus="" type="text" required>
                                    <input class="form-control" placeholder="Email Address" name="email" autofocus="" type="email" required>
                                    <center> Gender: <input name="gender" value="Male" autofocus="" type="radio" required> Male
                                    <input name="gender" value="Female" autofocus="" type="radio"> Female</center>
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
                                <input value="Create an Account" name="register" type="submit" class="btn btn-lg btn-primary btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                
                                </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
    
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <th>Gender</th>
                                            <th>City</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $selsql = "SELECT * FROM tblusers";
                                    $dresult = $conn->query($selsql);
                                    if ($dresult->num_rows>0) {
                                        while ($r = $dresult->fetch_assoc()) {
                                            if ($r['Type']!='User') {
                                                echo "<tr>";
                                                echo "<td>".$r['FirstName']."</td>";
                                                echo "<td>".$r['LastName']."</td>";
                                                echo "<td>".$r['Username']."</td>";
                                                echo "<td>".$r['Contact']."</td>";
                                                echo "<td>".$r['Email']."</td>";
                                                echo "<td>".$r['Gender']."</td>";
                                                echo "<td>".$r['City']."</td>";
                                                echo "<td>".$r['Type']."</td>";
                                                echo "<td>".$r['Active']."</td>";
                        
                                                if ($r['Active']=="Activate") {
                                                    echo "<td><a href='#' onClick='deleteme(".$r['Customer_ID'].");' class='btn btn-danger btm-sm' data-toggle='modal' data-target='#deleteU'><i class='fa fa-close'> </i> </a></td>";
                                                } else {
                                                    echo "<td><a href='#' onClick='deleteme(".$r['Customer_ID'].");' class='btn btn-danger btm-sm' data-toggle='modal' data-target='#activeU'><i class='fa fa-close'> </i> </a></td>";
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    ?>
                        
                                        <div class="modal fade" id="deleteU" tabindex="-1" role="dialog" aria-labelledby="deleteUser" aria-hidden="true">
                                         <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="deleteUser">Note: This will be deactivate the account permanently.</h4>
                                        </div>
                                        <div class="modal-body">
                                        <center>
                                            Are you sure you want to deactivate the account?
                                        </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <a href="#" id="deleteme" class="btn btn-primary">Proceed</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-delete -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                          </div>

                                        <div class="modal fade" id="activeU" tabindex="-1" role="dialog" aria-labelledby="deleteUser" aria-hidden="true">
                                         <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="deleteUser">Note: This will be Activate your account.</h4>
                                        </div>
                                        <div class="modal-body">
                                        <center>
                                            Are you sure you want to activate the account?
                                        </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <a href="#" id="activeme" class="btn btn-primary">Proceed</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-delete -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                          </div>
                                          
                                          <div class="modal fade" id="editU" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
                                         <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="editUser">Edit User</h4>
                                        </div>
                                        <div class="panel-body">
                        <form role="form" action="actions/regredirect.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" placeholder="Name" name="fname" autofocus="" type="text" required="">
                                    <input class="form-control" placeholder="Lastname" name="lname" autofocus="" type="text" required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" value="" type="text" required="">
                                    <input id="pass" class="form-control" placeholder="Password" name="password" type="password" required="">
                                    <input id="repass" class="form-control" placeholder="Retype Password" name="retypepassword" type="password" required="">
                                    <i id="check" class="fa"></i><b id="validate-status"></b>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone" autofocus="" type="text" required="">
                                    <input class="form-control" placeholder="Email Address" name="email" autofocus="" type="email" required="">
                                    Gender: <input name="gender" value="Male" autofocus="" type="radio" required=""> Male
                                    <input name="gender" value="Female" autofocus="" type="radio"> Female
                                    <select class="form-control" name="country" required="">
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
                                        <option value="Zimbabwe" title="Zimbabwe">Zimbabwe
                                    </option></select>
                                    <input class="form-control" placeholder="City/State" name="city" autofocus="" type="text" required="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input value="Save" name="submit" type="submit" class="btn btn-lg btn-primary btn-block">
                            </fieldset>
                        </form>
                    </div>
                                                    </div>
                                                    <!-- /.modal-delete -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                                
                                          </div>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        
            </div>
                        <!-- /.panel-body -->
                   
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
                                </div></div>
                                
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script type="text/javascript">
        function deleteme(id){
            $("#deleteme, #activeme").click(function(e){
            window.location='../../actions/edit-action.php?id='+ id;
        });
    }
    </script>

</body>

</html>
