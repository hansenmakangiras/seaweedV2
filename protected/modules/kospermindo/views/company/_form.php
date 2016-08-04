<div class="col-md-12">
  <?php if (!empty($pesan)) { ?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <?= $pesan; ?>
    </div>
  <?php } ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'company-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal',
        ),
      )); ?>
      <?php echo $form->errorSummary($model); ?>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'prefix', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'prefix',
            array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
          <?php echo $form->error($model, 'prefix'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'name',
            array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
          <?php echo $form->error($model, 'name'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'type',
            array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
          <?php echo $form->error($model, 'type'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'location', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'location',
            array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
          <?php echo $form->error($model, 'location'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'telephone', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'telephone',
            array('size' => 20, 'maxlength' => 20, 'class' => 'form-control')); ?>
          <?php echo $form->error($model, 'telephone'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'address', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textArea($model, 'address', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
          <?php echo $form->error($model, 'address'); ?>

          <?php //echo $form->textField($model,'level_id',array('class' => 'form-control')); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'komoditi_type', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <input class="form-control" name="Company[komoditi_type]" value="<?= KomoditiType::trKomoditiTipe($model->komoditi_type); ?>" disabled />
<!--          --><?php //echo $form->textField($model, 'komoditi_type', array('class' => 'form-control')); ?>
<!--          --><?php //echo $form->dropDownList($komoditiTipe, 'type', $komoditiTipe->getKomoditiTipe(), array('class' => 'form-control')); ?>
          <?php echo $form->error($model, 'komoditi_type'); ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
          <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',
            array("class" => "btn btn-primary")); ?>
        </div>
      </div>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>


