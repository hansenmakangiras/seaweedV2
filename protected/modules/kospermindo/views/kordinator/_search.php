<div class="panel-body">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        )
    )); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">ID Petani</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'id_petani',array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="hr-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Petani</label>
        <div class="col-sm-10">
            <!--                                            <input type="password" class="form-control" name="petani[nama_petani]">-->
            <?php echo $form->textField($model,'nama_petani',array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="hr-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Petani</label>
        <div class="col-sm-10">
            <!--                                            <input type="password" class="form-control" name="petani[idKoor]">-->
            <?php echo $form->textField($model,'id_koor',array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="hr-dashed"></div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <?php echo CHtml::submitButton('Search', array("class" => "btn btn-primary")); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- search-form -->

