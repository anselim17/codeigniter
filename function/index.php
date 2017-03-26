<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Home</title>
	<link rel="stylesheet" href="css/grid.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/camera.css">
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery-migrate-1.2.1.js"></script>
	<script src='js/camera.js'></script>


	<script src="js/script.js"></script>

	<!--[if (gt IE 9)|!(IE)]><!-->

	<script src="js/wow.js"></script>
	<script>
		$(document).ready(function () {
			if ($('html').hasClass('desktop')) {
				new WOW().init();
			}
		});
	</script>

	</head>
<body class="index">
<!--==============================header=================================-->
<header id="header">
	<div id="stuck_container">
		<div class="container">
			<div class="row">
				<div class="grid_12"><br>
					<h1><a href="index.php">Welcome to Kiddie MDAS</a></h1>
					<nav>
						<ul class="sf-menu">
							<li class="current"><a href="index.php">Home</a></li>
							<li class="current"><a href="#">Lessons</a>
								<ul>
									<li><a href="lessonsadd.php">Addition</a></li>
									<li><a href="lessonssub.php">Subtration</a></li>
									<li><a href="lessonsmul.php">Multiplication</a></li>
									<li><a href="lessonsdiv.php">Division</a></li>
								</ul>
							</li>
							<li class="current"><a href="#">Games</a>
								<ul>
									<li><a href="easy.php">Easy</a></li>
									<li><a href="medium.php">Medium</a></li>
									<li><a href="hard.php">Hard</a></li>

								</ul>
							</li>
							<li class="current"><a href="#">Quiz</a>
								<ul>
									<?php include("./connection.php");
									$sql="select * from mdas";
									$result=mysqli_query($conn,$sql);
									while ($row=mysqli_fetch_array($result))
									{

									echo "<li><a href='quiz.php?mdasid=".$row["mdas_id"]."'>$row[name]</a></li>";
								    }
								?>
								</ul>
							</li>
							<li class="current"><a href="logout.php">Logout</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>

<!--=======content================================-->

<section id="content">
	<div class="full-width-container block-1">
		<div class="camera_container">
			<div id="camera_wrap">
				<div class="item" data-src="images/BGwowo.gif">
				</div>
				<div class="item" data-src="images/BGwowo.gif">
				</div>
				<div class="item" data-src="images/BGwowo.gif">
				</div>
			</div>
		</div>
	</div>

</section>

<!--=======footer=================================-->
<footer id="footer">
	<div class="footer_bottom"><a href="#" rel="nofollow">asd</div>
</footer>
<script>
	jQuery(function(){
		jQuery('#camera_wrap').camera({
			height: '68.125%',
			thumbnails: false,
			pagination: true,
			fx: 'simpleFade',
			loader: 'none',
			hover: false,
			navigation: false,
			playPause: false,
			minHeight: "975px",
		});
	});
</script>

</body>
</html>