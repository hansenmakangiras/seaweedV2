<div class="col-md-12">
  <?php if (!empty($pesan)) { ?>
    <div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <?= $pesan; ?>
    </div>
  <?php } ?>
  <div class="">
    <div class="">
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'book-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal validate',
        ),
      )); ?>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <div class="col-md-4">
          <?php echo $form->dropDownList($model_kelompok, 'idgudang',
            CHtml::listData(Gudang::model()->findAllByAttributes(array('status' => 1)), 'id', 'lokasi'),
            array(
              'class'    => 'form-control input-lg',
              'prompt'   => 'Pilih Lokasi Gudang',
              'data-validate' => 'required',
            )); ?>
        </div>
        <div class="col-sm-4">
          <?php echo $form->textField($model_kelompok, 'nama_kelompok',
            array('class' => 'form-control input-lg', 'placeholder' => 'Nama Kelompok', 'data-validate' => 'required')); ?>
        </div>
        <div class="col-md-4">
          <?php if ($model_kelompok->scenario === 'update') { ?>
            <?php echo CHtml::submitButton('S U N T I N G', array("class" => "btn btn-success btn-lg")); ?>
          <?php }else{ ?>
            <?php echo CHtml::submitButton('S I M P A N', array("class" => "btn btn-info btn-lg")); ?>
          <?php } ?>
        </div>
      </div>
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
  ')
;?>
<?php
  Yii::app()->clientScript->registerScript('showNotif','
    $("#add").click(function (e) {
    toastr.error("Please Add Warehose Name First!!!");
    e.preventDefault();
  });
  ');
?>
