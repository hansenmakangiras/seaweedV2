<?php $this->widget('zii.widgets.CMenu', array(
//  'firstItemCssClass' => 'first',
//  'lastItemCssClass'  => 'last',
  'htmlOptions'       => array('style' => 'padding:0px;'),
  'items'             => array(
    array(
      'label'       => Yii::t('seaweedapp', 'Add Seaweed'),
      'url'         => array('commodity/create'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
    array(
      'label'       => Yii::t('seaweedapp', 'Manage Seaweed Type'),
      'url'         => array('commodity/viewalltipe'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
//    array(
//      'label'       => Yii::t('seaweedapp', 'View Commodity Type'),
//      'url'         => array('authItem/roles'),
//      'itemOptions' => array('class' => 'btn btn-white'),
//    ),
  ),
)); ?>