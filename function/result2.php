<?php

session_start();
				echo "<h1 class=head1> Result</h1>";
				$question=$_SESSION["question"];
				$correctAnswer=$_SESSION["correctAnswer"];
				echo "<Table align=center><tr class=tot><td>Total Question<td> $question";
				if ($correctAnswer==0){
				echo "<tr class=tans><td>True Answer<td>0";
			    }
			    else
			    {
			    	echo "<tr class=tans><td>True Answer<td>".$correctAnswer;
			    }
				$w=$question-$correctAnswer;
				echo "<tr class=fans><td>Wrong Answer<td> ". $w;
				echo "</table>";

?>			