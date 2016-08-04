<div class="col-md-12">
  <?php if (!empty($pesan)) { ?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <?= $pesan; ?>
    </div>
  <?php } ?>
  <div class="panel panel-default" style="margin-bottom: 50px;">
    <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'book-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal',
        ),
      )); ?>
      <div class="hr-dashed"></div>
      <?php if($pesan_group=='berhasil') { if($update=='farmer') {  ?>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Group Name', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($model, 'idkelompok', $model->getIdKelompok(Yii::app()->user->id,1), array('class' => 'form-control','required' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Farmer Name</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_petani, 'nama_petani',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Address', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'alamat',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Phone Number', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'no_telp',
              array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Identity Number', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'nmr_identitas',
              array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Place of Birth', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'tempat_lahir',
              array('class' => 'form-control','required' =>TRUE)); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Date of Birth', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'tanggal_lahir',
              array('class' => 'form-control datepicker','data-format' =>"yyyy-mm-dd",'required' =>TRUE)); ?>
          </div>
        </div>
        
        <hr> 
        <?php }} ?>
      
      <div class="form-group">
        <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'username',
            array('class' => 'form-control','required' =>true)); ?>
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
      
      <!-- <div class="form-group">
        <label class="col-sm-2 control-label">Level</label>
        <div class="col-sm-10">
          <select name="levelUser"class="form-control">
            <option value="user">User</option>
            <option value="moderator">Moderator</option>
          </select>
        </div>
      </div> -->
      
      <div class="hr-dashed"></div>
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
          <?php echo CHtml::submitButton('S I M P A N', array("class" => "btn btn-success")); ?>
        </div>
      </div>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>
