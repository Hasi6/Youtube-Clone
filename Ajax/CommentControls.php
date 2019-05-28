<?php
    require_once('ButtonProvider.php');
?>
<?php
    class CommentControl{
        private $video;
        private $con;
        private $comment;
        private $userLoggedInObj;

        public function __construct($con, $comment, $video, $userLoggedInObj){
            $this->con = $con;
            $this->comment = $comment;
            $this->video = $video;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function create(){

            $replyButton = $this->createReplyButton();
            $likesCount = $this->createLikesCount();
            $likeButton = $this->createLikeButton();
            $dislikeButton = $this->createDisLikeButton();
            $replySection = $this->createReplySection();

            return "<div class='controls'>
                        $likeButton
                        $dislikeButton
                    </div>";
        }

        private function createReplyButton(){
            $text = "REPLY";
            $action = "toggleReply(this)";
            return ButtonProvider::createButton($text, null, $action, null);
        }
        
        private function createLikesCount(){
            $text = $this->comment->getLikes();
            return "";
        }

        private function createReplySection(){
            return "";
        }
        
        private function createLikeButton(){
            $text = $this->video->getLikes();
            $videoId = $this->video->getId();
            $action = "likeVideo(this, $videoId)";
            $class = "LikeButton";

            $imageSrc = "assets/images/icons/thumb-up.png";

            // Change Button images if already liked
            if($this->video->wasLikedBy()){
                $imageSrc = "assets/images/icons/thumb-up-active.png";
            }

            return ButtonProvider::createButton($text,$imageSrc,$action,$class);
        }

        private function createDisLikeButton(){
            $text = $this->video->getDisLikes();
            $videoId = $this->video->getId();
            $action = "dislikeVideo(this, $videoId)";
            $class = "DislikeButton";

            $imageSrc = "assets/images/icons/thumb-down.png";

            // Change Button images if already disliked
            if($this->video->wasDisLikedBy()){
                $imageSrc = "assets/images/icons/thumb-down-active.png";
            }
            return ButtonProvider::createButton($text,$imageSrc,$action,$class);
        }
    }
?>


