<?php
  $active = Helper::getActiveState(Yii::app()->request->url,"superadmin");
?>
<?php
  //  //Helper::dd($this->route);
  //  $this->widget('zii.widgets.CMenu', array(
  //    //'itemCssClass' => 'auto-inherit-active-class',
  //    'id' => 'main-menu',
  //    'activateParents' => true,
  //    'htmlOptions' => array('class' => 'auto-inherit-active-class'),
  //    'items'=>array(
  //      array(
  //        'label'=>'<i class="entypo-gauge"></i> Beranda',
  //        'url'=>array(Kospermindo::getBaseUrl()),
  //        'encodeLabel' => false,
  //        'active' => Helper::isItemActive($this->route,'superadmin'),
  //      ),
  //      array(
  //        'activeCssClass' => 'active opened active',
  //        'label'=>'<i class="entypo-database"></i><span>Manajemen Data</span>',
  //        'url'=>array(''),
  //        'items'=>array(
  //          array('label'=>'Data Gudang', 'url'=>array('/superadmin/warehouse'),'active' => Helper::isItemActive($this->route,'/superadmin/warehouse')),
  //          array('label'=>'Data Kelompok', 'url'=>array('/superadmin/groups'),'active' => Helper::isItemActive($this->route,'/superadmin/groups')),
  //          array('label'=>'Data Petani', 'url'=>array('/superadmin/petani'),'active' => Helper::isItemActive($this->route,'/superadmin/petani/index')),
  //          array('label'=>'Data Moderator', 'url'=>array('/superadmin/moderator'),'active' => Helper::isItemActive($this->route,'/superadmin/moderator')),
  //        ),
  //        'encodeLabel' => false,
  //      ),
  //      array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
  //    ),
  //  ));
  //?>
<ul id="main-menu" class="auto-inherit-active-class">
  <!-- add class "multiple-expanded" to allow multiple submenus to open -->
  <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
  <!-- Search Bar -->
  <li id="search">
    <?php echo CHtml::form(Yii::app()->createUrl('/superadmin/search'), 'get') ?>
    <?php echo CHtml::textField('q', isset($_GET['q']) ? $_GET['q'] : '',
      array('class' => 'search-input', 'placeholder' => 'Search something...', 'name' => 'q')) ?>
    <button type="submit">
      <i class="entypo-search"></i>
    </button>
    <?php echo CHtml::endForm() ?>
  </li>
  <?php //Helper::dd(Rights::getAssignedRoles(Yii::app()->user->id))?>
  <li class="<?= $active == 'beranda' ? 'active' : ''; ?>">
    <a href="<?= SAdmin::getBaseUrl(); ?>">
      <i class="entypo-gauge"></i>
      <span>Beranda</span>
    </a>
  </li>
  <li class="<?= $active == 'users' ? 'active' : ''; ?>">
    <a href="<?= SAdmin::getBaseUrl(); ?>/users">
      <i class="entypo-users"></i>
      <span>Managemen Pengguna</span>
    </a>
  </li>
</ul>


