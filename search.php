<?php
require_once('./includes/header.php');
?>



<?php

if(!isset($_GET["term"]) || $_GET["trem"] == ""){
    echo "Type Something on Search Bar to Search";
    exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == 'views'){
    $orderBy = 'views';
}
else{
    $orderBy = 'uploadDate';
}

?>













<?php
require_once('./includes/footer.php');
?>