<?php
    class VideoInfoSection{

        private $con;
        private $video;
        private $userLoggedInObj;

        public function __construct($con, $video, $userLoggedInObj){
            $this->con = $con;
            $this->video = $video;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function create(){
            return $this->createPrimaryInfo() . $this->createSecoundaryInfo();

        }

        private function createPrimaryInfo(){
            $title = $this->video->getTitle();
            $views = $this->video->getViews();

            return "<div class='videoInfo'>
                <h1>$title</h1>
                <div class='bottomSection'>
                    <span class='views'>$views</span>
                </div>
            </div>";
        }

        private function createSecoundaryInfo(){

        }
    }
    
?>