<?php
    require_once('./includes/header.php');
?>

<div class="alert alert-info" style="width:100%" align="center">
<?php
    if(isset($_SESSION["userLoggedIn"])){
        echo "<h3>Welcome " . $userLoggedInObj->getUsername() . "</h3>";
    }
    else{
        echo "<h3>Welcome Guest Get Full Experiance Please Login to HasiTube</h3>";
    }
?>
</div>

<script>
    const divs = document.querySelector('.alert');
    setTimeout(function(){
        divs.style.display = 'none';
    },5000);
</script>

<!-- disply Videos -->

<div class="videoSection">

    <?php 
        $videoGrid = new VideoGrid($con, $userLoggedInObj->getUsername());
        echo $videoGrid->create(null, "Videos for You", false)
    ?>

</div>




<?php
    require_once('./includes/footer.php');
?>