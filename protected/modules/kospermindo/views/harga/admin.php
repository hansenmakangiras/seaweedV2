<?php
/* @var $this HargaController */
/* @var $model HargaSeaweed */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#harga-seaweed-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
", CClientScript::POS_END);
?>
<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/harga">Harga</a>
		</li>
		<li class="active">
			<strong><?php echo 'Manage Harga'; ?></strong>
		</li>
	</ol>
	<h2>Manage Harga</h2><br/>
</div>
<div class="row">
	<div class="col-md-12">
    <a href="/kospermindo/harga" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-list"></i>&nbsp;List
      Harga</a>
    <a href="/kospermindo/harga/create" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-plus"></i>&nbsp;Create
      Harga</a>
		<hr>
<!--		<p>-->
<!--			You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>-->
<!--				&lt;&gt;</b>-->
<!--			or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.-->
<!--		</p>-->
		<?php echo CHtml::link('Advanced Search', '#', array('class' => 'btn btn-lg btn-link search-button')); ?>

		<div class="search-form">
			<?php $this->renderPartial('_search', array(
				'model' => $model,
			)); ?>
		</div><!-- search-form -->
		<hr>
		<br>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'harga-seaweed-grid',
			'itemsCssClass' => 'table table-bordered table-responsive',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'id',
				'id_jenis_komoditi',
				'harga',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>
	</div>
</div>



