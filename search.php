<?php
require_once('./includes/header.php');
require_once('./includes/classes/SearchResultsProvider.php');
?>



<?php

if(!isset($_GET["term"]) || $_GET["term"] == ""){
    echo "Type Something on Search Bar to Search";
    exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == 'views'){
    $orderBy = 'views';
}
else{
    $orderBy = 'uploadDate';
}

$searchResultsProvider = new SearchresultsProvider($con, $userLoggedInObj);

$videos = $searchResultsProvider->getVideos($term, $orderBy);

$videoGrid = new VideoGrid($con, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">

    <?php
    
        if(sizeof($videos) > 0) {
            echo $videoGrid->createLarge($videos, sizeof($videos) . " Videos are Found", true);
        }
        else{
            echo "No results Found";
        }
    
    ?>

</div>













<?php
require_once('./includes/footer.php');
?>