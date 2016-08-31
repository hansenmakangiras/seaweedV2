<!-- Mail Body -->
<div class="row">
  <div class="col-md-12">
    <?php $this->renderPartial('/alert/alert');?>
  </div>
</div>
<div class="mail-body">
  <?php $this->renderPartial('_form',array(
      "model" => $model,
      "messageAdapter" => isset($messageAdapter) ? $messageAdapter: array(),
    ));
  ?>
</div>