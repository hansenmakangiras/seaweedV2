<?php $this->breadcrumbs = array(
  'Rights'                         => Rights::getBaseUrl(),
  Rights::t('core', 'Assignments') => array('assignment/view'),
  $model->getName(),
); ?>

<div id="userAssignments">

  <h2 class="page-title"><?php echo Rights::t('core', 'Assignments for :username', array(
      ':username' => $model->getName(),
    )); ?></h2>

  <div class="assignments span-12 first">

    <?php $this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'  => $dataProvider,
      'template'      => '{items}',
      'itemsCssClass' => 'table table-striped table-hover',
      'hideHeader'    => false,
      'emptyText'     => Rights::t('core', 'This user has not been assigned any items.'),
      'htmlOptions'   => array('class' => 'grid-view user-assignment-table mini'),
//			'htmlOptions'=>array('class'=>'table table-striped table-hover'),
      'columns'       => array(
        array(
          'name'        => 'name',
          'header'      => Rights::t('core', 'Name'),
          'type'        => 'raw',
          'htmlOptions' => array('class' => 'name-column'),
          'value'       => '$data->getNameText()',
        ),
        array(
          'name'        => 'type',
          'header'      => Rights::t('core', 'Type'),
          'type'        => 'raw',
          'htmlOptions' => array('class' => 'type-column'),
          'value'       => '$data->getTypeText()',
        ),
        array(
          'header'      => Rights::t('core', 'Action'),
          'type'        => 'raw',
          'htmlOptions' => array('class' => 'actions-column'),
          'value'       => '$data->getRevokeAssignmentLink()',
        ),
      ),
    )); ?>

  </div>

  <div class="add-assignment span-11 last">

    <h3><?php echo Rights::t('core', 'Assign item'); ?></h3>

    <?php if ($formModel !== null): ?>

      <div class="form">

        <?php $this->renderPartial('_form', array(
          'model'                 => $formModel,
          'itemnameSelectOptions' => $assignSelectOptions,
        )); ?>

      </div>

    <?php else: ?>
      <div class="alert alert-dismissible alert-info">
        <?php echo Rights::t('core', 'No assignments available to be assigned to this user.'); ?>
      </div>
    <?php endif; ?>

  </div>

</div>
