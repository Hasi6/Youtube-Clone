<?php
    require_once("./includes/header.php");
    require_once("./includes/classes/VideoPlayer.php");
    require_once("./includes/classes/videoDetails.php");
    require_once("./includes/classes/VideoUploadData.php");
    require_once("./includes/classes/SelectThumbnail.php");
?>

<?php

    if(!User::isLoggedIn()){
        header("Location: login.php");
    }

    if(!isset($_GET["videoId"])){
        echo "No Video Selected to Edit";
        exit();
    }

    $video = new Video($con, $_GET["videoId"], $userLoggedInObj);

    if($video->getUploadedBy() != $userLoggedInObj->getUsername()){
        echo "No can't edit this video, Because this is uploaded by ".$video->getUploadedBy(). " not you";
        exit();
    }
?>

<div class="editVideoContainer column">

    <div class="topSection">

        <?php
            $videoPlayer = new VideoPlayer($video);
            echo $videoPlayer->create(false);

            $selectThumbnail = new SelectThumbnail($con, $video);
            echo $selectThumbnail->create();
        ?>

    </div>

    <div class="bottomSection">
        
    </div>

</div>


<?php
    require_once("./includes/footer.php");
?>