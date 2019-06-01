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

        if($videos == null){
            $gridItems = $this->generateItems();
        } 
        else{
            $gridItems = $this->generateItemsFromVideos($videos);
        }

        $header = "";
        if($title != null){
            $header = $this-> createGridHeader($title, $showFilter);
        }

        return "$header
                <div class='$this->gridClass'>
                    $gridItems
                </div>";
    }

    // if video is not select random videos and display
    public function generateItems(){
        $query =$this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elemenstHtml = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row, $this->userloggedInObj);
            $item = new VideoGridItem($video, $this->largeMode);
            $elemenstHtml .= $item->create();
        }

        return $elemenstHtml;
    }

    // if video is selected display same kind of videos
    public function generateItemsFromVideos($videos){
        $elemenstHtml = "";

        foreach($videos as $video){
            $item = new VideoGridItem($video, $this->largeMode);
            $elemenstHtml .= $item->create();
        }
        return $elemenstHtml;
    }

    // Create video header 
    public function createGridHeader($title, $showFilter){
        $filter = "";

        //Create Filter
        return "<div class='videoGridHeader'>
                        <div class='left'>
                            $title
                        </div>
                        $filter
                  </div>";
    }

}


?>