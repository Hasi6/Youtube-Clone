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
            return ButtonProvider::createButton("Like","","","");
        }

        private function createDisLikeButton(){
            return ButtonProvider::createButton("Unlike","","","");
        }
    }
?>


