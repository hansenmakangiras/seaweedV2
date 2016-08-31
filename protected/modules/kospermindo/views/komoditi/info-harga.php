<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 8/22/2016
   * Time: 12:23 PM
   */
  Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"harga\"]');
		element.addClass('active');
");
?>

<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/komoditi">Komoditi</a>
    </li>
    <li class="active">
      <strong><?php echo 'Harga'; ?></strong>
    </li>
  </ol>
  <h2>Info Harga Komoditi</h2><br/>
</div>
<?php $this->renderPartial('/alert/alert'); ?>
<div class="row">
  <div class="col-md-12">
    <?php $form = $this->beginWidget('CActiveForm', array(
      'id'                   => 'harga-form',
      // Please note: When you enable ajax validation, make sure the corresponding
      // controller action is handling ajax validation correctly.
      // There is a call to performAjaxValidation() commented in generated controller code.
      // See class documentation of CActiveForm for details on this.
      'enableAjaxValidation' => false,
      'htmlOptions'          => array(
        'class' => 'form-horizontal',
      ),
    )); ?>
    <div class="row">
<!--      <div class="alert alert-info">-->
<!--        <i class="entypo-info"></i>-->
<!--        Fields with <span class="required">*</span> are required.-->
<!--      </div>-->
      <?php if($form->errorSummary($model)){ ?>
        <div class="alert alert-danger">
          <i class="entypo-danger"></i>
          <?php echo $form->errorSummary($model); ?>
        </div>
      <?php } ?>

    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="form-group">
          <?php echo $form->labelEx($model, 'id_jenis_komoditi', array('class' =>'col-sm-2 control-label input-lg' )); ?>
          <div class="col-sm-4">
            <?php echo $form->dropDownList($model, 'id_jenis_komoditi', JenisKomoditi::model()->getListSeaweed(),
              array('class' => 'form-control input-lg','data-validate' => 'required')); ?>
            <span class="description"> <?php echo $form->error($model, 'id_jenis_komoditi'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model, 'harga', array('class' =>'col-sm-2 control-label input-lg' )); ?>
          <div class="col-sm-4">
            <?php echo $form->textField($model, 'harga',
              array('class' => 'form-control input-lg','data-mask' => 'currency','data-sign' => 'Rp.','data-validate' => 'required','size' => 60, 'maxlength' => 255)); ?>
            <span class="description"><?php echo $form->error($model, 'harga'); ?></span>
          </div>
        </div>

        <div class="form-group buttons">
          <div class="col-sm-8 col-sm-offset-2">
            <?php echo CHtml::tag('button', array(
              'name'=>'btnSubmit',
              'type'=>'submit',
              'class'=>'btn btn-lg btn-success',
            ),
              $model->isNewRecord ? '<i class="entypo-floppy"></i> Simpan' : '<i class="entypo-save"></i> Ubah'); ?>
          </div>
        </div>
      </div>
    </div>


    <?php $this->endWidget(); ?>
  </div>
</div>

