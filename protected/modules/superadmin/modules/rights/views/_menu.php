<?php $this->widget('zii.widgets.CMenu', array(
//  'firstItemCssClass' => 'first',
//  'lastItemCssClass'  => 'last',
  'htmlOptions'       => array('style' => 'padding:0px;'),
  'items'             => array(
    array(
      'label'       => Rights::t('core', 'Assignments'),
      'url'         => array('assignment/view'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
    array(
      'label'       => Rights::t('core', 'Permissions'),
      'url'         => array('authItem/permissions'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
    array(
      'label'       => Rights::t('core', 'Roles'),
      'url'         => array('authItem/roles'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
    array(
      'label'       => Rights::t('core', 'Tasks'),
      'url'         => array('authItem/tasks'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
    array(
      'label'       => Rights::t('core', 'Operations'),
      'url'         => array('authItem/operations'),
      'itemOptions' => array('class' => 'btn btn-white'),
    ),
  ),
)); ?>