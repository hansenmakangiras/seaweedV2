<?php $this->widget('zii.widgets.CMenu', array(
//  'firstItemCssClass' => 'first',
//  'lastItemCssClass'  => 'last',
  'htmlOptions'       => array('style' => 'padding:0px;'),
  'items'             => array(
    array(
      'label'       => Yii::t('seaweedapp', 'Seaweed Management'),
      'url'         => array('seaweed'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
    array(
      'label'       => Yii::t('seaweedapp', 'Warehouse Management'),
      'url'         => array('seaweed/warehouse'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
    array(
      'label'       => Yii::t('seaweedapp', 'Group Management'),
      'url'         => array('seaweed/group'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
    array(
      'label'       => Yii::t('seaweedapp', 'Farmers Management'),
      'url'         => array('seaweed/farmers'),
      'itemOptions' => array('class' => 'btn btn-default'),
    ),
  ),
)); ?>