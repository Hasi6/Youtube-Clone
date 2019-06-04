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
    }
?>