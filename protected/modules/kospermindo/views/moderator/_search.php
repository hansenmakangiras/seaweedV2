<?php
  /* @var $this ModeratorController */
  /* @var $model Moderator */
  /* @var $form CActiveForm */
?>

<div class=" col-md-12 wide form">

  <?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
  )); ?>
  <div class="row">
    <div class="col-md-12">

      <div class="form-group">
        <?php echo $form->labelEx($model, 'id_petani', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'id_petani',
            array('class' => 'form-control')); ?>
          <span class="description"> <?php echo $form->error($model, 'id_petani'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'moderator_nama', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'moderator_nama',
            array('class' => 'form-control', 'data-validate' => 'required', 'size' => 60, 'maxlength' => 255)); ?>
          <span class="description"><?php echo $form->error($model, 'moderator_nama'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'is_petani', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'is_petani',
            array('class' => 'form-control', 'data-validate' => 'required')); ?>
          <span class="description"><?php echo $form->error($model, 'is_petani'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'status',
            array('class' => 'form-control', 'data-validate' => 'required')); ?>
          <span class="description"><?php echo $form->error($model, 'status'); ?></span>
        </div>
      </div>

      <div class="form-group buttons">
        <div class="col-sm-8 col-sm-offset-2">
          <?php echo CHtml::tag('button', array(
            'name'  => 'btnSubmit',
            'type'  => 'submit',
            'class' => 'btn btn-lg btn-success',
          ),
            '<i class="entypo-search"></i> Search'); ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->endWidget(); ?>

</div><!-- search-form -->