<?php
/* @var $this HargaController */
/* @var $model HargaSeaweed */

$this->breadcrumbs=array(
	'Harga Seaweeds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HargaSeaweed', 'url'=>array('index')),
	array('label'=>'Create HargaSeaweed', 'url'=>array('create')),
	array('label'=>'Update HargaSeaweed', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HargaSeaweed', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HargaSeaweed', 'url'=>array('admin')),
);
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
			<strong><?php echo 'View Harga'; ?></strong>
		</li>
	</ol>
	<h2>View Harga #<?php echo JenisKomoditi::model()->getJenisKomoditi($model->id_jenis_komoditi)['nama']; ?></h2><br/>
</div>

<div class="row">
	<div class="col-md-12">
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga" class="btn btn-success btn-lg" id="btn-tmbh"><i
				class="entypo-list"></i>&nbsp;List Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/create" class="btn btn-success btn-lg" id="btn-tmbh"><i
				class="entypo-plus"></i>&nbsp;Create Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/update?id=<?php echo $model->id; ?>"
		   class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-pencil"></i>&nbsp;Update Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/delete?id=<?php echo $model->id ?>"
		   class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-trash"></i>&nbsp;Delete Harga</a>
		<a href="<?= Kospermindo::getBaseUrl(); ?>/harga/admin" class="btn btn-success btn-lg" id="btn-tmbh"><i
				class="entypo-cog"></i>&nbsp;Manage Harga</a>
		<hr>
	</div>
</div>

<div class="member-entry view">
	<div class="member-details">
		<h4>
			<?php echo JenisKomoditi::model()->getJenisKomoditi($model->id_jenis_komoditi)['nama'];  ?>
		</h4>

		<!-- Details with Icons -->
		<div class="row info-list">
      <div class="col-md-6 col-sm-offset-1">
        <?php $this->widget('zii.widgets.CDetailView', array(
          'data'=>$model,
          'htmlOptions' => array(
            'class' => 'table table-responsive',
          ),
          'nullDisplay' =>'Data tidak ditemukan',
          'attributes'=>array(
            array(               // related city displayed as a link
              'label'=>'ID',
              'type'=>'raw',
              'value'=>CHtml::link(CHtml::encode($model->id),
                array('/kospermindo/harga/view','id'=>$model->id)),
            ),
            array(               // related city displayed as a link
              'label'=>'Jenis Komoditi',
              'type'=>'raw',
              'value'=> JenisKomoditi::model()->getJenisKomoditi($model->id_jenis_komoditi)['nama']
            ),
            array(               // related city displayed as a link
              'label'=>'Harga',
              'type'=>'raw',
              'value'=> Helper::convertToRupiah($model->harga)
            ),
          ),

        )); ?>
      </div>
		</div>
	</div>
</div>


