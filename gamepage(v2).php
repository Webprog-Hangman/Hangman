<?php session_start();
require'functions.php';

$words_to_guess_dashes = implode(" ", $_SESSION['wordToGuessArray']);

if (isset($_POST['letter'])) {
    $value = $_POST["letter"];
    $position = strpos($_SESSION['wordToGuess'], $value);

    if ($position === false) {
        //if the letter is not found then update the remaining life
        $_SESSION['letterUsedCount']++;

        $total_life_dashes = implode(" ", $_SESSION['letterUsed']);

        $message = "Letter not found";

        //check if the all the 6 life are used then game over
        if ($_SESSION['letterUsedCount'] >= 7) {
            $_SESSION['gameOver'] = true;
            $_SESSION['letterUsed'] = array();
            $message = "You Loose";
        }
    } else {
        //if the letter found and any position in the word
        //add letter to the position where it is found
        $_SESSION['wordToGuessArray'][$position] = $value;
        $words_to_guess_dashes = implode(" ", $_SESSION['wordToGuessArray']);
        $_SESSION['letterTrueGuess']++;
        $message = "Letter matched";
        //check if the all letter are guessed
        if ($_SESSION['letterTrueGuess'] >= $_SESSION['wordToGuessLetterCount']) {
            $_SESSION['gameOver'] = true;
            $_SESSION['letterUsed'] = array();
            $message = "You Won";
        }

    }
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hangman Game page</title>
        <link rel="stylesheet" type="text/css" href="css/gamepage.css">
    </head>
    <body style="background-image: url('css/img/gamepage_background.jpeg'); background-size: cover;">
    <!--Back to homepage button-->
    <div class="top">
        <a href="homepage.html">
            <img src="css/img/back_button.png" class="back_button" alt="">
        </a>
    </div>
    <!--Hangman Display-->
    <div class="hangman-figure">
        <div class="empty-hangman">
            <img src="css/img/Hangman Template.png" alt="">
            <?php
                switch ($_SESSION['letterUsedCount']) {
                    case 1:
                        echo '<img id="hang1" src="css/img/hang1.png" alt="">';
                        break;
                    case 2:
                        echo '<img id="hang2" src="css/img/hang2.png" alt="">';
                        break;
                    case 3:
                        echo '<img id="hang3" src="css/img/hang3.png" alt="">';
                        break;
                    case 4:
                        echo '<img id="hang4" src="css/img/hang4.png" alt="">';
                        break;
                    case 5:
                        echo '<img id="hang5" src="css/img/hang5.png" alt="">';
                        break;
                    case 6:
                        echo '<img id="hang6" src="css/img/hang6.png" alt="">';
                        break;
                    case 7:
                        echo '<img id="hang7" src="css/img/hang7.png" alt="">';
                        break;

                }
            ?>
        </div>
    </div>

    <!-- On Screen Keyboard -->
    <div class="keyboard">
        <form method="post">
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
        <!-- Include hidden input field to send on page reload -->
        <form id="gameData">
            <input type="hidden" name="pname" id="pname" value="<?php echo $_SESSION["name"]; ?>">
            <input type="hidden" name="wordToGuess" id="wordToGuess" value="<?php echo $_SESSION["wordToGuess"]; ?>">
            <input type="hidden" name="letterUsedCount" id="letterUsedCount" value="<?php echo $_SESSION["letterUsedCount"]; ?>">
            <input type="hidden" name="letterTrueGuess" id="letterTrueGuess" value="<?php echo $_SESSION["letterTrueGuess"]; ?>">
        </form>
    </div>

    <!-- Placeholders for solution word letters-->
    <div class="solution">
        <?php
        //Generate the placeholders
        //letter_spaces($spaces);
        ?>
    </div>
    </body>
    </html>