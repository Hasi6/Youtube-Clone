<?php
class VideoProcessor {

    private $con;
    private $sizeLimit = 1000000000;
    private $supportedVideoTypes = array("mp4","flv","mkv","vob","wvm","avi","mpg","3gp","swf","webm");
    private $ffmpegPath;

    public function __construct($con) {
        $this->con = $con;
        $this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg.exe");
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        
        //Every Browser does not support the any video format  so we need to convert them to mp4 to do that we need to save the file in temp location and after convertion done we can simply delete the original file
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]); //base name take the name of the video file 

        $tempFilePath = str_replace(" ", "_", $tempFilePath); //in temppath if there is spaces it will replace form _ and again save the tempfilepath

        // Check video data like video type, size, and others has erros or not
        $isValidData = $this->processData($videoData, $tempFilePath);

        if(!$isValidData){
            return false;
        }

        if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {

            $finalFilePath = $targetDir . uniqid() . ".mp4" ;

            // Check video details is valid
            if(!$this->insetVideodata($videoUploadData, $finalFilePath)){
                $this->messages("Insert Query Failed","danger");
                return false;
            }
            if(!$this->convertvideoToMp4($tempFilePath, $finalFilePath)){
                $this->messages("Upload Failed","danger");
                return false;
            }
            $this->messages("Video Uploaded Successfully","success");
        }
    }

    // Check video data like video type, size, and other Function
    private function processData($videoData, $filePath) {
        //Store the video extention like .mp4
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);

        

        // check videoSize
        if(!$this->isValidSize($videoData)){

        // File is too large message
            $this->messages("File is too large can't be more than 1GB","danger");
            return false;
        }
        //Check uploaded file type is a Video 
        else if(!$this->isValidType($videoType)){

            // if File is not a Video display Message
            $this->messages("Your Upload file is not a Video, Please Select a Video and Try Again","danger");
            return false;
        }

        else if ($this->hasError($videoData)){
            $this->messages("Error Code". $videoData["error"],"danger");
            return false;
        }
        return true;
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

    // Check if has another error
    private function hasError($videoData){
        return $videoData["error"] != 0;
    }

    // Check video details is valid
    private function insetVideoData($uploadData,$filePath){
        $query = $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath) 
        VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)"); //When we using :title and :uploadedBy Like that after we can add values them
        
        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
}

    // Convert Video file to mp4
    public function convertvideoToMp4($tempFilePath, $finalFilePath){
        $cmd = "$this->ffmpegPath  -i  $tempFilePath   $finalFilePath  2>&1";

        $outputLog = array();
        exec($cmd, $outputLog, $returnCode);

        if($returnCode != 0){
            //command Failed
            foreach($outputLog as $line){
                $this->messages($line, 'danger');
                echo "<br/>";
            }
            return false;
        }
        else{
            return true;
        }
    }

    //Display Messages
    private function messages($message,$type){
    echo "<div class='container' align='center'>
                <div class='alert alert-$type'>
                    <h4>$message</h4>
                </div>
        </div>";
        }
}
?>