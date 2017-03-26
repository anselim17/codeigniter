<?php
session_start();
include("connection.php");
extract($_POST);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript">

var mins
var secs;

function cd() {
 	mins = 1 * m("1"); // change minutes here
 	secs = 0 + s(":01"); 
 	redo();
}

function m(obj) {
 	for(var i = 0; i < obj.length; i++) {
  		if(obj.substring(i, i + 1) == ":")
  		break;
 	}
 	return(obj.substring(0, i));
}

function s(obj) {
 	for(var i = 0; i < obj.length; i++) {
  		if(obj.substring(i, i + 1) == ":")
  		break;
 	}
 	return(obj.substring(i + 1, obj.length));
}

function dis(mins,secs) {
 	var disp;
 	if(mins <= 9) {
  		disp = " 0";
 	} else {
  		disp = " ";
 	}
 	disp += mins + " .";
 	if(secs <= 9) {
  		disp += "0" + secs;
 	} else {
  		disp += secs;
 	}
 	return(disp);
}

function redo() {
 	secs--;
 	if(secs == -1) {
  		secs = 59;
  		mins--;
 	}
 	document.cd.disp.value = dis(mins,secs); // setup additional displays here.
 	if((mins == 0) && (secs == 0)) {
  		window.alert(" Hey Time is up. Press OK to continue."); 
  		 window.location = "results_random.php" // redirects to specified page once timer ends and ok button is pressed
 	} else {
 		cd = setTimeout("redo()",1000);
 	}
}

function init() {
  cd();
}
window.onload = init;
</script>
<style type="text/css">
<!--
.heading {
	color: #F90;
	font-family: "Comic Sans MS", cursive;
}
.options {
	font-family: "Comic Sans MS", cursive;
	font-size: 16px;
	font-style: oblique;
	color: #F93;
}

.clock {
	font-family: "Lucida Console", Monaco, monospace;
	font-size: 18px;
	color: #FF0000;
}
.labe {
	font-size: 14px;
	font-weight: bold;
	font-family: "Comic Sans MS", cursive;
}


-->
</style>
</head>

<body>

<?php
include("connection.php");

$query="select * from tblgames ";

$rs=mysqli_query($conn,"select * from tblgames where level_id=3 order by RAND() Limit 3") or die(mysqli_error());
if(!isset($_SESSION["qn"]))
{
  $_SESSION["qn"]=0;
  //mysqli_query($conn,"delete from tblgames") or die(mysqli_error());
  $_SESSION["trueans"]=0;

  
}
else
{ 
  $submit=$_POST["submit"];
    $correct=$_SESSION["correct"];
    if($submit=='Next Question' && isset($ans))
    {
        mysqli_data_seek($rs,$_SESSION["qn"]);
        $row= mysqli_fetch_row($rs);  
        if($ans==$correct)
        {
        $_SESSION["trueans"]=$_SESSION["trueans"]+1;
        }
        $_SESSION["qn"]=$_SESSION["qn"]+1;
    }
    else if($submit=='Get Result' && isset($ans))
    {
        mysqli_data_seek($rs,$_SESSION["qn"]);
        $row= mysqli_fetch_row($rs);  
        if($ans==$correct)
        {
        $_SESSION["trueans"]=$_SESSION["trueans"]+1;
        }
        echo "<h1 class=head1> Result</h1>";
        $_SESSION["qn"]=$_SESSION["qn"]+1;
        echo "<Table align=center><tr class=tot><td>Total Question<td> $_SESSION[qn]";
        echo "<tr class=tans><td>True Answer<td>".$_SESSION["trueans"];
        $w=$_SESSION["qn"]-$_SESSION["trueans"];
        echo "<tr class=fans><td>Wrong Answer<td> ". $w;
        echo "</table>";
        echo "<h1 align=center><a href=review.php> Review Question</a> </h1>";
        unset($_SESSION["qn"]);
        unset($_SESSION["trueans"]);
        exit;
    }
}
if($_SESSION["qn"]>mysqli_num_rows($rs)-1)
{
unset($_SESSION["qn"]);
echo "<h1 class=head1>Some Error  Occured</h1>";
session_destroy();
echo "Please <a href=index.php> Start Again</a>";

exit;
}
mysqli_data_seek($rs,$_SESSION["qn"]);
$row= mysqli_fetch_row($rs);
echo "<form method='post' action='test.php'  name='cd'>";
echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
echo "<span class='labe'>Remaining Time</span>:";
echo "<input name='disp' type='text' class='clock' id='txt' value='10:00' size='10' readonly='true' align='right' border='1' />";
echo "<span class='labe'>Minutes</span>";
$n=$_SESSION["qn"]+1;
echo "<tR><td><span class=style2>Que ".  $n .": <img src=".$row[2]."></style>";
echo "<tr><td class=style8><input type='text' required name='ans'>";
$_SESSION["correct"]=$row[3];

if($_SESSION["qn"]<mysqli_num_rows($rs)-1)
echo "<tr><td><input type=submit name=submit value='Next Question'></form>";


else
echo "<tr><td><input type=submit name=submit value='Get Result'></form>";
echo "</table></table>";
echo "</form>";
?>

</body>
</html>