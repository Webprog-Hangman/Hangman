<?php
session_start();

// Read user login info file and store user data
$file_path = 'user_login_info.txt';
$userData = [];

// Check if the file exists before attempting to open it
if (file_exists($file_path)) {
    $file = fopen($file_path, "r");
    while (!feof($file)) {
        $line = fgets($file);
        $userDataArray = explode(",", $line);
        if (count($userDataArray) >= 3) {
            $username = trim($userDataArray[0]);
            $password = trim($userDataArray[1]);
            $wins = intval(trim($userDataArray[2]));
            // Check if the user has signed up 
            if (!empty($username) && !empty($password)) {
                $userData[$username] = ['Username'=>$username, 'Password' => $password, 'Wins' => $wins];
            }
        }
    }
    fclose($file);

    // Sort user data array by wins in descending order
    usort($userData, function($a, $b) {
    return $b['Wins'] - $a['Wins'];
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="css/leaderboard.css">
</head>
<body>
      <div><a href = "homepage.html"><img src = "css/img/back_button.png" class="back_button"></a></div>
    <div class="leaderboard-container">
        <h1>Leaderboard</h1>
        <table>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Wins</th>
            </tr>
            <?php
            $rank = 1;
            foreach ($userData as $userInfo) {
                echo "<tr>";
                echo "<td>$rank</td>";
                echo "<td>{$userInfo['Username']}</td>";
                echo "<td>{$userInfo['Wins']}</td>";
                echo "</tr>";
                $rank++;
            }
            ?>
        </table>
    </div>
</body>
</html>
