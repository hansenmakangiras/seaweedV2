<div id="pesan" class="row">
  <div class="col-md-12">
    <?php if (Yii::app()->user->hasFlash('success')) { ?>
      <div id="alert-flash" class="alert-view">
        <div class="alert-custom alert-custom-success">
          <i class="entypo-check"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?>
        </div>
      </div>
    <?php }else if(Yii::app()->user->hasFlash('error')){ ?>
      <div id="alert-flash" class="alert-view">
        <div class="alert-custom alert-custom-danger">
          <i class="entypo-cancel"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('error')); ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php
  Yii::app()->clientScript->registerScript('close','
  setTimeout(function() {
    $("#alert-flash").addClass("hidden"); 
  }, 5000);
  ',CClientScript::POS_END);
?>
