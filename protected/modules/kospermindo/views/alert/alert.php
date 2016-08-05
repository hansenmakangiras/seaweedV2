<div id="pesan">
  <?php if(Yii::app()->user->hasFlash('success')){ ?>
    <div class="alert alert-success">
      <strong><?php echo Yii::app()->user->getFlash('success'); ?></strong>
    </div>
  <?php } elseif(Yii::app()->user->hasFlash('error')) {  ?>
    <div class="alert alert-danger">
      <strong> <?php echo Yii::app()->user->getFlash('error'); ?></strong>
    </div>
  <?php } elseif(Yii::app()->user->hasFlash('info')){ ?>
    <div class="alert alert-info">
      <strong> <?php echo Yii::app()->user->getFlash('info'); ?></strong>
    </div>
  <?php }  ?>
</div>
<?php
  Yii::app()->clientScript->registerScript('close','
    setTimeout(function () {
      $("#pesan").addClass("hidden");
    }, 5000); 
  ',CClientScript::POS_END);
?>
