<?php
    require_once('./includes/header.php');
?>

<div class="alert alert-info" style="width:100%" align="center">
<?php
    $name = $_SESSION["userLoggedIn"] ;
    if(isset($_SESSION["userLoggedIn"])){
        echo "<h3>You Logged as $name</h3>";
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