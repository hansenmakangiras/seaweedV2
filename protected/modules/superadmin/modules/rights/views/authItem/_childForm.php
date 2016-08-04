<div class="col-md-12">
  <?php if( $model->scenario==='update' ): ?>

    <h2 class="page-title"><?php echo Rights::getAuthItemTypeName($model->type); ?></h2>

  <?php endif; ?>
  <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'assignment-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
      'class' => 'form-horizontal'
    )
  )); ?>
  <div class="form-group">
    <?php echo $form->labelEx($model, 'name',array('class'=>'col-sm-2 control-label')); ?>
    <div class="col-sm-10">
      <?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions, array('class'=>'form-control')); ?>
      <?php echo $form->error($model, 'itemname'); ?>
      <span class="help-block m-b-none"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
      <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
      <?php echo CHtml::submitButton(Rights::t('core', 'Add'), array("class" => "btn btn-sm btn-primary")); ?>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>
