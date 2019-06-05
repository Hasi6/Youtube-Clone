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
            echo $formProvider->createUserDetailsForm(); 
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