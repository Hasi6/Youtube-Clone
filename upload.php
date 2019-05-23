<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoDetails.php");
?>


<div class="column">

    <?php
    $formProvider = new VideoDetailsFormProvider($con);
    echo $formProvider->createUploadForm();
    ?>


</div>

<script>
    $("form").submit(function(){
        $("#loding").modal("show");
    });
</script>

<!-- Modal -->
<div class="modal fade" id="loding" tabindex="-1" role="dialog" aria-labelledby="loding" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body" align="center">
            <img src="assets/images/icons/loading.gif" alt="">
            <img src="assets/images/icons/output.gif" alt="">
      </div>
    </div>
  </div>
</div>

<?php require_once("includes/footer.php"); ?>
                