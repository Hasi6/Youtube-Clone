<?php
    require('../includes/config.php');
    require('../includes/classes/Comment.php');
    require('../includes/classes/User.php');

?>

<?php

    $username = $_SESSION["userLoggedIn"];
    $videoId = $_POST["videoId"];
    $commentId = $_POST["commentId"];

    $userLoggedInObj = new User($con, $username);
    $comment = new Comment($con, $commentId, $userLoggedInObj, $videoId);

    echo $comment->dislike();

?>