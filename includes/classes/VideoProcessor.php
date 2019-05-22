<?php
class VideoProcessor {

    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        
        //Every Browser does not support the any video format  so we need to convert them to mp4 to do that we need to save the file in temp location and after convertion done we can simply delete the original file
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]); //base name take the name of the video file 

        $tempFilePath = str_replace(" ", "_", $tempFilePath); //in temppath if there is spaces it will replace form _ and again save the tempfilepath

        echo $tempFilePath;
    }
}
?>