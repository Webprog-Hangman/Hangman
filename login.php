<?php session_start();
/* Check Login form submitted */
if (isset($_POST['Submit'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    
    /* Check Login credentials entered */
    if (!empty($Username) && !empty($Password)) {
        /* Open file */
        $file_path = 'user_login_info.txt';
        $user_found = false;
        $file = fopen($file_path, "r");
        
        /* Loop through each line in the file */
        while (!feof($file)) {
            $line = fgets($file);
            $loginUser = explode(",", $line);
            
            /* Check if the username and password match */
            if (trim($loginUser[0]) === $Username && trim($loginUser[1]) === $Password) {
                $user_found = true;
                break;
            }
        }
        fclose($file);
        
        /* If user was found, redirect to difficulty selection page */
        if ($user_found) {
            header("Location: difficulty.php");
            exit();
        }
        else {
            /* Set error message */
            $msg = "<span style='color:red'>Invalid Login Details</span>";
        }
    }
    else {
        /* Set error message */
        $msg = "<span style='color:red'>Invalid Login Details</span>";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Login</title>
        <link href="css/login.css" rel="stylesheet">
    </head>
    <body>
    <!-- Background image div -->
        <div class="bg"><img src="css/img/login_bg.png" alt="background"/> </div>
    <!-- Back arrow and header div -->
        <div id="top_nav">
            <a href="homepage.html" id="back_button"><img src="css/img/back_button.png"  alt="Back Arrow"></a>
            <header>Login</header>
        </div>
    <!-- Form -->
        <div id="form_container">
            <form action="" method="post" name="login_form">
            <!-- If login credentials are wrong -->
                <div id="error_message">
                <?php if(isset($msg)){
                     echo $msg;
                }?>
                </div>
                <!-- Input Fields -->
                <div id="username_field">
                    <label><strong>Username:</strong>
                        <input name="Username" type="text">
                    </label>
                </div>
                <div id="password_field">
                    <label><strong>Password:</strong>
                        <input name="Password" type="password">
                    </label>
                </div>
                <!-- Submit button -->
                <div id="submit_button">
                    <input name="Submit" type="submit" value="Log in">
                </div>
            </form>
        </div>
    </body>
</html>
