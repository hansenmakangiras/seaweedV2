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
        'id'                   => 'admin-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal',
        ),
      )); ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Pengguna</label>
        <div class="col-sm-10">
          <?php echo $form->textField($userModel, 'username',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <?php echo $form->textField($profileModel, 'nama_lengkap',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kata Kunci</label>
        <div class="col-sm-10">
          <?php echo $form->passwordField($userModel, 'password',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">No Telepon/Hp</label>
        <div class="col-sm-10">
          <?php echo $form->textField($profileModel, 'no_telp',
            array('class' => 'form-control','data-mask' => 'decimal', 'required' => true)); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($profileModel, 'Identity Number', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($profileModel, 'nmr_identitas',
            array('class' => 'form-control', 'data-mask' => 'decimal', 'required' => true)); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($profileModel, 'Place of Birth', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($profileModel, 'tempat_lahir',
            array('class' => 'form-control', 'required' => true)); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($profileModel, 'Date of Birth', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($profileModel, 'tanggal_lahir',
            array('class' => 'form-control datepicker', 'data-format' => "yyyy-mm-dd", 'required' => true)); ?>

        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($userModel, 'levelid', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($userModel, 'levelid', Level::model()->getLevel(),
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>

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
