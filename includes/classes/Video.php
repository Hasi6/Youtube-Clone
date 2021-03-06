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
            $date = $this->sqlDate["uploadDate"];
            return date("M jS, Y", strtotime($date));
        }

        //Get Video Upload Timestamp
        public function getTimestamp(){
            $date = $this->sqlDate["uploadDate"];
            return date("M d, Y G:i:s", strtotime($date));
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
            $id = $this->getId();
            $username = $this->userLoggedInObj->getUsername();

            if($this->wasLikedBy()){
                //user is already liked
                $query = $this->con->prepare("DELETE FROM likes WHERE username = :username AND videoId = :videoId");

                $query->bindParam(":username", $username);
                $query->bindParam(":videoId", $id);

                $query->execute();

                $results = array(
                    "likes" => -1,
                    "dislikes" => 0
                );
                return json_encode($results);

            }
            else{
                //When user press like if user already dislike the video dislike will delete
                $query = $this->con->prepare("DELETE FROM dislikes WHERE username = :username AND videoId = :videoId");

                $query->bindParam(":username", $username);
                $query->bindParam(":videoId", $id);

                $query->execute();
                $count = $query->rowCount();

                //user has not liked yet
                $query = $this->con->prepare("INSERT INTO likes (username, videoId) VALUES (:username, :videoId)");

                $query->bindParam(":username", $username);
                $query->bindParam(":videoId", $id);

                $query->execute();

                $results = array(
                    "likes" => 1,
                    "dislikes" => 0 - $count
                );
                return json_encode($results);
            }
        }

        public function wasLikedBy(){
            $id = $this->getId();

            $query = $this->con->prepare("SELECT * FROM likes WHERE username = :username AND videoId = :videoId");
            $query->bindParam(":username",$username);
            $query->bindParam(":videoId",$id);

            $username = $this->userLoggedInObj->getUsername();
            $query->execute();

           return $query->rowCount() > 0 ;
        }

        public function dislike(){
            $id = $this->getId();
            $username = $this->userLoggedInObj->getUsername();

            if($this->wasDisLikedBy()){
                //user is already liked
                $query = $this->con->prepare("DELETE FROM dislikes WHERE username = :username AND videoId = :videoId");

                $query->bindParam(":username", $username);
                $query->bindParam(":videoId", $id);

                $query->execute();

                $results = array(
                    "likes" => 0,
                    "dislikes" => -1
                );
                return json_encode($results);

            }
            else{
                //When user press like if user already dislike the video dislike will delete
                $query = $this->con->prepare("DELETE FROM likes WHERE username = :username AND videoId = :videoId");

                $query->bindParam(":username", $username);
                $query->bindParam(":videoId", $id);

                $query->execute();
                $count = $query->rowCount();

                //user has not liked yet
                $query = $this->con->prepare("INSERT INTO dislikes (username, videoId) VALUES (:username, :videoId)");

                $query->bindParam(":username", $username);
                $query->bindParam(":videoId", $id);

                $query->execute();

                $results = array(
                    "likes" => 0 - $count,
                    "dislikes" => 1
                );
                return json_encode($results);
            }
        }

        public function wasDisLikedBy(){
            $id = $this->getId();

            $query = $this->con->prepare("SELECT * FROM dislikes WHERE username = :username AND videoId = :videoId");
            $query->bindParam(":username",$username);
            $query->bindParam(":videoId",$id);

            $username = $this->userLoggedInObj->getUsername();
            $query->execute();

           return $query->rowCount() > 0 ;
        }

        public function getNumberOfComments(){
            $query = $this->con->prepare("SELECT * FROM comments WHERE videoId=:videoId");

            $query->bindParam(":videoId", $id);

            $id = $this->getId();

            $query->execute();

            return $query->rowCount();
        }

        public function getComments(){

                $query = $this->con->prepare("SELECT * FROM comments WHERE videoId=:videoId AND responseTo=0 ORDER BY datePosted DESC");
    
                $query->bindParam(":videoId", $id);
    
                $id = $this->getId();
    
                $query->execute();

                $comments = array();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $comment = new Comment($this->con, $row, $this->userLoggedInObj, $id);
                    array_push($comments, $comment);
                }

                return $comments;
    
        }

        public function getThumbnail(){
            $query = $this->con->prepare("SELECT filePath FROM thumbnails WHERE videoid=:videoId AND selected=1");
            $query->bindParam(":videoId", $videoId);
            $videoId = $this->getId();
            $query->execute();

            return $query->fetchColumn();
        }

    }

?>