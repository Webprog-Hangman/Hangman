<?php session_start(); /* Starts the session */

/* Check Login form submitted */
if(isset($_POST['Submit'])){
    /* temp user to test */
    $logins = array('lkinsey2' => '1234');

    /* Check and assign submitted Username and Password to new variable */
    $Username = $_POST['Username'] ?? '';
    $Password = $_POST['Password'] ?? '';

    /* Check Username and Password existence in defined array */
    if (isset($logins[$Username]) && $logins[$Username] == $Password){
        /* Success: Set session variables and redirect to Protected page  */
        $_SESSION['Username']=$Username;
        $_SESSION['Password']=$logins[$Username];
        header("location:homepage.html");
        exit;
    } else {
        /*Unsuccessful attempt: Set error message */
        $msg="<span style='color:red'>Invalid Login Details</span>";
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
        <div class="bg"><img src="css/img/login_bg.png" alt="background"/> </div>
    <!--    <div id="arrow"><a id="back_arrow" href="homepage.html"></a></div>-->
        <div id="top_nav">
            <a href="homepage.html">Back</a>
            <header>Login</header>
        </div>
        <div id="form_container">
            <form action="" method="post" name="login_form">
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
                <div id="submit_button">
                    <input name="Submit" type="submit" value="Log in">
                </div>
            </form>
        </div>
    </body>
</html>
