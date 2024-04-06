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

