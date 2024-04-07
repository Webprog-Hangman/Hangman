<?php 
	//Start session
	session_start();

	chmod("user_login_info.txt", 0666);

	//Check if submit was clicked
	if(isset($_POST['submit'])){
		//Array storing user info from user_login_info.txt
		$file = "user_login_info.txt";
	
		//Associate array with username as key and name and password as values
		$userData = [];

		//Array to hold string of lines from the file 
		$users = file($file, FILE_IGNORE_NEW_LINES);

		//Fill $userData array with corresponding lines of code
		foreach ($users as $person) {
			$userDataArray=explode(",", $person);
			$username=$userDataArray[0];
			$userData[$username]=['Password' => $userDataArray[1]];
		}

		//Check that all form fields are filled
		if (empty($_POST['Username']) || empty($_POST['Password'])) {
			echo '<h1>Error! Please fill in all fields. <a href="signup.php">Try Again.</a> </h1>';
		}else{
			//Check if the username is already taken
			if (isset($userData[$_POST['Username']])) {
				echo '<h1>Error! The username is already taken. <a href="signup.php">Try Again.</a></h1>';
			}else{
				//If all fields are filled and username is not taken then continue to register user
				$username=$_POST['Username'];
				$password=$_POST['Password'];

				//Add new user to $userData array
				$userData[$username]=['Password' => $password, 'Wins'=>0];
			}
				//Add new user to user_login_info.txt
				$userDataLine = implode(",", [$username,$password,0]);

				file_put_contents($file, $userDataLine."\n", FILE_APPEND);

				echo "<h1>Thank you!</h1>";
				echo '<h2><a href="login.php">Log in to play a game of Hangman!</a></h2>'; 

		}
		
	}

?>
