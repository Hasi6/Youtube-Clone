<?php
require_once("ButtonProvider.php");
?>

<?php

class Comment{

    private $con;
    private $sqlData;
    private $userLoggedInObj;
    private $videoId;

    public function __construct($con, $input, $userLoggedInObj, $videoId){
        
        if(!is_array($input)){
            $query = $con->prepare("SELECT * FROM comments WHERE id=:id");
            $query->bindParam(":id", $input);

            $query->execute();

            $input = $query->fetch(PDO::FETCH_ASSOC);
        }

        $this->sqlData = $input;
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->videoId = $videoId;

    }

    public function create(){
        $body = $this->sqlData["body"];
        $postedBy = $this->sqlData["postedBy"];
        $profileButton = ButtonProvider::createProfileButton($this->con, $postedBy);
        $timespan = ""; 

        return "<div class='item-container'>
                    <div class='comment'>
                        $profileButton

                        <div class='mainContainer'>

                            <div class='commentHeader'>
                                <a href='profile.php?username=$postedBy'>
                                    <span class='username'> $postedBy</span>
                                </a>
                                <span class='timestamp'>$timespan</span>
                            </div>

                            <div class='body'>
                                $body
                            </div>

                        </div>
                    </div>
                </div>";
    }


}

?>