<?php
    class ProfileGenerator{

        private $con;
        private $userLoggedInObj;
        private $profileUsername;

        public function __construct($con, $userLoggedInObj, $profileUsername){
            $this->con = $con;
            $this->userLoggedInObj = $userLoggedInObj;
            $this->profileUsername = $profileUsername;
        }
        public function create(){
            
        }
    }
?>