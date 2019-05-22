<!-- Requied Files -->
<?php
    require_once('./includes/header.php');
?>

<!-- IF Files not not send to the pages show the message -->
<?php
    $message = "
        <div class='container'>
            <div class='alert alert-info' align='center'>
                <h4>No Uploads Send To the Page</h4>
            </div>
        </div>";

    if(!isset($_POST["uploadButton"])){
        echo  $message;
    }

    
?>
