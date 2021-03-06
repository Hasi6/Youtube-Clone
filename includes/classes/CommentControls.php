<?php
    require_once('ButtonProvider.php');
?>
<?php
    class CommentControl{
        private $video;
        private $con;
        private $comment;
        private $userLoggedInObj;

        public function __construct($con, $comment, $userLoggedInObj){
            $this->con = $con;
            $this->comment = $comment;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function create(){

            $replyButton = $this->createReplyButton();
            $likesCount = $this->createLikesCount();
            $likeButton = $this->createLikeButton();
            $dislikeButton = $this->createDisLikeButton();
            $replySection = $this->createReplySection();

            return "<div class='controls'>
                        $replyButton
                        $likesCount
                        $likeButton
                        $dislikeButton
                    </div>
                    $replySection";
        }

        private function createReplyButton(){
            $text = "REPLY";
            $action = "toggleReply(this)";
            return ButtonProvider::createButton($text, null, $action, null);
        }
        
        private function createLikesCount(){
            $text = $this->comment->getLikes();

            if($text == 0){
                $text = "";
            }

            return "<span class='likesCount'>$text</span>";
        }

        private function createReplySection(){
            $postedBy = $this->userLoggedInObj->getUsername();
            $videoId = $this->comment->getVideoId();
            $commentId = $this->comment->getId();

            $profileButton = ButtonProvider::createProfileButton($this->con, $postedBy);

            $cancelButtonAction = "toggleReply(this)";
            $cancelButton = ButtonProvider::createButton("Cancel",null, $cancelButtonAction, "cancelComment");

            $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
            $postButton = ButtonProvider::createButton("Reply",null, $postButtonAction, "postComment");


            return "<div class='commentForm hidden'>
                        $profileButton
                        <textarea class='commentBody' placeholder='Add Comment'></textarea>
                        $cancelButton
                        $postButton
                    </div>";
        }
        

        private function createLikeButton(){
            $commentId = $this->comment->getId();
            $videoId = $this->comment->getVideoId();
            $action = "likeComment($commentId, this, $videoId)";
            $class = "LikeButton";

            $imageSrc = "assets/images/icons/thumb-up.png";

            // Change Button images if already liked
            if($this->comment->wasLikedBy()){
                $imageSrc = "assets/images/icons/thumb-up-active.png";
            }

            return ButtonProvider::createButton("",$imageSrc,$action,$class);
        }

        private function createDisLikeButton(){
            $commentId = $this->comment->getId();
            $videoId = $this->comment->getVideoId();
            $action = "dislikeComment($commentId, this, $videoId)";
            $class = "DislikeButton";

            $imageSrc = "assets/images/icons/thumb-down.png";

            // Change Button images if already disliked
            if($this->comment->wasDisLikedBy()){
                $imageSrc = "assets/images/icons/thumb-down-active.png";
            }
            return ButtonProvider::createButton("",$imageSrc,$action,$class);
        }
    }
?>


