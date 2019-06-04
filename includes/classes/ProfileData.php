<?php
    class ProfileData{
        private $con;
        private $profileUserObj;

        public function __construct($con, $profileUserObj){
            $this->con = $con;
            $this->profileUserObj = new User($con, $profileUserObj);
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
    }
?>