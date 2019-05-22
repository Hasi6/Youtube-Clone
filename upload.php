<?php
    require_once('./includes/header.php');
    require_once('./includes/classes/videoDetails.php');
?>

<div class="column">
    
<?php 
    $formProvider = new VideoDetailsFromProvider($con);
    echo $formProvider->createUploadForm();

    

?>

</div>






<?php
    require_once('./includes/footer.php');
?>