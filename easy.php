<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hangman Game</title>
</head>

<body>
  <div class="hangman">
    <h1>Hangman Game</h1>
    <?php
    session_start();
    if (!isset($_SESSION['wordToGuess']) || isset($_POST['newGame'])) {
      $_SESSION['wordToGuess'] = generateWord();
      $_SESSION['guessedLetters'] = [];
      $_SESSION['incorrectGuesses'] = 1;
    }

    $wordToGuess = $_SESSION['wordToGuess'];
    $guessedLetters = $_SESSION['guessedLetters'];
    $incorrectGuesses = $_SESSION['incorrectGuesses'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guess'])) {
      $guess = strtoupper($_POST['guess']);
      $_SESSION['guessedLetters'][] = $guess;
      if (!in_array($guess, str_split($wordToGuess))) {
        $_SESSION['incorrectGuesses']++;
      }
    }

    // Display placeholders for word to guess
    echo '<div id="word-display">';
    foreach (str_split($wordToGuess) as $char) {
      if (in_array($char, $guessedLetters)) {
        echo $char . ' ';
      } else {
        echo '_ ';
      }
    }
    echo '</div>';

    // Display hangman figure
    echo '<div id="hangman-figure">';
    echo '<img src="css/img/hang' . $incorrectGuesses . '.png" alt="Hangman">';
    echo '</div>';

    // Display alphabet buttons
    echo '<div id="letters">';
    echo '<form method="GET">';
    for ($i = 65; $i <= 90; $i++) {
      $letter = chr($i);
      if (!in_array($letter, $guessedLetters)) {
        echo '<button class="letter" name="guess" value="' . $letter . '">' . $letter . '</button>';
      }
    }
    echo '</form>';
    echo '</div>';

    echo '<form method="post">';
    echo '<button type="submit" name="newGame">New Game</button>';
    echo '</form>';


    // Check if the game is won or lost
    if ($incorrectGuesses >= 6) {
      echo '<p>You lost! The word was: ' . $wordToGuess . '</p>';
      session_destroy(); // End the game
    } elseif (count(array_diff(str_split($wordToGuess), $guessedLetters)) === 0) {
      echo '<p>Congratulations! You won!</p>';
      session_destroy(); // End the game
    }


    // Generate a random word
    function generateWord()
    {
      $words = ['BAT', 'LATE', 'GOODBYE'];
      return $words[array_rand($words)];
    }
    ?>
  </div>
</body>

</html>