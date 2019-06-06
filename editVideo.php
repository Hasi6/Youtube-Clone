<?php
    require_once("./includes/header.php");
    require_once("./includes/classes/VideoPlayer.php");
    require_once("./includes/classes/videoDetails.php");
    require_once("./includes/classes/VideoUploadData.php");
?>

<?php

    if(!User::isLoggedIn()){
        header("Location: login.php");
    }

    if(!isset($_GET["videoId"])){
        echo "No Video Selected to Edit";
    }

    $video = new Video($con, $_GET["videoId"], $userLoggedInObj);

    if($video->getUploadedBy() != $userLoggedInObj->getUsername()){
        echo "No can't edit this video, Because this is uploaded by ".$video->getUploadedBy(). " not you";
        exit();
    }
?>


<?php
    require_once("./includes/footer.php");
?>