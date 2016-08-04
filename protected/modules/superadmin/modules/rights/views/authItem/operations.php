<?php $this->breadcrumbs = array(
  'Rights' => Rights::getBaseUrl(),
  Rights::t('core', 'Operations'),
); ?>
<h2><?php echo Rights::t('core', 'Operations'); ?></h2>

<p>
  <?php echo Rights::t('core',
    'Sebuah operasi adalah sebuah akses untuk melakukan sebuah operasi, sebagai contoh mengakses sebuah aksi dari controller.'); ?>
  <?php echo Rights::t('core',
    'Operasi berada dibawah dari tugas-tugas dalam autorisasi hierarki dan hanya dapat inherit dari operasi-operasi yang lain.'); ?>
</p>

<p><?php echo CHtml::link(Rights::t('core', 'Create a new operation'),
    array('authItem/create', 'type' => CAuthItem::TYPE_OPERATION), array(
      'class' => 'btn btn-default',
    )); ?></p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider'  => $dataProvider,
  'template'      => '{items}',
  'itemsCssClass' => 'table table-hover',
  'emptyText'     => Rights::t('core', 'No operations found.'),
  'htmlOptions'   => array('class' => 'grid-view operation-table sortable-table'),
  'columns'       => array(
    array(
      'name'        => 'name',
      'header'      => Rights::t('core', 'Name'),
      'type'        => 'raw',
      'htmlOptions' => array('class' => 'name-column'),
      'value'       => '$data->getGridNameLink()',
    ),
    array(
      'name'        => 'description',
      'header'      => Rights::t('core', 'Description'),
      'type'        => 'raw',
      'htmlOptions' => array('class' => 'description-column'),
    ),
    array(
      'name'        => 'bizRule',
      'header'      => Rights::t('core', 'Business rule'),
      'type'        => 'raw',
      'htmlOptions' => array('class' => 'bizrule-column'),
      'visible'     => Rights::module()->enableBizRule === true,
    ),
    array(
      'name'        => 'data',
      'header'      => Rights::t('core', 'Data'),
      'type'        => 'raw',
      'htmlOptions' => array('class' => 'data-column'),
      'visible'     => Rights::module()->enableBizRuleData === true,
    ),
    array(
      'header'      => '&nbsp;',
      'type'        => 'raw',
      'htmlOptions' => array('class' => 'actions-column'),
      'value'       => '$data->getDeleteOperationLink()',
    ),
  ),
)); ?>
<div class="alert alert-dismissible alert-info">
  <?php echo Rights::t('core', 'Values within square brackets tell how many children each item has.'); ?>
</div>
