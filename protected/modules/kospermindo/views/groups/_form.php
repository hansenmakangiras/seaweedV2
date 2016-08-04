<?php if($level ==1) { ?>
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
      
      <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Lokasi Gudang</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_koordinator, 'lokasi_gudang',
            array('class' => 'form-control', 'required' => true)); ?>
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
<?php }elseif ($level==2) { ?>
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
        <label class="col-sm-2 control-label">Nama Kelompok</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_kelompok, 'nama_kelompok',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="hr-dashed"></div>
      
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
</div>
<?php }elseif ($level==3) { ?>
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
        <label class="col-sm-2 control-label">Nama Petani</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_petani, 'nama_petani',
            array('class' => 'form-control', 'required' => true)); ?>
        </div>
      </div>
      <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Alamat', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'alamat',
              array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','required' =>TRUE)); ?>
            
          </div>
        </div>
        <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Nomor Telepon', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model_petani, 'no_telp',
            array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>

        </div>
      </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Nomor Identitas', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'nmr_identitas',
              array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
            
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Tempat Lahir', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'tempat_lahir',
              array('class' => 'form-control','required' =>TRUE)); ?>
            
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Tanggal Lahir', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo $form->textField($model_petani, 'tanggal_lahir',
              array('class' => 'form-control datepicker','data-format' =>"yyyy-mm-dd",'required' =>TRUE)); ?>
            
          </div>
        </div>
        <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Luas Lokasi', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model_petani, 'luas_lokasi',
            array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Panjang Bentangan', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($model_petani, 'jumlah_bentangan',
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