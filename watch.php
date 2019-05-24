<?php
    require_once('./includes/header.php');
    require_once('./includes/classes/VideoPlayer.php');
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

<div class="watchLeftColumn">
    <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(true);
    ?>
</div>

<div class="suggestions">

</div>

<?php
    require_once('./includes/footer.php');
?>