<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

// <!-- IF Files not not send to the pages show the message -->

$message = "<div class='container' align='center'>
                <div class='alert alert-info'>
                    <h4>No Upload File Found</h4>
                </div>
            </div>";

if(!isset($_POST["uploadButton"])) {
    echo $message;
    exit();
}

// Send upload file data to the VideoUploadData.php 
$videoUpoadData = new VideoUploadData(
                            $_FILES["fileInput"], 
                            $_POST["titleInput"],
                            $_POST["descriptionInput"],
                            $_POST["privacyInput"],
                            $_POST["categoryInput"],
                            "REPLACE-THIS"    
                        );

// Upload video
$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUpoadData);

// 3) Check if upload was successful



?>
