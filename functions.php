<?php
function importWordList($wordDifficulty) {
    $file = fopen($wordDifficulty, "r");
    $line = fgets($file);
    // Store all words into array
    $wordArray = explode(",",$line);
    fclose($file);
    return $wordArray;
}
function generateWord(&$wordArray) {
    // Finds random word in array
    $randomWord = $wordArray[array_rand($wordArray)];
    // Deletes word from array
    unset($wordArray[array_search($randomWord,$wordArray)]);
    // Returns next word
    return $randomWord;
}
function hideCharacters($answer) {
    for ($i = 0; $i < count($answer); $i++) {
        $answer[$i] = '___';
    }
    return $answer;
}
function letter_spaces($spaces) {
    for($i=0; $i<count($spaces);$i++){
        echo '<div class="placeholders">'.$spaces[$i].'</div>';
    }
}



/* ------------------------------------------------------------------
Eveerything below this is not used but maybe it can help?


function checkAndReplace($userInput, $hidden, $answer)
{
    $i = 0;
    $wrongGuess = true;
    while($i < count($answer))
    {
        if ($answer[$i] == $userInput)
        {
            $hidden[$i] = $userInput;
            $wrongGuess = false;
        }
        $i = $i + 1;
    }
    if (!$wrongGuess) $_SESSION['attempts'] = $_SESSION['attempts'] - 1;
    return $hidden;
}

// Check if the game is won or lost
    if ($incorrectGuesses >= 6) {
      echo '<p>You lost! The word was: ' . $wordToGuess . '</p>';
      session_destroy(); // End the game
    } elseif (count(array_diff(str_split($wordToGuess), $guessedLetters)) === 0) {
      echo '<p>Congratulations! You won!</p>';
      session_destroy(); // End the game
    }

echo '<div id="word-display">';
    foreach (str_split($wordToGuess) as $char) {
      if (in_array($char, $guessedLetters)) {
        echo $char . ' ';
      } else {
        echo '_ ';
      }
    }
    echo '</div>';*/
?>
