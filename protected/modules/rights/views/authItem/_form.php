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
      <?php echo $form->textField($model, 'name', array('maxlength'=>255, 'class'=>'form-control')); ?>
      <?php echo $form->error($model, 'name'); ?>
      <span class="help-block m-b-none"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></span>
    </div>
  </div>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'description',array('class'=>'col-sm-2 control-label')); ?>
    <div class="col-sm-10">
      <?php echo $form->textField($model, 'description', array('maxlength'=>255, 'class'=>'form-control')); ?>
      <?php echo $form->error($model, 'description'); ?>
      <span class="help-block m-b-none"><?php echo Rights::t('core', 'A descriptive name for this item.'); ?></span>
    </div>
  </div>

  <?php if( Rights::module()->enableBizRule===true ): ?>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'bizRule',array('class'=>'col-sm-2 control-label')); ?>
    <div class="col-sm-10">
      <?php echo $form->textField($model, 'bizRule', array('maxlength'=>255, 'class'=>'form-control')); ?>
      <?php echo $form->error($model, 'bizRule'); ?>
      <span class="help-block m-b-none"><?php echo Rights::t('core', 'Code that will be executed when performing access checking.'); ?></span>
    </div>
  </div>

  <?php endif; ?>

  <?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'data',array('class'=>'col-sm-1 control-label')); ?>
    <div class="col-sm-11">
      <?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'form-control')); ?>
      <?php echo $form->error($model, 'data'); ?>
      <span class="help-block m-b-none"><?php echo Rights::t('core', 'Additional data available when executing the business rule.'); ?></span>
    </div>
  </div>

  <?php endif; ?>

  <div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
      <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
      <?php echo CHtml::submitButton(Rights::t('core', 'Save'), array("class" => "btn btn-sm btn-primary")); ?>
      <?php echo CHtml::link(Rights::t('core', 'Cancel'), Yii::app()->user->rightsReturnUrl,array('class' => 'btn btn-sm btn-primary')); ?>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>


