<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::getAuthItemTypeNamePlural($model->type)=>Rights::getAuthItemRoute($model->type),
	$model->name,
); ?>

<div id="updatedAuthItem">

	<h2><?php echo Rights::t('core', 'Update :name', array(
		':name'=>$model->name,
		':type'=>Rights::getAuthItemTypeName($model->type),
	)); ?></h2>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

	<div class="relations span-11 last">

		<h2 class="page-title"><?php echo Rights::t('core', 'Relations'); ?></h2>

		<?php if( $model->name!==Rights::module()->superuserName ): ?>

			<div class="parents">

				<h4><?php echo Rights::t('core', 'Parents'); ?></h4>

				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$parentDataProvider,
					'template'=>'{items}',
          'itemsCssClass'=>'table table-striped table-hover',
					'hideHeader'=>true,
					'emptyText'=>Rights::t('core', 'This item has no parents.'),
					'htmlOptions'=>array('class'=>'grid-view parent-table mini'),
					'columns'=>array(
    					array(
    						'name'=>'name',
    						'header'=>Rights::t('core', 'Name'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'name-column'),
    						'value'=>'$data->getNameLink()',
    					),
    					array(
    						'name'=>'type',
    						'header'=>Rights::t('core', 'Type'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'type-column'),
    						'value'=>'$data->getTypeText()',
    					),
    					array(
    						'header'=>'Action',
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'actions-column'),
    						'value'=>'',
    					),
					)
				)); ?>

			</div>

			<div class="children">

				<h4><?php echo Rights::t('core', 'Children'); ?></h4>

				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$childDataProvider,
					'template'=>'{items}',
          'itemsCssClass'=>'table table-striped table-hover',
					'hideHeader'=>true,
					'emptyText'=>Rights::t('core', 'This item has no children.'),
					'htmlOptions'=>array('class'=>'grid-view parent-table mini'),
					'columns'=>array(
    					array(
    						'name'=>'name',
    						'header'=>Rights::t('core', 'Name'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'name-column'),
    						'value'=>'$data->getNameLink()',
    					),
    					array(
    						'name'=>'type',
    						'header'=>Rights::t('core', 'Type'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'type-column'),
    						'value'=>'$data->getTypeText()',
    					),
    					array(
    						'header'=>'Action',
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'actions-column'),
    						'value'=>'$data->getRemoveChildLink()',
    					),
					)
				)); ?>

			</div>

			<div class="addChild">

				<h5><?php echo Rights::t('core', 'Add Child'); ?></h5>

				<?php if( $childFormModel!==null ): ?>

					<?php $this->renderPartial('_childForm', array(
						'model'=>$childFormModel,
						'itemnameSelectOptions'=>$childSelectOptions,
					)); ?>

				<?php else: ?>
        <div class="alert alert-dismissible alert-info">
          <?php echo Rights::t('core', 'No children available to be added to this item.'); ?>
        </div>
				<?php endif; ?>
			</div>
		<?php else: ?>
      <div class="alert alert-dismissible alert-info">
        <?php echo Rights::t('core', 'No assignments available to be assigned to this user.'); ?>
        <?php echo Rights::t('core', 'Super users are always granted access implicitly.'); ?>
      </div>
		<?php endif; ?>

	</div>

</div>