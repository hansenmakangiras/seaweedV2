<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Tasks'),
); ?>

<div id="tasks">

	<h2><?php echo Rights::t('core', 'Tasks'); ?></h2>

	<p>
		<?php echo Rights::t('core', 'Sebuah tugas adalah akses untuk melakukan beberapa operasi, sebagai contoh untuk mengakses sebuah grup dari aksi controller.'); ?><br />
		<?php echo Rights::t('core', 'Tugas-tugas berada dibawah Aturan/Role dari autorisasi hierarki dan hanya dapat inherit dari tugas, aksi dan atau operasi yang lain.'); ?>
	</p>

	<p><?php echo CHtml::link(Rights::t('core', 'Create a new task'), array('authItem/create', 'type'=>CAuthItem::TYPE_TASK), array(
		'class'=>'btn btn-default',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
      'itemsCssClass'=>'table table-hover',
	    'emptyText'=>Rights::t('core', 'No tasks found.'),
	    'htmlOptions'=>array('class'=>'grid-view task-table'),
	    'columns'=>array(
    		array(
    			'name'=>'name',
    			'header'=>Rights::t('core', 'Name'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getGridNameLink()',
    		),
    		array(
    			'name'=>'description',
    			'header'=>Rights::t('core', 'Description'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'description-column'),
    		),
    		array(
    			'name'=>'bizRule',
    			'header'=>Rights::t('core', 'Business rule'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'bizrule-column'),
    			'visible'=>Rights::module()->enableBizRule===true,
    		),
    		array(
    			'name'=>'data',
    			'header'=>Rights::t('core', 'Data'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'data-column'),
    			'visible'=>Rights::module()->enableBizRuleData===true,
    		),
    		array(
    			'header'=>'Action',
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'actions-column'),
    			'value'=>'$data->getDeleteTaskLink()',
    		),
	    )
	)); ?>
  <div class="alert alert-dismissible alert-info">
    <?php echo Rights::t('core', 'Values within square brackets tell how many children each item has.'); ?>
  </div>
</div>