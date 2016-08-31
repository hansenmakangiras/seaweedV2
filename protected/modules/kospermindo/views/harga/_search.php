<?php
/* @var $this HargaController */
/* @var $model HargaSeaweed */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		<div class="col-md-12">

			<div class="form-group">
				<?php echo $form->labelEx($model, 'id', array('class' => 'col-sm-2 control-label')); ?>
				<div class="col-sm-4">
					<?php echo $form->textField($model, 'id',
						array('class' => 'form-control')); ?>
					<span class="description"> <?php echo $form->error($model, 'id'); ?></span>
				</div>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'id_jenis_komoditi', array('class' => 'col-sm-2 control-label')); ?>
				<div class="col-sm-4">
					<?php echo $form->textField($model, 'id_jenis_komoditi',
						array('class' => 'form-control', 'data-validate' => 'required', 'size' => 60, 'maxlength' => 255)); ?>
					<span class="description"><?php echo $form->error($model, 'id_jenis_komoditi'); ?></span>
				</div>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'harga', array('class' => 'col-sm-2 control-label')); ?>
				<div class="col-sm-4">
					<?php echo $form->textField($model, 'harga',
						array('class' => 'form-control', 'data-validate' => 'required')); ?>
					<span class="description"><?php echo $form->error($model, 'harga'); ?></span>
				</div>
			</div>

			<div class="form-group buttons">
				<div class="col-sm-8 col-sm-offset-2">
					<?php echo CHtml::tag('button', array(
						'name'  => 'btnSubmit',
						'type'  => 'submit',
						'class' => 'btn btn-lg btn-success',
					),
						'<i class="entypo-search"></i> Search'); ?>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->