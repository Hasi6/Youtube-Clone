<?php
    class VideoPlayer{
        
        private $video;

        public function __construct($video){
            $this->video = $video;
        }

        public function create($autoPlay){
            if($autoPlay){
                $autoPlay = "autoPlay";
            }
            else{
                $autoPlay = "";
            }

            $filePath = $this->video->getFilePath();
            return "<Video class='videoPlayer' controls $autoPlay>
                <source src='$filePath' type='video/mp4' />
                Your Browser Does not Support the mp4 Format
            </Video>";
        }
    }

?>