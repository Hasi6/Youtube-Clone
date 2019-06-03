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

        public static function createHyperLinkButton($text, $imagesSrc, $href, $class){

            if($imagesSrc == null){
                $image = "";
            }
            else{
                $image = "<img src='$imagesSrc'>";
            }

            return "<a href='$href'>
                        <button class='$class'>
                            $image
                            <span class='text'>$text</span>
                        </button>
                    </a>";
        }

        public static function createProfileButton($con, $username){
            $userObj = new User($con, $username);
            $profilePic = $userObj->getProfilePic();
            $link = "profile.php?username=$username";

            return "<a href='$link'>
                        <img src='$profilePic' class='profilePicture'>
                    </a>";
        }

        public static function createEditVideoButton($videoId){
            $href = "editVideo.php?videoId=$videoId";

            $button = ButtonProvider::createHyperLinkButton("Edit Video", null, $href, "edit button");

            return "<div class='editVideoButtonContainer'>
                        $button
                    </div>";
        }

        public static function createSubscribeButton($con, $userToObj, $userLoggedInObj){

            $userTo = $userToObj->getUsername();
            $userLoggedIn = $userLoggedInObj->getUsername();

            $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
            
            if($isSubscribedTo){
                $buttonText = "SUBSCRIBED";
            }
            else{
                $buttonText = "SUBSCRIBE";
            }

            $buttonText .= " " .$userToObj->getSubscriberCount();

            if($isSubscribedTo){
                $buttonClass = "unsubscribe button";
            }
            else{
                $buttonClass = "subscribe button";
            }

            $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

            $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

            return "<diV class='subscribeButtonContainer'>
                        $button
                    </diV>";
        }

        public static function createUserProfileNavigationButton($con, $username){
            if(User::isLoggedIn()){
                return ButtonProvider::createProfileButton($con, $username);
            }
            else{
                return "<a href='login.php'>
                    <span class='signInLink'>Log In</span>
                </a>";
            }
        }
    }

?>