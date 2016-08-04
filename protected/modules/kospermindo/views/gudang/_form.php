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
          'class' => 'form-horizontal',
        ),
      )); ?>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <div class="col-sm-6">
          <?php echo $form->textField($model_koordinator, 'lokasi',
            array('class' => 'form-control input-lg', 'placeholder' => 'Lokasi Gudang', 'required' => true)); ?>
        </div>
      </div>
      <div class="hr-dashed"></div>
      <!-- <div class="form-group">
        <label class="col-sm-2 control-label">Stok Keluar</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model_koordinator, 'stok_keluar',
            array('class' => 'form-control','data-mask' => 'decimal','required' =>TRUE)); ?>
        </div>
      </div> -->
       <div class="hr-dashed"></div>
      
      <div class="form-group">
      
      <div class="hr-dashed"></div>
      
        <div class="col-sm-12">
          <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
          <?php echo CHtml::submitButton('S I M P A N', array("class" => "btn btn-success")); ?>
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
