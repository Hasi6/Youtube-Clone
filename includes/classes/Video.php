<?php
    class Video{

        private $con;
        private $sqlDate;
        private $userLoggedInObj;

        public function __construct($con, $input, $userLoggedInObj){
            $this->con = $con;
            $this->userLoggedInObj = $userLoggedInObj;


            if(is_array($input)){
                $this->sqlDate = $input;
            }
            else{
            
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");

            $query->bindParam(":id", $input);
            $query->execute();

            $this->sqlDate = $query->fetch(PDO::FETCH_ASSOC);
            }



            
        }

        //Get Video id 
        public function getId(){
            return $this->sqlDate["id"];
        }

        //Get Video Uploaded by
        public function getUploadedBy(){
            return $this->sqlDate["uploadedBy"];
        }

        //Get Video Title to Display
        public function getTitle(){
            return $this->sqlDate["title"];
        }

        //Get Video Description to Display
        public function getDescription(){
            return $this->sqlDate["description"];
        }

        //Get Video Privacy
        public function getPrivacy(){
            return $this->sqlDate["privacy"];
        }

        //Get Video Filepath
        public function getFilePath(){
            return $this->sqlDate["filePath"];
        }
        //Get Video category
        public function getCategory(){
            return $this->sqlDate["category"];
        }

        //Get Video Upload date
        public function getUploadDate(){
            return $this->sqlDate["uploadDate"];
        }

        //Get Video Views
        public function getViews(){
            return $this->sqlDate["views"];
        }

        //Get Video Duration
        public function getDuration(){
            return $this->sqlDate["duration"];
        }

        // Increment the views
        public function incrementViews(){
            $query = $this->con->prepare("UPDATE videos SET views = views+1 WHERE id=:id");
            $query->bindParam(":id", $videoId);

            $videoId = $this->getId();

            $query->execute();

            $this->sqlDate["views"] = $this->sqlDate["views"] + 1;
        }

        // Get Likes to show in the video

        public function getLikes(){
            $query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE videoId =:videoId");
            $query->bindParam(":videoId", $videoId);

            $videoId = $this->getId();

            $query->execute();

            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data["count"];
        }

        // Get DisLikes to show in the video

        public function getDisLikes(){
            $query = $this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE videoId =:videoId");
            $query->bindParam(":videoId", $videoId);

            $videoId = $this->getId();

            $query->execute();

            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data["count"];
        }

        // Like Function
        public function like(){
            
        }


    }

?>