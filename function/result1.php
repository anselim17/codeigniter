
<center><?php
session_start();
				echo "<h1 class=head1> Result</h1>";
				$question=$_SESSION["question"];
				echo "<Table align=center><tr class=tot><td>Total Question<td> $question";
				echo "<tr class=tans><td>True Answer<td>".$_SESSION["correctAnswer"];
				$w=$question-$_SESSION["correctAnswer"];
				echo "<tr class=fans><td>Wrong Answer<td> ". $w;
				echo "</table>";
?>
				<a href='index.php'> Bach to Home</a>