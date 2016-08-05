<div class="col-md-12">
<!--  --><?php //echo Helper::dd($pesan); ?>
  <?php if (!empty($pesan)) { ?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <?= $pesan; ?>
    </div>
  <?php } ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'commodity-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal',
        ),
      )); ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">ID Komoditi</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="<?php echo $idKomoditi; ?>" disabled>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Komoditi</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'nama_komoditi', array('class' => 'form-control')); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Seaweed</label>
        <div class="col-sm-10">
          <?php //echo $form->textField($model, 'jenis_komoditi', array('class' => 'form-control')); ?>
          <?php echo $form->dropDownList($model_komoditi_tipe, 'type', $model_komoditi_tipe->getKomoditiTipe(),array('class' => 'form-control')); ?>
        </div>
      </div>
      <?php //Helper::dd($model_komoditi_tipe->getKomoditiTipe()) ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">Sub Seaweed</label>
        <div class="col-sm-10">
          <?php //echo $form->textField($model, 'jenis_komoditi', array('class' => 'form-control')); ?>
          <?php echo $form->dropDownList($model_komoditi_tipe, 'type', $modelSubType->listSubType(),array('class' => 'form-control')); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kadar Air</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'kadar_air', array('class' => 'form-control')); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Panjang Bentangan</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'jumlah_bentangan', array('class' => 'form-control')); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($model, 'status', array('Aktif','Non Aktif'),array('class' => 'form-control')); ?>
        </div>
      </div>
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
<?php
//  Yii::app()->clientScript->registerScript('showSub','
//    var elem = $("#KomoditiType_Type").find(":selected").text();
//    //var elem = $("#KomoditiType_Type").text();
//    console.log(elem);
//  ');
//?>
