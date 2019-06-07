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

    $detailsMessage ="";
    // check if form is submited
    if(isset($_POST["saveButton"])){
        $videoData = new VideoUploadData(
            null,
            $_POST["titleInput"],
            $_POST["descriptionInput"],
            $_POST["privacyInput"],
            $_POST["categoryInput"],
            $userLoggedInObj->getUsername()
        );

        if($videoData->updateDetails($con, $video->getId())){
            // Success
            $detailsMessage = "<div class='alert alert-success'>
                                    Details Updated Successfully...
                                </div>";
            $video = new Video($con, $_GET["videoId"], $userLoggedInObj);

        }
        else{
            // Error
            $detailsMessage = "<div class='alert alert-danger'>
                                    Something Went Wrong
                                </div>";
        }
    }
?>

<div class="editVideoContainer column">
    <div class="message">
        <?php echo $detailsMessage ?>
    </div>
    <div class="topSection">

        <?php
            $videoPlayer = new VideoPlayer($video);
            echo $videoPlayer->create(false);

            $selectThumbnail = new SelectThumbnail($con, $video);
            echo $selectThumbnail->create();
        ?>

    </div>

    <div class="bottomSection">
        <?php
            $formProvider = new VideoDetailsFormProvider($con);
                echo $formProvider->createEditDetailsForm($video);
        ?>
    </div>

</div>

<script src="assets/js/editVideoAction.js"></script>
<?php
    require_once("./includes/footer.php");
?>