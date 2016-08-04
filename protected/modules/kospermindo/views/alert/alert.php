<?php if(Yii::app()->user->hasFlash('success')){ ?>
  <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
    <strong><?php echo Yii::app()->user->getFlash('success'); ?></strong>
  </div>
<?php } elseif(Yii::app()->user->hasFlash('error')) {  ?>
  <div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
    <strong> <?php echo Yii::app()->user->getFlash('error'); ?></strong>
  </div>
<?php } ?>
<?php
  Yii::app()->clientScript->registerScript('close','
    
  ',CClientScript::POS_END);
?>
