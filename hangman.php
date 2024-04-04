<?php
session_start();

// Check if letter is guessed
if (isset($_POST['letter'])) {
    $guessedLetter = strtoupper($_POST['letter']);
    $_SESSION['guessedLetters'][] = $guessedLetter;
    $wordToGuess = $_SESSION['wordToGuess'];
    $wordDisplay = '';
    $allGuessed = true;

    // Check if guessed letter is in the word
    for ($i = 0; $i < strlen($wordToGuess); $i++) {
        if (in_array($wordToGuess[$i], $_SESSION['guessedLetters'])) {
            $wordDisplay .= $wordToGuess[$i] . ' ';
        } else {
            $wordDisplay .= '_ ';
            $allGuessed = false;
        }
    }

    // Check if guessed letter is incorrect
    if (!in_array($guessedLetter, str_split($wordToGuess))) {
        $_SESSION['incorrectGuesses']++;
    }

    // Check game status
    if ($_SESSION['incorrectGuesses'] >= 6) {
        echo 'lost';
    } elseif ($allGuessed) {
        echo 'won';
    } else {
        echo $wordDisplay;
    }
} else {
    // Start new game
    $_SESSION['wordToGuess'] = generateWord();
    $_SESSION['guessedLetters'] = [];
    $_SESSION['incorrectGuesses'] = 0;
}

// Generate a random word
function generateWord() {
    $words = ['HELLO', 'WORLD', 'HANGMAN', 'COMPUTER', 'PROGRAMMING', 'JAVASCRIPT', 'PHP', 'PYTHON', 'OPENAI'];
    return $words[array_rand($words)];
}
?>
*/