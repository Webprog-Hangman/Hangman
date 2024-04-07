<?php session_start();
require 'functions.php';

if (isset($_POST['difficulty'])) {
    switch ($_POST['difficulty']) {
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
    $total_life = "_ _ _ _ _ _ _";

    $_SESSION['wordListArray'] = importWordList($wordDifficulty);
    $_SESSION['wordToGuess'] = strtoupper(generateWord($_SESSION['wordListArray']));
    $_SESSION['wordToGuessArray'] = array();
    $_SESSION['wordToGuessLetterCount'] = $numPlaceholders;
    for ($i = 0; $i < $numPlaceholders; $i++) {
        $_SESSION['wordToGuessArray'][$i] = "_";
    }
    $_SESSION['totalLife'] = 7;
    $_SESSION['letterUsedCount'] = 0;
    $_SESSION['letterTrueGuess'] = 0;

    $_SESSION['gameOver'] = false;
    header('location: gamepage.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <link href="css/difficulty.css" rel="stylesheet">
</head>
<body>
  <div><a href = "login.php"><img src = "css/img/back_button.png" class="back_button"></a></div>
  <div class="content">
    <h2>Choose Your Difficulty Level</h2>

    <div class="buttons">
      <form method="post">
      <button type="submit" name="difficulty" value="Easy" class="easy_button">Easy</button>
      <button type="submit" name="difficulty" value="Medium" class="medium_button">Medium</button>
      <button type="submit" name="difficulty" value="Hard" class="hard_button">Difficult</button>
      </form>
    </div>
    
  </div>
  
</body>
</html>