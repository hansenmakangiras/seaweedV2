<?php
/* @var $this HargaController */
/* @var $model HargaSeaweed */

$this->breadcrumbs=array(
	'Harga Seaweeds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HargaSeaweed', 'url'=>array('index')),
	/*array('label'=>'Manage HargaSeaweed', 'url'=>array('admin')),*/
);
?>
	<div class="headline">
		<ol class="breadcrumb bc-3">
			<li>
				<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
			</li>
			<li>
				<a href="<?= Kospermindo::getBaseUrl(); ?>/harga">Komoditi</a>
			</li>
			<li class="active">
				<strong><?php echo 'Insert'; ?></strong>
			</li>
		</ol>
		<h2>Insert HargaSeaweed</h2><br/>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="/kospermindo/harga/" class="btn btn-success btn-link btn-lg" id="btn-tmbh"><i class="entypo-list"></i>&nbsp;List Harga</a>
			<!-- <a href="/kospermindo/harga/admin" class="btn btn-success btn-link btn-lg" id="btn-tmbh"><i class="entypo-cog"></i>&nbsp;Manage Harga</a> -->
			<hr>
			<?php $this->renderPartial('/alert/alert');?>
			<?php $this->renderPartial('_form', array('model' => $model)); ?>
		</div>
	</div>
