<?php
    require_once("./includes/header.php");
    require_once("./includes/classes/ProfileGenerator.php");
?>

<?php
    if(isset($_GET["username"])){
        $profileUsername = $_GET["username"];
    }
    else{
        echo "User Not Found";
        exit();
    }
    $profileGenerator = new ProfileGenerator($con, $userLoggedInObj, $pprofileUsername);
    echo $profileGenerator->create();
?>

<?php
    require_once("./includes/footer.php")
?>