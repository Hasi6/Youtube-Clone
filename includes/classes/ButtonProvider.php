<?php

    class ButtonProvider{

    public static $signInFunction = "notSignedIn()";

    public static function createLink($link) {
        return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }

        public static function createButton($text, $imagesSrc, $action, $class){

            if($imagesSrc == null){
                $image = "";
            }
            else{
                $image = "<img src='$imagesSrc'>";
            }

            // Change Action if needed
            $action  = ButtonProvider::createLink($action);
            
            return "<button class='$class' onClick='$action'>
                        $image
                        <span class='text'>$text</span>
                    </button>";
        }

        public static function createProfileButton($con, $username){
            $userObj = new User($con, $username);
            $profilePic = $userObj->getProfilePic();
            $link = "profile.php?username=$username";

            return "<a href='$link'>
                        <img src='$profilePic' class='profilePicture'>
                    </a>";
        }
    }

?>