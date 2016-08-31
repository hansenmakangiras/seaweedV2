<!-- Mail Body -->
<?php $this->renderPartial('/alert/alert');?>
<div class="mail-body">
  <?php $this->renderPartial('_form',array("model" => $model,'id' =>'reply')); ?>
</div>