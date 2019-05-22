<?php
class VideoProcessor {

    private $con;
    private $sizeLimit = 1000000000;
    private $supportedVideoTypes = array("mp4","flv","mkv","vob","wvm","avi","mpg","3gp");

    public function __construct($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        
        //Every Browser does not support the any video format  so we need to convert them to mp4 to do that we need to save the file in temp location and after convertion done we can simply delete the original file
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]); //base name take the name of the video file 

        $tempFilePath = str_replace(" ", "_", $tempFilePath); //in temppath if there is spaces it will replace form _ and again save the tempfilepath

        // Check video data like video type, size, and other
        $isValidData = $this->processData($videoData, $tempFilePath);

        echo $tempFilePath;
    }

    // Check video data like video type, size, and other Function
    private function processData($videoData, $filePath) {
        //Store the video extention like .mp4
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);

        

        // check videoSize
        if(!$this->isValidSize($videoData)){

        // File is too large message
            $this->messages("File is too large can't be more than 1GB");
            return false;
        }
        //Check uploaded file type is a Video 
        else if(!$this->isValidType($videoType)){

            // if File is not a Video display Message
            $this->messages("Your Upload file is not a Video, Please Select a Video and Try Again");
            return false;
        }
    }

        // check videoSize function
    private function isValidSize($videoSize){
        return $videoSize["size"] <= $this->sizeLimit;
    }

    //Check uploaded file type is a Video function
    private function isValidType($videoType){
        $lowerCase = strtolower($videoType);
        // check video type is supported Type
        return in_array($lowerCase, $this->supportedVideoTypes);
    }

    //Display Messages
    private function messages($message){
    echo "<div class='container' align='center'>
                <div class='alert alert-danger'>
                    <h4>$message</h4>
                </div>
        </div>";
        }
}
?>