<?php
require_once("ProfileData.php");
    class ProfileGenerator{

        private $con;
        private $userLoggedInObj;
        private $profileData;

        public function __construct($con, $userLoggedInObj, $profileUsername){
            $this->con = $con;
            $this->userLoggedInObj = $userLoggedInObj;
            $this->profileData = new ProfileData($con, $profileUsername);
        }

        public function create(){
            $profileUsername = $this->profileData->getProfileUsername();
            
            if(!$this->profileData->userExists()){
                return "No Users Found...";
            }
        }
        
    }
?>