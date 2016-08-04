<div class="col-md-12">
        <?php if(!empty($pesan)) { ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                <?= $pesan; ?>
            </div>
        <?php }?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'book-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array(
                    'class' => 'form-horizontal'
                )
            )); ?>
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ID Gudang</label>
                    <div class="col-sm-10">
                        <?php echo $form->dropDownList($model,'id_gudang',$model->getIdGudang(),array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Koordinator</label>
                    <div class="col-sm-10">
                    <?php echo $form->textField($model,'nama_koordinator',array('class' => 'form-control')); ?>
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
