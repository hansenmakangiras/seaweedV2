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
        'id'                   => 'book-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal',
        ),
      )); ?>
      
      <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Warehouse Name</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_koordinator, 'nama_gudang',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Location</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_koordinator, 'lokasi_gudang',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
       <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Warehouse Coordinator</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_koordinator, 'nama_koordinator',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <hr>
      <div class="form-group">
      <?php if($update=='gagal'){ ?>
        <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'username',
            array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
          <?php echo $form->error($model, 'username'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->passwordField($model, 'password',
            array('size' => 60, 'maxlength' => 255, 'class' => 'form-control','required' =>TRUE)); ?>
          <?php echo $form->error($model, 'password'); ?>
        </div>
      </div>
      <?php } ?>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
          <?php echo CHtml::submitButton('S I M P A N', array("class" => "btn btn-primary")); ?>
        </div>
      </div>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>
