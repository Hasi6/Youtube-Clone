<?php
    require_once('./includes/header.php');
    require_once('./includes/classes/VideoPlayer.php');
    require_once('./includes/classes/VideoInfoSection.php');
    require_once('./includes/classes/CommentSection.php');
    require_once('./includes/classes/Comment.php');
?>

<!-- Link watch css -->
<link rel="stylesheet" href="./assets/css/watch.css">

<!-- Check if id is here id not dispay the error message -->
<?php
    if(!isset($_GET["id"])){
        echo "<div class='alert alert-info' style='width:100%' align='center'>
                <h3 class='noId'>No Url Found to Play Video</h3> <a href='index.php'> Click Here to Go back to the Home Page</a>
            </div>";
        exit();
    }
?>

<?php

    $id = $_GET["id"];
    $video = new Video($con, $id, $userLoggedInObj);

    $video->incrementViews();
?>
    <script src="assets/js/videoPlayerAction.js"></script>
    <script src="assets/js/commentsActions.js"></script>

<div class="watchLeftColumn">
    <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(true);

        $videoInfoSection = new VideoInfoSection($con, $video, $userLoggedInObj);
        echo $videoInfoSection->create();

        $commentSection = new CommentSection($con, $video, $userLoggedInObj);
        echo $commentSection->create();
    ?>

</div>

<div class="suggestions">
    <?php 
        $videoGrid = new VideoGrid($con, $userLoggedInObj);

        echo $videoGrid->create(null, null, false);
    ?>
</div>

<?php
    require_once('./includes/footer.php');
?>