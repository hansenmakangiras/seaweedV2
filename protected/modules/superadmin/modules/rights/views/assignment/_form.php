<div class="col-md-12">
  <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'assignment-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
      'class' => 'form-horizontal'
    )
  )); ?>
  <div class="form-group">
    <label class="col-sm-1 control-label"><?php echo Rights::t('core', 'Name'); ?></label>
    <div class="col-sm-11">
      <?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions,array('class' => 'form-control','required'=>true)); ?>
      <span class="help-block m-b-none"><?php echo $form->error($model, 'itemname'); ?></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8 col-sm-offset-1">
      <?php echo CHtml::submitButton(Rights::t('core', 'Assign'), array("class" => "btn btn-sm btn-primary")); ?>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>
