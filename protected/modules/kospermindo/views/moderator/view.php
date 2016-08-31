<?php
  /* @var $this ModeratorController */
  /* @var $model Moderator */

  $this->breadcrumbs = array(
    'Moderators' => array('index'),
    $model->id_moderator,
  );

  $this->menu = array(
    array('label' => 'List Moderator', 'url' => array('index')),
    array('label' => 'Create Moderator', 'url' => array('create')),
    array('label' => 'Update Moderator', 'url' => array('update', 'id' => $model->id_moderator)),
    array('label'       => 'Delete Moderator',
          'url'         => '#',
          'linkOptions' => array('submit'  => array('delete', 'id' => $model->id_moderator),
                                 'confirm' => 'Are you sure you want to delete this item?',
          ),
    ),
    array('label' => 'Manage Moderator', 'url' => array('admin')),
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
      <strong><?php echo 'View Moderator'; ?></strong>
    </li>
  </ol>
  <h2>View Moderator #<?php echo $model->moderator_nama; ?></h2><br/>
</div>

<div class="row">
  <div class="col-md-12">
    <a href="<?= Kospermindo::getBaseUrl(); ?>/moderator" class="btn btn-success btn-lg" id="btn-tmbh"><i
        class="entypo-list"></i>&nbsp;List Moderator</a>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/create" class="btn btn-success btn-lg" id="btn-tmbh"><i
        class="entypo-plus"></i>&nbsp;Create Moderator</a>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/update?id=<?php echo $model->id_moderator; ?>"
       class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-pencil"></i>&nbsp;Update Moderator</a>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/delete?id=<?php echo $model->id_moderator ?>"
       class="btn btn-success btn-lg" id="btn-tmbh"><i class="entypo-trash"></i>&nbsp;Delete Moderator</a>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/moderator/admin" class="btn btn-success btn-lg" id="btn-tmbh"><i
        class="entypo-cog"></i>&nbsp;Manage Moderator</a>
    <hr>
  </div>
</div>

<div class="member-entry view">
  <div class="member-details">
    <h4>
      <a href="extra-timeline.html"><?php echo $model->moderator_nama; ?></a>
    </h4>

    <!-- Details with Icons -->
    <div class="row info-list">

      <?php $this->widget('zii.widgets.CDetailView', array(
        'data'       => $model,
        'attributes' => array(
          'id_moderator',
          'id_petani',
          'moderator_nama',
          'is_petani',
          'status',
        ),
      )); ?>

    </div>
  </div>
</div>

