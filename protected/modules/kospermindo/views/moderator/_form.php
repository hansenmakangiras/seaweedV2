<?php
  /* @var $this ModeratorController */
  /* @var $model Moderator */
  /* @var $form CActiveForm */
?>

<div class="col-md-12 form">

  <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'moderator-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions'          => array(
      'class' => 'form-horizontal',
    ),
  )); ?>
 <div class="row">
   <div class="alert alert-info">
     <i class="entypo-info"></i>
     Fields with <span class="required">*</span> are required.
   </div>
   <?php if($form->errorSummary($model)){ ?>
     <div class="alert alert-danger">
       <i class="entypo-danger"></i>
       <?php echo $form->errorSummary($model); ?>
     </div>
   <?php } ?>

 </div>
  <div class="row">
    <div class="col-md-12">

      <div class="form-group">
        <?php echo $form->labelEx($model, 'id_petani', array('class' =>'col-sm-2 control-label input-lg' )); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'id_petani',
            array('class' => 'form-control input-lg')); ?>
          <span class="description"> <?php echo $form->error($model, 'id_petani'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'moderator_nama', array('class' =>'col-sm-2 control-label input-lg' )); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'moderator_nama',
            array('class' => 'form-control input-lg', 'data-validate' => 'required','size' => 60, 'maxlength' => 255)); ?>
          <span class="description"><?php echo $form->error($model, 'moderator_nama'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'is_petani', array('class' =>'col-sm-2 control-label input-lg' )); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'is_petani',
            array('class' => 'form-control input-lg', 'data-validate' => 'required')); ?>
          <span class="description"><?php echo $form->error($model, 'is_petani'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'status', array('class' =>'col-sm-2 control-label input-lg' )); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model, 'status',
            array('class' => 'form-control input-lg', 'data-validate' => 'required')); ?>
          <span class="description"><?php echo $form->error($model, 'status'); ?></span>
        </div>
      </div>

      <div class="form-group buttons">
        <div class="col-sm-8 col-sm-offset-2">
          <?php echo CHtml::tag('button', array(
            'name'=>'btnSubmit',
            'type'=>'submit',
            'class'=>'btn btn-lg btn-success',
            ),
            $model->isNewRecord ? '<i class="entypo-plus"></i> Create' : '<i class="entypo-save"></i> Save'); ?>
        </div>
      </div>
    </div>
  </div>


  <?php $this->endWidget(); ?>

</div><!-- form -->