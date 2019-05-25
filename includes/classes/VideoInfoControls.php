<?php
    require_once('./includes/classes/ButtonProvider.php');
?>
<?php
    class VideoInfoControls{
        private $video;
        private $userLoggedInObj;

        public function __construct($video, $userLoggedInObj){
            $this->video = $video;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function create(){
            $likeButton = $this->createLikeButton();
            $dislikeButton = $this->createDisLikeButton();
            return "<div class='controls'>
                        $likeButton
                        $dislikeButton
                    </div>";
        }
        
        
        private function createLikeButton(){
            $text = $this->video->getLikes();
            $videoId = $this->video->getId();
            $action = "likeVideo(this, $videoId)";
            $class = "LikeButton";

            $imageSrc = "assets/images/icons/thumb-up.png";

            // Change Button images if already liked

            return ButtonProvider::createButton($text,$imageSrc,$action,$class);
        }

        private function createDisLikeButton(){
            $text = $this->video->getDisLikes();
            $videoId = $this->video->getId();
            $action = "dislikeVideo(this, $videoId)";
            $class = "DislikeButton";

            $imageSrc = "assets/images/icons/thumb-down.png";

            // Change Button images if already disliked
            
            return ButtonProvider::createButton($text,$imageSrc,$action,$class);
        }
    }
?>


