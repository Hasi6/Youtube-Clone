<?php
    require('includes/config.php');
    require('includes/classes/Accounts.php');
    require('includes/classes/Constance.php');
    require('includes/classes/FormSanitizer.php');

?>
<?php

    $accounts = new Accounts($con);

if(isset($_POST["submitButton"])){

    $username = FormSanitizer::sanitizeFromEmail($_POST["username"]);
    $password = FormSanitizer::sanitizeFromPassword($_POST["password"]);

    $wasSuccessful = $accounts->login($username, $password);

    if($wasSuccessful){
        //Success and redirect user to index page 
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }

}

    // Get input values and show them in text fields if there is any error
    function getInputValues($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/signin.css">

    <!-- Font Awesome -->
    

    <!-- Google jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- js -->
    <script src="./assets/js/commonActions.js"></script>
</head>
<body>

    <div class="logInContainer">

        <div class="column">
            
            <!-- Contains the logo have to create alogo -->
            <div class="logInHeader">
                <img src="assets/images/icons/output.gif" alt="">
                <h3>LogIn</h3>
                <span>to continue to HasiTube</span>
            </div>

            <!-- SignIn Inputs -->
            <div class="logInForm">
                <form action="login.php" method="POST">

                <input type="text" name="username" placeholder="Enter username" value="<?php getInputValues('username') ?>" required>
                <input type="password" name="password" placeholder="Enter passowrd" autocomplete="off" required>

                <?php echo $accounts->getError(Constance::$login);?>


                <input type="submit" name="submitButton" value="SUBMIT" class="btn btn-primary">

                </form>
            </div>

            <a href="signin.php" class="signInMessage">Don't Have an Account? SignIn Here!</a>
        </div>

    </div>

</body>

</html>