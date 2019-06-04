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

            $button = $this->createHeaderButton();

            return "<div class='profileHeader'>
                        <div class='userInfoContainer'>
                            <img class='profileImage' src='$profileImage'>
                            <div class='userInfo'>
                                <span class='title'>$name</span>
                                <span class='subscriberCount'>$subCount Subscribers</span>
                            </div>
                        </div>

                        <div class='buttonContainer'>
                            <div class='buttonItem'>
                                $button
                            </div>
                        </div>
                    </div>";
        }

        public function createTabSection(){
            return "<ul class='nav nav-tabs' role='tablist'>
                        <li class='nav-item'>
                            <a class='nav-link active' id='videos-tab' data-toggle='tab' href='#videos' role='tab' aria-controls='videos' aria-selected='true'>Videos</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' aria-controls='about' aria-selected='false'>About</a>
                        </li>
                    </ul>";
        }

        public function createContentSection(){

            $videos = $this->profileData->getUsersVideos();

            if(sizeof($videos) >0 ){
                $videosGrid = new VideoGrid($this->con, $this->userLoggedInObj);
                $videoGridHtml = $videosGrid->create($videos, null, false);
            }
            else{
                $videoGridHtml = "<span>This User Has No Videos</span>";
            }

            return "<div class='tab-content channelContent'>
                        <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                            $videoGridHtml
                        </div>
                        <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                            About Tab
                        </div>
                    </div>";
        }

        private function createHeaderButton(){
            if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()){
                return "";
            }
            else{
                return ButtonProvider::createSubscribeButton($this->con, $this->profileData->getprofileUserObj(), $this->userLoggedInObj);
            }
        }
        
    }
?>