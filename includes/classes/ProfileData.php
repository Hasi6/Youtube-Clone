<?php
    class ProfileData{
        private $con;
        private $profileUserObj;

        public function __construct($con, $profileUserObj){
            $this->con = $con;
            $this->profileUserObj = new User($con, $profileUserObj);
        }

        public function getprofileUserObj(){
            return $this->profileUserObj;
        }

        public function getProfileUsername(){
            return $this->profileUserObj->getUsername();
        }

        // check username is in our database or not
        public function userExists(){
            $query = $this->con->prepare("SELECT * FROM users WHERE username =:username");

            $query->bindParam(":username", $profileUsername);

            $profileUsername = $this->getProfileUsername();
            $query->execute();

            return $query->rowCount() != 0;
        }

        public function getCoverPhoto(){
            return "assets/images/Cover Photo/cover.jpg";
        }

        public function getProfileUserFullName(){
            return $this->profileUserObj->getUsername();
        }

        public function getProfilePic(){
            return $this->profileUserObj->getProfilePic();
        }

        public function getsubCount(){
            return $this->profileUserObj->getSubscriberCount();
        }

        public function getUsersVideos(){

            $query =$this->con->prepare("SELECT * FROM videos WHERE uploadedBy=:uploadedBy ORDER BY uploadDate DESC");

            $query->bindParam(":uploadedBy", $username);

            $username = $this->getProfileUsername();

            $query->execute();

            $videos = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $videos[] = new Video($this->con, $row, $this->profileUserObj->getUsername());
            }
            return $videos;
        }
    }
?>