<?php
    class CommentSection{

        private $con;
        private $video;
        private $userLoggedInObj;

        public function __construct($con, $video, $userLoggedInObj){
            $this->con = $con;
            $this->video = $video;
            $this->userLoggedInObj = $userLoggedInObj;
        }

        public function create(){
            return $this->createCommentSection();
        }

        private function createCommentSection(){
            $comments = $this->video->getNumberOfComments();
            $postedBy = $this->userLoggedInObj->getUsername();
            $videoId = $this->video->getId();

            $profileButton = ButtonProvider::createProfileButton($this->con, $postedBy);
            $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
            $commentButton = ButtonProvider::createButton("COMMENT",null, $commentAction, "postComment");
        }

    }
    
?>

