<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Petani</a>
		</li>
		<li class="active">
			<strong><?php echo 'Tambah Petani'; ?></strong>
		</li>
	</ol>

	<h2>Tambah Petani</h2><br/>
</div>
<div class="content-wrapper">
<?php echo $this->renderPartial('formwizard',
	array('jenis_komoditi'=>$jenis_komoditi)
); ?>
