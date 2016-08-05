<div class="col-md-12">
  <div class="panel minimal minimal-gray">
    <div class="panel-heading">
      <div class="panel-title">
      </div>

    </div>
    <div class="panel-body">
      <?php $this->renderPartial('/alert//alert'); ?>

      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'form-tambah-gudang',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal validate',
        ),
      )); ?>

      <div class="form-group">
        <label class="col-sm-3 control-label">Nama Gudang</label>
        <div class="col-sm-6">
          <?php echo $form->textField($model, 'lokasi',
            array('class' => 'form-control input-lg', 'data-validate' => 'required')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Provinsi', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php echo CHtml::dropDownList('provinsi', '', array('prompt' => 'Pilih Provinsi'),
            array('class' => 'form-control input-lg', 'data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'provinsi'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Kabupaten', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php //echo $form->dropDownList($model,'idkelompok',  array(),array('class'=>'form-control')); ?>
          <?php echo CHtml::dropDownList('kabupaten', '', array('prompt' => 'Pilih Kabupaten'),
            array('class' => 'form-control input-lg', 'data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'kabupaten'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Titik Koordinat', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php echo $form->textField($model, 'titik_koordinat',
            array('size' => 50, 'maxlength' => 250, 'class' => 'form-control input-lg','data-mask' => 'decimal','data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'titik_koordinat'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Luas Gudang', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php echo $form->textField($model, 'luas_gudang',
            array('class' => 'form-control input-lg', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'luas_gudang'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Stok Masuk', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php echo $form->textField($model, 'stok_masuk',
            array('class' => 'form-control input-lg', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'stok_masuk'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Stok Keluar', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php echo $form->textField($model, 'stok_keluar',
            array('class' => 'form-control input-lg', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'stok_keluar'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'Jumlah Stok', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-6">
          <?php echo $form->textField($model, 'jumlah_stok',
            array('class' => 'form-control input-lg', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>
          <?php echo $form->error($model, 'jumlah_stok'); ?>
        </div>
      </div>

      <div class="hr-dashed"></div><br><hr>
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <?php echo CHtml::submitButton('S I M P A N', array("class" => "btn btn-success btn-lg")); ?>
        </div>
      </div>

      <br>
      <br>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>
<?php
  Yii::app()->clientScript->registerScript('closeAlert', '
    var deleteAlert = $(".alert-danger");
        setTimeout(function () {
            deleteAlert.addClass("hide","slow");
            //$("input").val("");
        }, 2500);
  '); ?>
<?php
  Yii::app()->clientScript->registerScript('showNotif', '
    $("#add").click(function (e) {
    toastr.error("Please Add Warehose Name First!!!");
    e.preventDefault();
  });
  ');
?>
