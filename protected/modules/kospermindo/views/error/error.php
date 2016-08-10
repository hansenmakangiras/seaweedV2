<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Error'; ?></strong>
    </li>
  </ol>
  <h2>Error Handler</h2><br/>
</div>
<div class="page-error-404">

  <div class="error-symbol">
    <i class="entypo-attention"></i>
  </div>

  <div class="error-text">
    <h2><?php echo $code; ?></h2>
    <p><?php echo CHtml::encode($message); ?></p>
  </div>

  <hr />
<!--  --><?php //if($code === 404) { ?>
<!--  <div class="error-text">-->
<!---->
<!--    Search Pages:-->
<!---->
<!--    <br />-->
<!--    <br />-->
<!---->
<!--    <div class="input-group minimal">-->
<!--      <div class="input-group-addon">-->
<!--        <i class="entypo-search"></i>-->
<!--      </div>-->
<!---->
<!--      <input type="text" class="form-control" placeholder="Search anything..." />-->
<!--    </div>-->
<!--    --><?php //} ?>

  </div>
