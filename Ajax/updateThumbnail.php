<?php
    require_once("../includes/config.php")
?>

<?php
    
    if(isset($_POST['videoId']) && isset($_POST['thumbnailId'])) {
        $videoId = $_POST['videoId'];
        $thumbnailId = $_POST['thumbnailId'];

        // First when the user click the new thumbnail image to set it as a thumbnail image we set selected thumbnail as 0 so when it is done there is no thumbnails to that video
        $query = $con->prepare("UPDATE thumbnails SET selected=0 WHERE videoid=:videoId");
        $query->bindParam(":videoId", $videoId);
        $query->execute();

        // Now we set selected thumbnail as to the selected video
        $query = $con->prepare("UPDATE thumbnails SET selected=1 WHERE id=:thumbnailId");
        $query->bindParam(":thumbnailId", $thumbnailId);
        $query->execute();
    }
    else {
        echo "One or more parameters are not passed into updateThumbnail.php the file";
    }

?>