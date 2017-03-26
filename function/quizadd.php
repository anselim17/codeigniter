<html>
	<head>
	<title>Home</title>
	<link rel="stylesheet" href="css/grid.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/camera.css">

	<script src="js/jquery.js"></script>
	<script src="js/jquery-migrate-1.2.1.js"></script>
	<script src='js/camera.js'></script>
	<script src="js/script.js"></script>
	<script src="js/wow.js"></script>
	<script>
		$(document).ready(function () {
			if ($('html').hasClass('desktop')) {
				new WOW().init();
			}
		});
	</script>
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>


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
	font-size: 18px;
	font-weight: bold;
	font-family: "Comic Sans MS", cursive;
}
.asd {
	font-size: 60px;
	font-weight: bold;
	font-family: "Comic Sans MS", cursive;
}
-->
</style>
	</head>
<body class="index-1">
<!--==============================header=================================-->
<header id="header">
	<div id="stuck_container">
		<div class="container">
			<div class="row">
				<div class="grid_12"><br>
					<h1><a href="index.php">ADDITION</a></h1>
					<nav>
						<ul class="sf-menu">
							<li class="current"><a href="index.php">Home</a></li>
							<li><a href="#">Lessons</a>
								<ul>
									<li><a href="#">Addition</a>
											
									</li>
									<li><a href="lessonssub.php">Subtration</a>
									</li>
									<li><a href="lessonsmul.php">Multiplication</a>
									</li>
									<li><a href="lessonsdiv.php">Division</a>
	
									</li>
								</ul>
							</li>

							<li><a href="#">Games</a>
								<ul>
									<li><a href="#">Easy</a></li>
									<li><a href="#">Medium</a></li>
									<li><a href="#">Hard</a></li>
								</ul>
							</li>
							<li><a href="#">Quiz</a>
								<ul>
									<li><a href="quizadd.php">Addition</a></li>
									<li><a href="#">Subtraction</a></li>
									<li><a href="#">Multiplication</a></li>
									<li><a href="#">Division</a></li>
								</ul>
							</li>
							<li><a href="logout.php">Logout</a></li>
						</ul>`
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>

<!--=======content================================-->

<section id="content">
	<div class="full-width-container block-1">
		<div class="container">
			<div class="row">
				<div class="grid_12">
						
				</div>
			</div>
		</div>
	</div>
</section>

<footer id="footer">
	<div class="footer_bottom">
	</div>
</footer>
<div>

	<center><h2 class="asd"><u> END OF SEMESTER EXAMINATION</u><h2></center>
<form name="cd">
  <label>
  <span class="labe">Remaining Time</span>:
  <input name="disp" type="text" class="clock" id="txt" value="10:00" size="10" readonly="true" align="right" border="1" />
  <span class="labe">Minutes</span>
</form>
<form method="POST" action="">
<?php 
error_reporting(0);
include("connection.php");
$sql="SELECT * FROM `quizes` order by rand() limit 10 " ;
$result=mysqli_query($conn,$sql);
$number = 0;


for($i=0; $row = mysqli_fetch_array($result); $i++){
        $number++;  
        $id = $row['id'];
        $question = $row['question'];
      $ans_array = array($row['answerA']=>"A",$row['answerB']=>"B",$row['answerC']=>"C",$row['answerD']=>"D");
      $allkeys=array_keys($ans_array);
       
     shuffle($allkeys);
?>

 <h5 <?php echo 'value="'. $id .'"';?>> <?php echo $number . ".) " . $question; ?></h5>   
 <h5><label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[0]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[0]; ?></label><br>
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[1]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[1]; ?></label><br>
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[2]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[2]; ?></label><br>
 <label><input type="radio" class="answer" value="<?php echo $ans_array[$allkeys[3]]; ?>" data-id="<?php echo $id; ?>" name="question[<?php echo $id; ?>]" > <?php echo $allkeys[3]; ?></label></h5><br>
<?php 

}
?> 
<br />
<br />
<input type="submit" value="Submit" name="submit">
</form>
<?php
include("connection.php");
if (isset($_POST["question"])){
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
    $sql2="insert into tblrecords (mdas_id,student_id,score) values ('".$mdas_id."','".$student_id."','".$correctAnswer."')";
    $result=mysqli_query($conn,$sql2);
    mysqli_close($conn);
}
?>

</div>
</body>

<script language="javascript">

var mins
var secs;

function cd() {
 	mins = 1 * m("45"); // change minutes here
 	secs = 0 + s(":00"); 
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
        answers.push({id: $(this).data('id'), value: input.value});
    });
 		$.post('data.php',
 			{
 				question:answers
 			},function(r){

 				alert(r);
 				$('#upd_div').html("Last Updated:" + r);
 			});
  		window.alert(" Hey Time is up. Press OK to continue."); 
  	//  window.location = "#";// redirects to specified page once timer ends and ok button is pressed

 	} else {

 		      cd = setTimeout("redo()",1000);
           
       
        }
 	}

function init() {
  cd();
}
window.onload = init;
</script>

</html>
