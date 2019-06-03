<?php 
require_once("includes/header.php");
?>

<?php 

    $subscriptionProvider = new SubscriptionProvider($con, $userLoggedInObj);
    $videos = $subscriptionProvider->getVideos();

    $videoGrid = new VideoGrid($con, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">
    <?php
    
        if(sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "New Videos From Your Subscriptions", false);
        }
        else{
            echo "No New Vidoes to Show";
        }
    
    ?>
</div>