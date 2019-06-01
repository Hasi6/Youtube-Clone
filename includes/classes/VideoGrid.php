<?php

class VideoGrid{

    private $con;
    private $userloggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userloggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter){
        return "<div class='$this->gridClass'>

                </div>";
    }

}


?>