<?php
include("connection.php");

if (isset($_POST['question'])){
    $correctAnswer = 0;
    $wrongAnswer = 0;
    $student_id=1;
    $roleid=3;
    $mdas_id=1;
    $question = $_POST['question'];
    $questionIds = getIdsFromArray($question);
    $questionAns = getIValuesFromArray($question);
	//print_r($_POST['question']);
    $idList = implode(',', $questionIds);
    $sql = "SELECT id, finalanswer from quizes WHERE id IN ($idList)";
     $row=mysqli_query($conn,$sql);

     while (list($id,$correct)=mysqli_fetch_row($row)) {
        
        if(checkAnswer($_POST['question'],$id,$correct)) {
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

function getIdsFromArray($arr){
    $newArr = [];

    foreach ($arr as $a) {
        # code...
        $newArr[] = $a['id'];
    }

    return $newArr;
}

function getIValuesFromArray($arr){
    $newArr = [];

    foreach ($arr as $a) {
        # code...
        $newArr[] = $a['value'];
    }

    return $newArr;
}
function checkAnswer($question, $id,$answer){
	
	foreach($question as $k=>$v){
		if($v['id']==$id ){
			return $v['value']==$answer;
				
		}
	}
	return false;
}
?>