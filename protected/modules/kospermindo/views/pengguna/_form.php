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
      <?php if($level==1) { ?>
        <div class="form-group">
          <?php echo $form->labelEx($model_koordinator, 'Penanggung Jawab', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_koordinator, 'nama_koordinator',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_koordinator, 'Nama Gudang', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_koordinator, 'nama_gudang',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_koordinator, 'Lokasi Gudang', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_koordinator, 'lokasi_gudang',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
      <?php } ?>
      <?php if($level==2) { ?>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Penanggung Jawab', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($model, 'idkoordinator', $model->getIdKor(1), array('class' => 'form-control','required' =>TRUE)); ?>
          <?php echo $form->error($model, 'level_id'); ?>
        </div>
      </div>
      <div class="form-group">
          <?php echo $form->labelEx($model_kelompok, 'Nama Kelompok', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_kelompok, 'nama_kelompok',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_kelompok, 'Ketua Kelompok', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_kelompok, 'ketua_kelompok',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
      <?php }elseif($level==3) { ?>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Ketua Kelompok', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($model, 'idkelompok', $model->getIdKel(), array('class' => 'form-control','required' =>TRUE)); ?>
          <?php echo $form->error($model, 'level_id'); ?>
        </div>
      </div>
      <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Nama Petani', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'nama_petani',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Alamat', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'alamat',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Telepon', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'no_telp',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Identitas ktp', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'nmr_identitas',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Tempat Lahir', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'tempat_lahir',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Tanggal Lahir', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'tanggal_lahir',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Luas Lokasi', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'luas_lokasi',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Jenis Komoditi', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'jenis_komoditi',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Kadar Air', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'kadar_air',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Jumlah Bentangan', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'jumlah_bentangan',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
      <?php } ?>
      <div class="hr-dashed"></div>
      <hr>
      <div class="form-group">
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
          <?php echo $form->textField($model, 'password',
            array('size' => 60, 'maxlength' => 255, 'class' => 'form-control','required' =>TRUE)); ?>
          <?php echo $form->error($model, 'password'); ?>
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


