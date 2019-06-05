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

    $formProvider = new SettingsFormProvider();
?>


<div class="settingsContainer column">

    <div class="formSection">
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