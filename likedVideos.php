<?php 
require_once("includes/header.php");
require_once("includes/classes/LikedVideosProvider.php");
?>

<?php 

    if(!User::isLoggedIn()){
        header("Location: login.php");
    }


    $likedVideosProvider = new LikedVideosProvider($con, $userLoggedInObj);
    $videos = $likedVideosProvider->getVideos();

    $videoGrid = new VideoGrid($con, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">
    <?php
    
        if(sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "Videos That You Have Liked", false);
        }
        else{
            echo "No New Vidoes to Show";
        }
    
    ?>
</div>