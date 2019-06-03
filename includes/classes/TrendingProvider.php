<?php

class TrendingProvider{

        private $con;
        private $userLoggedInObj;

        public function __construct($con, $userLoggedInObj){
            $this->con = $con;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function getVideos(){
            $videos = array();

            // Get Most viewd Videos on last 7 days as trending videos
            // now() is the function get current time date in mysql
            $query = $this->con->prepare("SELECT * FROm videos WHERE uploadDate >= now() - INTERVAL 7 DAY ORDER BY views DESC LIMIT 15");

            $query->execute();

            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $video = new Video($this->con, $row, $this->userLoggedInObj);
                array_push($videos, $video);
            }

            return $videos;
        }

}

?>