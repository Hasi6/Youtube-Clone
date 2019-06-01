<?php

    class SubscriptionProvider{

        private $con;
        private $userLoggedInObj;

        public function __construct($con, $userLoggedInObj){
            $this->con = $con;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function getVideos(){
            $videos = array();
            $subscriptions = $this->userLoggedInObj->getSubscriptions();

            if(sizeof($subscriptions) > 0 ){
                /* If we subscribe 3 users as a example user1, user2, user3 we have to do some thing like this to get their 
                videos to display in home page we have to create query like this
                SELECT * FROM videos WHERE uploadedby= ? OR uploadedby= ? OR uploadedby= ?*/
                // $query->bindParam(1, "user1");
                // $query->bindParam(2, "user2");
                // $query->bindParam(3, "user3");

                $condition = "";
                $i = 0;

                while($i < sizeof($subscriptions)){
                    if($i == 0){
                        $condition .= "WHERE uploadedBy=?";
                    } else{
                        $condition .= " OR uploadedBy=?";

                    }
                    $i++;
                }

                $videoSql = "SELECT * FROM videos $condition ORDER BY uploadDate DESC";
                $videoQuery = $this->con->prepare($videoSql);

                $i = 1;

                foreach($subscriptions as $sub){
                    $videoQuery->bindParam($i, $subUsername);
                    $subUsername = $sub->getUsername();
                    $i++;
                }
                $videoQuery->execute();

                while($row = $videoQuery->fetch(PDO::FETCH_ASSOC)){
                    $video = new Video($this->con, $row, $this->userLoggedInObj);
                    array_push($videos, $video);
                }

            }
            return $videos;
        }
    }

?>