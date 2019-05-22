<!-- Requied Files -->
<?php
    require_once('./includes/header.php');
    require_once('./includes/classes/VideoUploadData.php');
    require_once('./includes/classes/VideoProcessor.php');
?>

<!-- IF Files not not send to the pages show the message -->
<?php
    $message = "
        <div class='container'>
            <div class='alert alert-info' align='center'>
                <h4>No Uploads Send To the Page</h4>
            </div>
        </div>";

    if(!isset($_POST["uploadButton"])){
        echo  $message;
        exit();
    }

    //Set video details to variables
    $fileInput = $_POST["fileInput"];
    $titleInput = $_POST["titleInput"];
    $descriptionInput = $_POST["descriptionInput"];
    $privacyInput = $_POST["privacyInput"];
    $categoryInput = $_POST["categoryInput"];
    $uploadedBy = "Hasi";

    // Send upload file data to the VideoUploadData.php 
    $videoUploadDate = new VideoUploadData($fileInput, $titleInput, $descriptionInput, $privacyInput, $categoryInput, $uploadedBy);

    // Upload video
    $videoProcessor = new VideoProcessor($con);
    $wasSuccess = $videoProcessor->upload($videoUploadDate);


?>
