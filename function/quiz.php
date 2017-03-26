
<?php
session_start();
include_once("connection.php");

if (isset($_SESSION["username"]))
{
  $username=$_SESSION["username"];
  $sql="select * from user where username='".$username."'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $studentid=$row["id"];
  if($row["role"]==2){
  header('Location:login.php');
  }
   else if($row["role"]==3){
  header('Location:login.php');
  }
  

    
}

?>
<html>

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script language="javascript">

var mins
var secs;

function cd() {
 	mins = 1 * m("0"); // change minutes here
 	secs = 0 + s(":15"); 
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
    var answers = [];
	
    $.each($('.answer:checked'), function(index, input){
        console.log('each' + index, 'values is: ' + input.name);
        console.log('data', $(this).data('id'));
        answers.push({id: $(this).data('id'), value: input.value});// apil nani every click tagsa2x kuaon ang value ;like this
    });
 		$.post('data.php',
 			{
 				question:answers
 			},function(r){

 				alert(r);
 				$('#upd_div').html("Last Updated:" + r);
 			});
  		window.alert(" Hey Time is up. Press OK to continue."); 
  	window.location = "result2.php";// redirects to specified page once timer ends and ok button is pressed

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


<body background="admin/images/1019286_abstract_orange_tiles_background_.jpg" >
<center><h2><u> END OF SEMESTER EXAMINATION</u><h2></center>
<form name="cd">
  <label>
  <span class="labe">Remaining Time</span>:
  <input name="disp" type="text" class="clock" id="txt" value="10:00" size="10" readonly="true" align="right" border="1" />
  <span class="labe">Minutes</span>
</form>
<form method="POST" action="">
<?php 
error_reporting(0);
session_start();
include("connection.php");
if (isset($_GET["mdasid"])){
$mdasid=$_GET["mdasid"];
$sql="SELECT * FROM `quizes` where mdas_id='".$mdasid."' order by rand() limit 10 " ;
$result=mysqli_query($conn,$sql);
$number = 0;
$mdas_id=1;

for($i=0; $row = mysqli_fetch_array($result); $i++){
        $number++;  
        $id = $row['id'];
        $question = $row['question'];
      $ans_array = array($row['answerA']=>"A",$row['answerB']=>"B",$row['answerC']=>"C",$row['answerD']=>"D");
      $allkeys=array_keys($ans_array);
       
     shuffle($allkeys);
   $_SESSION["question"]=$number;
?>

 <h4 <?php echo 'value="'. $id .'"';?>> <?php echo $number . ".) " . $question; ?></h4>   <!--data-id<id dha niya gkuha ang value-->
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[0]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[0]; ?></label><br>
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[1]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[1]; ?></label><br>
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[2]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[2]; ?></label><br>
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[3]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[3]; ?></label><br>

<?php 
}
}
?> 
<br />
<br />
<input type="submit" value="Submit" name="submit">
</form>
<?php
include("connection.php");
if (isset($_POST["submit"])){
    $correctAnswer = 0;
    $wrongAnswer = 0;
    $student_id=1;
    $roleid=3;
    $mdas_id=1;

    $idList = join(',',array_map('intval',array_keys($_POST['question'])));
    $sql = "SELECT id, finalanswer from quizes WHERE id IN ($idList)";
     $row=mysqli_query($conn,$sql);
     while (list($id,$correct)=mysqli_fetch_row($row)) {
        
        if($correct == $_POST['question'][$id]){
            $correctAnswer+=1;

        }
        else {
            $wrongAnswer += 1;
        }
    }
    $sql2="insert into tblrecords (mdas_id,student_id,score) values ('".$mdas_id."','".$studentid."','".$correctAnswer."')";
    echo "<script>window.location='result.php'</script>";
    $_SESSION["correctAnswer"]=$correctAnswer;
    $_SESSION["wrongAnswer"]=$wrongAnswer;
    $result=mysqli_query($conn,$sql2);
    mysqli_close($conn);
}
?>


</body>
</html>
