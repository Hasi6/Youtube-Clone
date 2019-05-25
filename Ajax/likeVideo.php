<?php
    require('../includes/config.php');
    require('../includes/classes/Video.php');
    require('../includes/classes/User.php');

?>

<?php

    $username = $_SESSION["userLoggedIn"];
    $videoId = $_POST["videoId"];

    $userLoggedInObj = new User($con, $username);
    $video = new Video($con, $videoId, $userLoggedInObj);

    echo $video->like();

?>