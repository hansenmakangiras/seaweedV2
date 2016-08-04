<div class="flashes">
  <?php if (Yii::app()->user->hasFlash('RightsSuccess') === true): ?>
    <div class="flash success alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <strong>Well done!</strong> <?php echo Yii::app()->user->getFlash('RightsSuccess'); ?>
    </div>
  <?php endif; ?>

  <?php if (Yii::app()->user->hasFlash('RightsError') === true): ?>
    <div class="flash error alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <strong>Oh snap!</strong> <?php echo Yii::app()->user->getFlash('RightsError'); ?>
    </div>
  <?php endif; ?>
</div>