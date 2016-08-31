<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/harga">Harga</a>
		</li>
		<li class="active">
			<strong><?php echo 'Update Harga'; ?></strong>
		</li>
	</ol>
	<h2>Update Harga <?php echo JenisKomoditi::model()->getJenisKomoditi($model->id_jenis_komoditi)['nama']; ?></h2><br/>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga" class="btn btn-link btn-lg" id="btn-tmbh"><i class="entypo-list"></i>&nbsp;List Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/create" class="btn btn-link btn-lg" id="btn-tmbh"><i class="entypo-plus"></i>&nbsp;Create Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/view?id=<?php echo $model->id?>" class="btn btn-link btn-lg" id="btn-tmbh"><i class="entypo-search"></i>&nbsp;View Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/admin" class="btn btn-link btn-lg" id="btn-tmbh"><i class="entypo-cog"></i>&nbsp;Manage Harga</a>
		<hr>
		<?php $this->renderPartial('/alert/alert');?>
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
