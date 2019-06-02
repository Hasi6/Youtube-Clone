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
        if($showFilter){
            // get our current page link
            $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
            $urlArray = parse_url($link);
            
            $query = $urlArray["query"];

            parse_str($query, $params);

            unset($params["orderBy"]);

            $newQuery = http_build_query($params);

            $newUrl = basename($_SERVER["PHP_SELF"]) . "?" . $newQuery;

            $filter = "<div class='right'>
                        <span>Order by: </span>
                        <a href='$newUrl&orderBy=uploadDate'>Most Recent</a>
                        <a href='$newUrl&views=uploadDate'>Most Viewed</a>
                        </div>";
        }


        return "<div class='videoGridHeader'>
                        <div class='left'>
                            $title
                        </div>
                        $filter
                  </div>";
    }

    public function createLarge($videos, $title, $showFilter){
        $this->gridClass .= " large";
        $this->largeMode = true;
        return $this->create($videos, $title, $showFilter);
    }

}


?>