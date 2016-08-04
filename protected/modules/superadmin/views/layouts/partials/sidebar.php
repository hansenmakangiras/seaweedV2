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
  <!--  --><?php //Helper::dd(Rights::getAssignedRoles(Yii::app()->user->id))?>
  <li class="<?= $active == 'beranda' ? 'active' : ''; ?>">
    <a href="<?= SAdmin::getBaseUrl(); ?>">
      <i class="entypo-gauge"></i>
      <span>Beranda</span>
    </a>
  </li>
  <li class="<?= ($active == 'petani' || $active == 'gudang' || $active == 'groups' || $active == 'warehouse' || $active == 'moderator') ? 'active opened active' : ''; ?>">

    <?php //if (!Yii::app()->user->checkAccess('SuperAdmin')){ ?>
    <a href="#">
      <i class="entypo-database"></i>
      <span>Manajemen Data</span>
    </a>
    <ul>
      <li class="<?= $active == 'warehouse' ? 'active' : ''; ?>">
        <a href="/superadmin/warehouse">
          <span>Data Gudang </span>
        </a>
      </li>
      <li class="<?= $active == 'groups' ? 'active' : ''; ?>">
        <a href="/superadmin/groups">
          <span>Data Kelompok</span>
        </a>
      </li>
      <li class="<?= $active == 'petani' ? 'active' : ''; ?>">
        <a href="/superadmin/petani">
          <span>Data Petani</span>
        </a>
      </li>
      <li class="<?= $active == 'moderator' ? 'active' : ''; ?>">
        <a href="/superadmin/moderator">
          <span>Data Moderator</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="<?= ($active == 'mgudang' || $active == 'mkelompok' || $active == 'mpetani' || $active == 'mmoderator' || $active =='mkomoditi') ? 'active opened active' : ''; ?>">

    <a href="/superadmin/rights">
      <i class="entypo-user-add"></i>
      <span>Manajemen Pengguna</span>
    </a>
    <ul>
      <li class="<?= $active == 'mgudang' ? 'active' : ''; ?>">
        <a href="/superadmin/users/gudang">
          <span>Manajemen Gudang</span>
        </a>
        <!--        <ul>-->
        <!--          <li class="--><?php //echo $active == 'mkelompok' ? 'active' : ''; ?><!--">-->
        <!--            <a href="--><?php //echo $this->baseUrl ?><!--/superadmin/gudang/stokmasuk">-->
        <!--              <span>Stok Masuk</span>-->
        <!--            </a>-->
        <!--          </li>-->
        <!--          <li class="--><?php //echo $active == 'mkelompok' ? 'active' : ''; ?><!--">-->
        <!--            <a href="--><?php //echo $this->baseUrl ?><!--/superadmin/gudang/stokkeluar">-->
        <!--              <span>Stok Keluar</span>-->
        <!--            </a>-->
        <!--          </li>-->
        <!--        </ul>-->
      </li>
      <li class="<?php echo $active == 'mkelompok' ? 'active' : ''; ?>">
        <a href="<?php echo $this->baseUrl ?>/superadmin/users/groups">
          <span>Manajemen Kelompok</span>
        </a>
      </li>
      <li class="<?= $active == 'mpetani' ? 'active' : ''; ?>">
        <a href="/superadmin/users/petani">
          <span>Manajemen Petani</span>
        </a>
      </li>
      <li class="<?= $active == 'mmoderator' ? 'active' : ''; ?>">
        <a href="/superadmin/users/moderator">
          <span>Manajemen Moderator</span>
        </a>
      </li>
      <li class="<?= $active == 'mkomoditi' ? 'active' : ''; ?>">
        <a href="/superadmin/users/panen">
          <span>Manajemen Komoditi</span>
        </a>
      </li>
    </ul>
  </li>
  <!-- Report Menu -->
  <li class="<?= $active == 'report' ? 'active opened active' : ''; ?>">
    <a href="/superadmin/report">
      <i class="entypo-docs"></i>
      <span>Laporan</span>
    </a>
  </li>

</ul>


