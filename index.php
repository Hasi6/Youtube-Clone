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
    },10000);
</script>

<?php
    require_once('./includes/footer.php');
?>