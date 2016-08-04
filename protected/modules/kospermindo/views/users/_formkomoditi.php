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
        <?php echo $form->labelEx($komoditi, 'Nama Petani', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($komoditi, 'id_user', $komoditi->getnamapetani(1), array('class' => 'form-control','required' =>TRUE)); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($komoditi, 'Jenis Komoditi', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <!-- <?php echo $form->dropDownList($komoditi, 'id_user', $komoditi->getnamapetani(Yii::app()->user->id,1), array('class' => 'form-control','required' =>TRUE)); ?> -->
          <select name="jenis_komoditi" class="form-control">
            <option value="4">Sango-Sango Laut</option>
            <option value="6">Spinosom</option>
            <option value="5">Euchema Cotoni</option>
            <option value="1">Gracillaria KW 3</option>
            <option value="2">Gracillaria KW 4</option>
            <option value="3">Gracillaria BS</option>
          </select>
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
