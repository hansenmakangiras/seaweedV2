<?php
  /* @var $this ModeratorController */
  /* @var $model Moderator */

  $this->breadcrumbs = array(
    'Moderators' => array('index'),
    'Manage',
  );

  $this->menu = array(
    array('label' => 'List Moderator', 'url' => array('index')),
    array('label' => 'Create Moderator', 'url' => array('create')),
  );

  Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#moderator-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
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
      <strong><?php echo 'Manage Moderators'; ?></strong>
    </li>
  </ol>
  <h2>Manage Moderators</h2><br/>
</div>
<div class="row">
  <div class="col-md-12">
    <a href="/kospermindo/moderator" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-list"></i>&nbsp;List
      Moderator</a>
    <a href="/kospermindo/moderator/create" class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-plus"></i>&nbsp;Create
      Moderator</a>
    <hr>
    <p>
      You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
      or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
    </p>

    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'btn btn-link btn-lg search-button')); ?>
    <div class="search-form" style="display:none">
      <?php $this->renderPartial('_search', array(
        'model' => $model,
      )); ?>
    </div><!-- search-form -->
    <hr>
    <br>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
      'id'            => 'moderator-grid',
      'itemsCssClass' => 'table table-bordered table-responsive',
      'dataProvider'  => $model->search(),
      'filter'        => $model,
      'columns'       => array(
        'id_moderator',
        'id_petani',
        'moderator_nama',
        'is_petani',
        'status',
        array(
          'class' => 'CButtonColumn',
        ),
      ),
    )); ?>
  </div>
</div>
<h1></h1>




