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
        <label class="col-sm-2 control-label">Lokasi</label>
        <div class="col-sm-4">
          <?php echo $form->dropDownList($gudang,'lokasi',
            CHtml::listData(Gudang::model()->findAllByAttributes(array('status'=>1)),'lokasi','lokasi'),
            array('class' => 'form-control',
                  'prompt'=>'Pilih Lokasi Gudang',
                  'required' => true,
                  'ajax' => array(
                    'type' =>'POST',
                    'url' => CController::createUrl('users/listgudang'),
                    'update'=>'#'.CHtml::activeID($kelompok,'nama_kelompok'),
                    'beforeSend'=>'function(){
                      $("#nama_kelompok").find("option").remove();
                      $("#nama_petani").find("option").remove();
                      $("#jenis_komoditi").find("option").remove();
                    }',
                  )
            )
          );?>

        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Kelompok</label>
        <div class="col-sm-4">
          <?php echo $form->dropDownList($kelompok,'nama_kelompok',(!$gudang->isNewRecord) ? $gudang->lokasilist() : array(),
            array(
              'class' => 'form-control',
              'ajax'  => array(
                'type'=> 'POST',
                'url' => CController::createUrl('users/listkelompok'),
                'update' =>'#'.CHtml::activeID($petani,'nama_petani'),
                'beforeSend' => 'function(){
                    $("#nama_petani").find("option").remove();
                    $("#jenis_komoditi").find("option").remove();
                  }',
                )
              )
            );?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Petani</label>
        <div class="col-sm-4">
          <?php echo $form->dropDownList($petani,'nama_petani',(!$kelompok->isNewRecord) ? $kelompok->kelompoklist() : array(),
            array(
              'class' => 'form-control',
              'ajax'  => array(
                'type'=> 'POST',
                'url' => CController::createUrl('users/listkomoditi'),
                'update' =>'#'.CHtml::activeID($petani,'jenis_komoditi'),
                //'update' => '$jenis_komoditi',
                //'data'=>array('nilai'=>'js:this.value'),
                  //'update'=>'#idkelompok',
                //'success'=>'function(resp){ console.log(resp); $("#jenis_komoditi").html(resp); }')));
                'beforeSend' => 'function(){
                    $("#jenis_komoditi").find("option").remove();
                  }',
                )
              )
            );?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Komoditi</label>
        <div class="col-sm-4">
          <?php echo $form->dropDownList($petani,'jenis_komoditi',(!$petani->isNewRecord) ? $petani->komoditilist() : array(),
            array(
              'class' => 'form-control',
                )
          );?>
          <!-- <?php echo CHtml::dropDownList('jenis_komoditi','',  array('prompt'=>'Pilih Komoditi'),array('class'=>'form-control','required'=>true)); ?> -->
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Total Panen</label>
        <div class="col-sm-4">
          <?php echo $form->textField($komoditi, 'total_panen',
            array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kadar Air</label>
        <div class="col-sm-4">
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
