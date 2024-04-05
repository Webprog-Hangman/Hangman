<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hangman Gamepage</title>
	<link rel="stylesheet" type="text/css" href="css/gamepage.css">
</head>
<body style="background-image: url('css/img/gamepage_background.jpeg'); background-size: cover;">
	<!--Back to homepage button-->
	<div class="top">
		<a href="homepage.html">
			<img src="css/img/back_button.png" class="back_button">
		</a>
	</div>
	<!--Hangman Display-->
	<div class="hangman-figure">
		<div class="empty-hangman">
			<img src="css/img/Hangman Template.png">
		</div>
	</div>

	<!-- On Screen Keyboard -->
	<div class="keyboard">
		<form action="gamepage.php" method="post">
			<div class="row">
				<?php
					for($i=65; $i<=73; $i++){
						$letter = chr($i);
						echo '<button name="letter" type="submit" value="'.$letter.'">'.$letter.'</button>' ;
					}
				?>
			</div>
			<div class="row">
				<?php
					for($i=74; $i<=82; $i++){
						$letter = chr($i);
						echo '<button name="letter" type="submit" value="'.$letter.'">'.$letter.'</button>' ;
					}
				?>
			</div>
			<div class="row">
				<?php
					for($i=83; $i<=90; $i++){
						$letter = chr($i);
						echo '<button name="letter" type="submit" value="'.$letter.'">'.$letter.'</button>' ;
					}
				?>
			</div>
		</form>
	</div>
	
	<!-- Placeholders for solution word letters-->
	<div class="solution">
		
	</div>
</body>
</html>