<?php $this->widget('zii.widgets.CMenu', array(
//  'firstItemCssClass' => 'first',
//  'lastItemCssClass'  => 'last',
  'htmlOptions'       => array('style' => 'padding:0px;'),
  'items'             => array(
    array(
      'label'       => Yii::t('seaweedapp', 'Groups Report'),
      'url'         => array('report/farmers'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
    array(
      'label'       => Yii::t('seaweedapp', 'Warehouse Report'),
      'url'         => array('report/warehouse'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
    array(
      'label'       => Yii::t('seaweedapp', 'Commodity Report'),
      'url'         => array('report/seaweed'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
  ),
)); ?>