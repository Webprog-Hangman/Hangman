<?php 
session_start();
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
      <form action="gamepage.php" method="post">
      <button type="submit" name="difficulty" value="Easy" class="easy_button">Easy</button>
      <button type="submit" name="difficulty" value="Medium" class="medium_button">Medium</button>
      <button type="submit" name="difficulty" value="Hard" class="hard_button">Difficult</button>
      </form>
    </div>
    
  </div>
  
</body>
</html>
