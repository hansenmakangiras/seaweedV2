<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Roles'),
); ?>

<div id="roles">

	<h2><?php echo Rights::t('core', 'Roles'); ?></h2>

	<p>
		<?php echo Rights::t('core', 'Sebuah Aturan/Level adalah grup dari perizinan untuk melakukan berbagai tugas dan operasi, sebagai contoh untuk user yang sudah di authentikasi.'); ?>
		<?php echo Rights::t('core', 'Aturan/Level berada di paling atas dari autorisasi hierarki dan juga dapat bersifat inherit dari Roles, Tasks, dan atau Operations yang lain.'); ?>
	</p>

	<p><?php echo CHtml::link(Rights::t('core', 'Create a new role'), array('authItem/create', 'type'=>CAuthItem::TYPE_ROLE), array(
	   	'class'=>'btn btn-default',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
      'itemsCssClass'=>'table table-hover',
	    'emptyText'=>Rights::t('core', 'No roles found.'),
	    'htmlOptions'=>array('class'=>'grid-view role-table'),
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
    			'value'=>'$data->getDeleteRoleLink()',
    		),
	    )
	)); ?>
  <div class="alert alert-dismissible alert-info">
    <?php echo Rights::t('core', 'Values within square brackets tell how many children each item has.'); ?>
  </div>
</div>