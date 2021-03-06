<?php
class VideoProcessor {

    private $con;
    private $sizeLimit = 1000000000;
    private $supportedVideoTypes = array("mp4","flv","mkv","vob","wvm","avi","mpg","3gp","swf","webm");
    private $ffmpegPath;
    private $ffprobePath;

    public function __construct($con) {
        $this->con = $con;
        $this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg.exe");
        $this->ffprobePath = realpath("ffmpeg/bin/ffprobe.exe");
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
            // Check if Video convert currectly
            if(!$this->convertvideoToMp4($tempFilePath, $finalFilePath)){
                $this->messages("Upload Failed","danger");
                return false;
            }

            // check if original file is deleted
            if(!$this->deleteFile($tempFilePath)){
                $this->messages("Upload Failed","danger");
                return false;
            }

            //Check if thumblines added
            if(!$this->generateThumbnails($finalFilePath)){
                $this->messages("Upload Failed could not generate thumbnails","danger");
                return false;
            }

            $this->messages("Video Uploaded Successfully","success");
            return true;
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

    // Delete the Original uploaded video file and keep the coverted one
    private function deleteFile($filePath){
        if(!unlink($filePath)){
            $this->messages("Could not delete $filePath", "danger");
            return false;
        }
        return true;
    }

    // Generate Thumnales
    public function generateThumbnails($filePath){

        $thumbnailSize = "210x118";
        $numThumbnails = 3;
        $pathToThumbnails = "uploads/videos/thumbnails";

        // Get Video Duration
        $duration = $this->getVideoDuration($filePath);

        // get video id 
        $videoId = $this->con->lastInsertId(); //lastInsertid is a build in php function it gives the last insert itsms id

        // Covert Video duration to proper
        $this->updateDuration($duration, $videoId);

        //Create Thumnail images
        for($num = 1; $num <= $numThumbnails; $num++){
            $imagesName = uniqid() . ".jpg";
            $interval = ($duration * 0.8) / $numThumbnails * $num;
            $fullThumbnailPath = "$pathToThumbnails/$videoId-$imagesName";

            $cmd = "$this->ffmpegPath -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";

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

            //Insert thumnails to the database
            $query = $this->con->prepare("INSERT INTO thumbnails(videoid, filePath, selected) VALUES (:videoId, :filePath, :selected)");

            $query->bindParam(":videoId", $videoId);
            $query->bindParam(":filePath", $fullThumbnailPath);
            $query->bindParam(":selected", $selected);

           if($num == 1){
               $selected = 1;
           }
           else{
               $selected = 0;
           }
           
           $success = $query->execute();

           if(!$success){
               $this->messages("Error Inserting Thumnails","danger");
               return false;
           }
        }
        return true;
    }


    // Get Viedo Duration function
   private function getVideoDuration($filePath){
       //We have to convert to int because this will return a string but we need a int
        return (int)shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
   }

    // Covert Video duration to proper Function
   private function updateDuration($duration, $videoId){
        $hours = floor($duration / 3600);
        $mins = floor(($duration - ($hours * 3600)) / 60);
        $secounds = floor($duration % 60);

        if($hours < 1){
            $hours = "";
        }
        else{
            $hours = $hours . ":";
        }
        if($mins < 10){
            $mins = "0" . $mins . ":";
        }
        else{
            $mins = $mins . ":";
        }
        if($secounds < 10){
            $secounds = "0" . $secounds;
        }
        else{
            $secounds = $secounds;
        }

        $duration = $hours.$mins.$secounds;

        $query = $this->con->prepare("UPDATE videos SET duration=:duration WHERE id=:videoId");

        $query->bindParam(":duration", $duration);
        $query->bindParam(":videoId", $videoId);
        $query->execute();

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