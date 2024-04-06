<?php session_start();
require'functions.php';

//Retrieve selected difficulty level
if(isset($_POST['difficulty'])){
    $difficulty=$_POST['difficulty'];
    switch ($difficulty) {
        case 'Easy':
            $numPlaceholders = 5;
            $wordDifficulty = 'easy-words.txt';
            break;
        case 'Medium':
            $numPlaceholders = 7;
            $wordDifficulty = 'medium-words.txt';
            break;
        case 'Hard':
            $wordDifficulty = 'hard-words.txt';
            $numPlaceholders = 9;
            break;
    }
}
// Random word generator
$_SESSION['$wordArray'] = importWordList($wordDifficulty);
$wordArray = $_SESSION['$wordArray'];

$currentWord = generateWord($wordArray);
echo 'CURRENT WORD: '.$currentWord;

/* ------------ work in progress ------------
// Check if letter is correct
$_SESSION['wrongCount'] = 0;
$wrongCount = $_SESSION['wrongCount'];

if(isset($_POST['letter'])) {
    $selectedLetter = $_POST['letter'];
    if (!in_array($selectedLetter, str_split($currentWord))) {
        $wrongCount++;
        var_dump('#WRONG: ' . $wrongCount);
    }
}
 -------------------------------------------- */
?>
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
		<?php
		//Generate the placeholders
		for($i=0; $i<$numPlaceholders;$i++){
			echo '<div class="placeholders">___</div>';
		}
/* ------------ work in progress ------------
//From easy.php - seemed helpful

foreach (str_split($currentWord) as $char) {
            if (in_array($char, $guessedLetters)) {
                echo $char . ' ';
            } else {
                echo '_ ';
            }
 -------------------------------------------- */
		?>
	</div>
</body>
</html>
