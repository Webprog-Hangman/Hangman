<?php
session_start(); // Start the session

// Initialize variables if they don't exist in the session
if (!isset($_SESSION['wordFile'])) {
    $_SESSION['wordFile'] = '';
}
if (!isset($_SESSION['correctLetters'])) {
    $_SESSION['correctLetters'] = [];
}
if (!isset($_SESSION['incorrectLetters'])) {
    $_SESSION['incorrectLetters'] = [];
}

// Retrieve selected difficulty level
if (isset($_POST['difficulty'])) {
    $difficulty = $_POST['difficulty'];
    switch ($difficulty) {
        case 'Easy':
            $_SESSION['wordFile'] = 'easy-words.txt';
            $numPlaceholders = 5;
            break;
        case 'Medium':
            $_SESSION['wordFile'] = 'medium-words.txt';
            $numPlaceholders = 7;
            break;
        case 'Hard':
            $_SESSION['wordFile'] = 'hard-words.txt';
            $numPlaceholders = 9;
            break;
    }
}

// Function to read random word from file
function getRandomWord($filename)
{
    // Read file into a string
    $wordList = file_get_contents($filename);
    // Split string into array of words
    $words = explode("\n", $wordList);
    // Get random index from array
    $randomIndex = array_rand($words);
    // Return random word
    return trim($words[$randomIndex]);
}
if (!isset($_SESSION['solutionWord'])) {
    $_SESSION['solutionWord']=strtoupper(getRandomWord($_SESSION['wordFile']));
}
// Get random word and set as solution word
$solutionWord = $_SESSION['solutionWord'];

//Logic to handle user guess
if(isset($_POST['guess-box'])){
    //Convert gussed letter to uppercase
    $guessedLetter = strtoupper($_POST['guess-box']);
    if(ctype_alpha($guessedLetter)){
        //Track if guessed letter is found in solution word
        $letterFound=false;
        //Loop thru solution word
        for($i=0;$i<strlen($solutionWord);$i++){
            if($solutionWord[$i] === $guessedLetter){
                $_SESSION['correctLetters'][]=array('letter' =>$guessedLetter, 'position'=>$i);
                $letterFound=true;
            }
        }
        //Check if guessed letter not found in solution word
        if (!$letterFound) {
            //Add incorrectly guessed letters into the array
            $_SESSION['incorrectLetters'][]=$guessedLetter;
            //Check if more than 6 guesses are incorrect
            if (count($_SESSION['incorrectLetters'])>6) {
                $_SESSION['message']="lose";
                session_destroy();
            }
        }
        //Check if all letters have been guessed correctly
        if(count($_SESSION['correctLetters'])==strlen($solutionWord)){
            $_SESSION['message']="win";
            //Write to user-login-info.txt with updated win
            $username = $_SESSION['username'];
            $userLoginInfo=file_get_contents("user_login_info.txt");
            $lines=explode("\n",$userLoginInfo);
            foreach($lines as &$line){
                $userData=explode(",",$line);
                if($userData[0]==$username){
                    $userData[2] +=1;
                    $line = implode(",", $userData);
                    break;
                }
            }
            file_put_contents("user_login_info.txt", implode("\n",$lines));
            session_destroy();
        }
    }  
}

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
<!-- Placeholders for solution word letters-->
<div class="solution">
    <?php
    // Generate the placeholders with revealed letters
    for ($i = 0; $i < strlen($solutionWord); $i++) {
        $letterDisplayed=false;
        foreach ($_SESSION['correctLetters'] as $correctLetter) {
            if ($i === $correctLetter['position']) {
                echo '<div class="placeholders">' . $correctLetter['letter'] . '</div>';
                $letterDisplayed = true;
                break;
            }
        }
        if (!$letterDisplayed) {
            echo '<div class="placeholders">_</div>';
        }
    }
    ?>
</div>
<!--Hangman Display-->
<div class="hangman-figure">
    <div class="empty-hangman">
        <img src="css/img/Hangman Template.png">
    </div>
    <div class="body-parts">
        <?php
        // Display hangman parts based on incorrect guesses
        $incorrectCount = count($_SESSION['incorrectLetters']);
        if ($incorrectCount >= 1) {
            echo '<img src="css/img/head.png" class="head"> ';
        }
        if ($incorrectCount >= 2) {
            echo '<img src="css/img/torso.png" class="torso"> ';
        }
        if ($incorrectCount >= 3) {
            echo '<img src="css/img/left-arm.png" class="left-arm"> ';
        }
        if ($incorrectCount >= 4) {
            echo '<img src="css/img/right-arm.png" class="right-arm"> ';
        }
        if ($incorrectCount >= 5) {
            echo '<img src="css/img/left-leg.png" class="left-leg"> ';
        }
        if ($incorrectCount >= 6) {
            echo '<img src="css/img/right-leg.png" class="right-leg"> ';
        }
        ?>
    </div>
</div>
<!-- Text Input Field and Guess Button for user guessing -->
<div class="guess-form">
    <form action="" method="post">
        <input type="text" name="guess-box" maxlength="1" placeholder="Enter a Letter" class="guess-box"
               pattern="[A-Za-z]" title="Please enter a letter" required>
        <button type="submit" value="Guess!" class="guess_button">Guess!</button>
    </form>
</div>
<?php
    if (isset($_SESSION['message'])) {
        if($_SESSION['message']=="win"){
            echo '<div class="message-box><p class="message-text">You win!</p><a href="next_level.php" class="next_level_button">Next Level</a>';
        }elseif ($_SESSION['message']=="lose") {
            echo '<div class="message-box><p class="message-text">You lose!</p><a href="homepage.html" class="home_button">Home</a>';
        }
        unset($_SESSION['message']);
    }
?>
</body>
</html>
