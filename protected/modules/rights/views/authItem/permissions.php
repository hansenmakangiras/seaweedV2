<?php $this->breadcrumbs = array(
  'Rights' => Rights::getBaseUrl(),
  Rights::t('core', 'Permissions'),
); ?>

<div id="permissions">

  <h2><?php echo Rights::t('core', 'Permissions'); ?></h2>

  <p>
    <?php echo Rights::t('core',
      'Disini anda dapat melihat dan mengatur untuk memberikan hak akses/ijin kepada tiap Level Akses.'); ?>
    <?php echo Rights::t('core', 'Setiap item dapat berasal dari {roleLink}, {taskLink} and {operationLink}.',
      array(
        '{roleLink}'      => CHtml::link(Rights::t('core', 'Roles'), array('authItem/roles')),
        '{taskLink}'      => CHtml::link(Rights::t('core', 'Tasks'), array('authItem/tasks')),
        '{operationLink}' => CHtml::link(Rights::t('core', 'Operations'), array('authItem/operations')),
      )); ?>
  </p>

  <p><?php echo CHtml::link(Rights::t('core', 'Generate item otomatis untuk setiap Action pada Controller'),
      array('authItem/generate'), array(
        'class' => 'btn btn-default',
      )); ?></p>

  <?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'  => $dataProvider,
    'pager'  => $dataProvider->pagination,
    'template'      => "{items}\n{pager}",
    'itemsCssClass' => 'table table-hover',
    'emptyText'     => Rights::t('core', 'No authorization items found.'),
    'htmlOptions'   => array('class' => 'grid-view permission-table'),
    'columns'       => $columns,
  )); ?>

<!--  <div class="pagination pagination-centered">-->
<!--    --><?php //$this->widget('CLinkPager', array(
//      'pages' => $pages,
//      'header' => '',
//      'footer' => '',
//      'selectedPageCssClass' => 'active',
//      'prevPageLabel' => '<',
//      'nextPageLabel' => '>',
//      'firstPageLabel' => '<<',
//      'lastPageLabel' => '>>',
//      'htmlOptions' => array(
//        'class' => 'pagination pagination-centered'
//      )
//    )) ?>
<!--  </div>-->
  <div class="alert alert-dismissible alert-info">
    *) <?php echo Rights::t('core', 'Hover to see from where the permission is inherited.'); ?>
  </div>

  <script type="text/javascript">
    /**
     * Attach the tooltip to the inherited items.
     */
    jQuery('.inherited-item').rightsTooltip({
      title: '<?php echo Rights::t('core', 'Source'); ?>: '
    });

    /**
     * Hover functionality for rights' tables.
     */
    $('#rights tbody tr').hover(function () {
      $(this).addClass('hover'); // On mouse over
    }, function () {
      $(this).removeClass('hover'); // On mouse out
    });

  </script>

</div>
