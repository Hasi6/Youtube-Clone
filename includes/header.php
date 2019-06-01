<?php
    require('includes/config.php');
    require('includes/classes/ButtonProvider.php');
    require('includes/classes/User.php');
    require_once('includes/classes/Video.php');
    require_once('includes/classes/VideoGrid.php');
?>

<?php

    // if user logged we pass username and if not we pass empty as username
    if(User::isLoggedIn()){
        $userNameLoggedIn = $_SESSION["userLoggedIn"];
    }
    else{
        $userNameLoggedIn = "";
    }

    $userLoggedInObj = new User($con, $userNameLoggedIn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HasiTube</title>

    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Font Awesome -->
    

    <!-- Google jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- js -->
    <script src="./assets/js/commonActions.js"></script>
    <script src="./assets/js/userActions.js"></script>
</head>
<body>

    <div id="pageContainer">
        <div id="mastHeadContainer">
        <button class="navShowHide" type="submit"><img src="./assets/images/icons/menu.png" alt=""></button>

            <div class="searchBarContainer">
                <form action="search.php" method="GET">
                    <input type="search" class="searchBar" name="term" placeholder="Search...">
                    <button class="searchButton">
                        <img src="./assets/images/icons/search.png" alt="">
                    </button>
                </form>
            </div>

            <div class="uploadProfile">
                <a href="upload.php">
                    <img src="./assets/images/icons/upload.png" alt="uoload image" class="upload">
                </a>
                <a href="#">
                    <img src="./assets/images/icons/profile.png" alt="profile pic">
                </a>
            </div>

        </div>

        <div id="sideNavContainer" style="display: none">
            
        </div>

        <div id="mainSectionContainer">
            <div id="mainContentContainer">