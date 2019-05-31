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
            $numberOfComments = $this->video->getNumberOfComments();
            $postedBy = $this->userLoggedInObj->getUsername();
            $videoId = $this->video->getId();

            $profileButton = ButtonProvider::createProfileButton($this->con, $postedBy);
            $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
            $commentButton = ButtonProvider::createButton("COMMENT",null, $commentAction, "postComment");

            //Comment HTML
            $comments = $this->video->getComments();
            $commentItems = "";
            foreach($comments as $comment){
                $commentItems .= $comment->create();
            }


            return "<div class='commentSection'>
                        <div class='header'>
                            <span class='commentCount'>$numberOfComments Comments</span>

                            <div class='commentForm'>
                                $profileButton
                                <textarea class='commentBody' placeholder='Add Comment'></textarea>
                                $commentButton
                            </div>
                        </div>
                        <div class='comments'>
                        $commentItems
                        </div>
                    </div>";
        }

    }
    
?>

