<?php if($alert==2) { ?>
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
        <label class="col-sm-2 control-label">Nama Kelompok</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_kelompok, 'nama_kelompok',
            array('class' => 'form-control', 'disabled' => true)); ?>
        </div>
      </div>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Ketua Kelompok</label>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($model_kelompok,'ketua_kelompok',$model_kelompok->getNamaPetani(1,$model_kelompok->id),
            array('class' => 'form-control'));?>
        </div>
      </div>
      <hr>
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
<?php } elseif ($alert==3) { ?>
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
        <?php echo $form->labelEx($model, 'Pengguna', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'username',
            array('class' => 'form-control','required' =>true)); ?>
          <?php echo $form->error($model, 'username'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'Sandi', array('class' => 'col-sm-2 control-label')); ?>
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
<?php }elseif ($alert==1) { ?>

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
        <label class="col-sm-2 control-label">Nama Kelompok</label>
        <div class="col-sm-10">
          
        </div>
      </div>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Ketua Kelompok</label>
        <div class="col-sm-10">
          
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Akses</label>
        <div class="col-sm-9">
          <label class="checkbox-inline"><input type="checkbox" value="1" name="akses[]">Data Master</label>
          <label class="checkbox-inline"><input type="checkbox" value="2" name="akses[]">Tambah Petani</label>
          <label class="checkbox-inline"><input type="checkbox" value="3" name="akses[]">Sunting Petani</label>
          <label class="checkbox-inline"><input type="checkbox" value="4" name="akses[]">Hapus Petani</label>
          <label class="checkbox-inline"><input type="checkbox" value="5" name="akses[]">Lihat Komoditi</label>
          <label class="checkbox-inline"><input type="checkbox" value="6" name="akses[]">Lihat Laporan</label>
        </div>
      </div>
      <hr>
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
<?php }elseif ($alert==4) { ?>
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
      <div class="form-group">
        <?php echo $form->labelEx($komoditi, 'ID User', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($komoditi, 'id_user',
            array('class' => 'form-control','disabled' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($komoditi, 'Jenis Komoditi', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($komoditi, 'nama_komoditi',
            array('class' => 'form-control','disabled' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Total Panen</label>
        <div class="col-sm-10">
          <?php echo $form->textField($komoditi, 'total_panen',
            array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kadar Air</label>
        <div class="col-sm-10">
          <?php echo $form->textField($komoditi, 'kadar_air',
            array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
        </div>
      </div>
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

<?php } ?>