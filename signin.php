<?php
    require('includes/config.php');
    require('includes/classes/FormSanitizer.php');
    require('includes/classes/Accounts.php');
    require('includes/classes/Constance.php');
?>



<!-- Get Form details -->
<?php

    $accounts = new Accounts($con);
    

    if(isset($_POST["submitButton"])){

        $firstName = FormSanitizer::sanitizeFromString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFromString($_POST["lastName"]);

        $username = FormSanitizer::sanitizeFromUserName($_POST["username"]);

        $email = FormSanitizer::sanitizeFromEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFromEmail($_POST["email2"]);

        $password = FormSanitizer::sanitizeFromPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFromPassword($_POST["password2"]);

        $wasSuccessful = $accounts->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
    <title>Sign In</title>

    
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

    <div class="signInContainer">

        <div class="column">
            
            <!-- Contains the logo have to create alogo -->
            <div class="signInHeader">
                <img src="assets/images/icons/output.gif" alt="">
                <h3>SignIn</h3>
                <span>to continue to HasiTube</span>
            </div>

            <!-- SignIn Inputs -->
            <div class="signInForm">
                <form action="signin.php" method="POST">

                    <input type="text" name="firstName" placeholder="Enter First Name" autocomplete="off" value="<?php getInputValues('firstName') ?>" required>
                    <!-- if there is an error in firstName show the error to the user -->
                    <?php echo $accounts->getError(Constance::$firstNameCharacters);?>

                    <input type="text" name="lastName" placeholder="Enter Last Name" autocomplete="off" value="<?php getInputValues('lastName') ?>" required>
                    <!-- if there is an error in lastName show the error to the user -->
                    <?php echo $accounts->getError(Constance::$lastNameCharacters);?>

                    <input type="text" name="username" placeholder="Enter Username" autocomplete="off" value="<?php getInputValues('username') ?>" required>
                    <!-- if there is an error in Username show the error to the user -->
                    <?php echo $accounts->getError(Constance::$usernameCharacters);?>
                    <?php echo $accounts->getError(Constance::$usernameAlreadyHave);?>

                    <input type="email" name="email" placeholder="Enter Email" autocomplete="off" value="<?php getInputValues('email') ?>" required>
                    <input type="email" name="email2" placeholder="Enter Email Again" autocomplete="off" value="<?php getInputValues('email2') ?>" required>
                    <!-- Check email and Confirm emails are macthed or Email is in currect Format an demail already registered-->
                    <?php echo $accounts->getError(Constance::$emailMacthed);?>
                    <?php echo $accounts->getError(Constance::$emailvalid);?>
                    <?php echo $accounts->getError(Constance::$emailAlreadyHave);?>


                    <input type="password" name="password" placeholder="Enter passowrd" autocomplete="off" required>
                    <input type="password" name="password2" placeholder="Enter passowrd Again" autocomplete="off" required>
                    <!-- Check Password and Confirm Passwords are macthed or Password is in currect Format and the Length-->
                    <?php echo $accounts->getError(Constance::$passwordMacthed);?>
                    <?php echo $accounts->getError(Constance::$passwordValid);?>
                    <?php echo $accounts->getError(Constance::$passwordLenght);?>

                    
                    <input type="submit" name="submitButton" value="SUBMIT" class="btn btn-primary">
                </form>
            </div>

            <a href="login.php" class="logInMessage">Already Have an Account? Login Here!</a>
        </div>

    </div>

</body>

</html>