<?php
    require_once("includes/header.php");
    require_once("includes/classes/Accounts.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constance.php");
    require_once("includes/classes/SettingsFormProvider.php");
?>

<?php
    if(!User::isLoggedIn()){
        header("Location: index.php");
    }

    $detailsMessage = "";
    $passwordMessage = "";
    $formProvider = new SettingsFormProvider();

    if(isset($_POST["saveDetailsButton"])){
        $account = new Accounts($con);

        $firstName = FormSanitizer::sanitizeFromString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFromString($_POST["lastName"]);
        $email = FormSanitizer::sanitizeFromString($_POST["email"]);

        if($account->updateDetails($firstName, $lastName, $email, $userLoggedInObj->getUsername())){
            // Success
            $detailsMessage = "<div class='alert alert-success'>
                                    Details Updated Successfully...
                                </div>";
        }
        else{
            // Error
            $errorMessage = $account->getFirstError();

            if($errorMessage == "") $errorMessage = "Something Went Wrong";

            $detailsMessage = "<div class='alert alert-danger'>
                                    Details Updated Successfully...
                                </div>";
        }

    }

    if(isset($_POST["saveDetailsButton"])){
        
    }
?>


<div class="settingsContainer column">

    <div class="formSection">
            <div class="message">
                <?php echo $detailsMessage; ?>
            </div>
        <?php 
            echo $formProvider->createUserDetailsForm(
                isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
                isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getLastName(),
                isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getEmail()
            ); 
        ?>
    </div>

    <div class="formSection">
        <?php 
            echo $formProvider->createPasswordForm(); 
        ?>
    </div>

</div>







<?php
    require_once("includes/footer.php");
?>