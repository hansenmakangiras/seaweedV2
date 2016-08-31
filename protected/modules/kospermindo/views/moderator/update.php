<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'Moderators'=>array('index'),
	$model->id_moderator=>array('view','id'=>$model->id_moderator),
	'Update',
);

$this->menu=array(
	array('label'=>'List Moderator', 'url'=>array('index')),
	array('label'=>'Create Moderator', 'url'=>array('create')),
	array('label'=>'View Moderator', 'url'=>array('view', 'id'=>$model->id_moderator)),
	array('label'=>'Manage Moderator', 'url'=>array('admin')),
);
?>
	<div class="headline">
		<ol class="breadcrumb bc-3">
			<li>
				<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
			</li>
			<li>
				<a href="<?= Kospermindo::getBaseUrl(); ?>/moderator">Moderator</a>
			</li>
			<li class="active">
				<strong><?php echo 'Create Moderator'; ?></strong>
			</li>
		</ol>
		<h2>Update Moderator <?php echo $model->moderator_nama; ?></h2><br/>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="<?= Kospermindo::getBaseUrl(); ?>/moderator" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-list"></i>&nbsp;List Moderator</a>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/create" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-plus"></i>&nbsp;Create Moderator</a>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/view?id=<?php echo $model->id_moderator?>" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-search"></i>&nbsp;View Moderator</a>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/admin" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-cog"></i>&nbsp;Manage Moderator</a>
			<hr>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>

