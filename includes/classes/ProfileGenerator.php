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

            $coverPhotoSection = $this->createCoverPhotoSection();
            $headerSection = $this->createHeaderSection();
            $tabSection = $this->createTabSection();
            $contentSection = $this->createContentSection();

            return "<div class='profileContainer'>
                        $coverPhotoSection
                        $headerSection
                        $tabSection
                        $contentSection
                    </div>";

        }

        public function createCoverPhotoSection(){
            $coverPhotoSrc = $this->profileData->getCoverPhoto();
            $name = $this->profileData->getProfileUserFullName();

            return "<div class='coverPhotoContainer'>
                        <img src='$coverPhotoSrc' class='coverphoto'>
                        <span class='channelname'>$name</span>
                    </div>";
        }

        public function createHeaderSection(){
            $profileImage = $this->profileData->getProfilePic();
            $name = $this->profileData->getProfileUserFullName();
            $subCount = $this->profileData->getsubCount();

            return "<div class='profileHeader'>
                        <div class='userInfoContainer'>
                            <img class='profileImage' src='$profileImage'>
                            <div class='userInfo'>
                                <span class='title'>$name</span>
                                <span class='subscriberCount'>$subCount Subscribers</span>
                            </div>
                        </div>

                        <div class='buttonContainer'>
                            
                        </div>
                    </div>";
        }

        public function createTabSection(){

        }

        public function createContentSection(){

        }
        
    }
?>