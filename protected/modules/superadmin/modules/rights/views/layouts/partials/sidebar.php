<?php

  $idUser = Yii::app()->user->getId();
  $active = '';
  $url = explode('/', Yii::app()->request->url);
  $controllerid = Yii::app()->controller->id;
  $actionid = Yii::app()->controller->action->id;
  $page = Yii::app()->request->getQuery("page");
  if ($controllerid == 'site' && $actionid == 'index') {
    $active = 'beranda';
  } else {
    if ($url[1] == 'petani' OR strpos($url[1], 'petani') !== false) {
      $active = 'petani';
    } elseif ($url[1] == 'warehouse' OR strpos($url[1], 'warehouse') !== false) {
      $active = 'warehouse';
    } elseif ($url[1] == 'search?q' OR strpos($url[1], 'search?q') !== false) {
      $active = 'search?q';
    } elseif ($url[1] == 'role' OR strpos($url[1], 'role') !== false) {
      $active = 'role';
    } elseif ($url[1] == 'user' OR strpos($url[1], 'user') !== false) {
      $active = 'user';
    } elseif ($url[1] == 'groups' OR strpos($url[1], 'groups') !== false) {
      $active = 'groups';
    } elseif ($url[1] == 'commodity' OR strpos($url[1], 'commodity') !== false) {
      $active = 'commodity';
    } elseif ($url[1] == 'user' OR strpos($url[1], 'user') !== false) {
      $active = 'user';
    } elseif ($url[1] == 'kordinator' OR strpos($url[1], 'kordinator') !== false) {
      $active = 'kordinator';
    } elseif ($url[1] == 'pengguna' OR strpos($url[1], 'pengguna') !== false) {
      $active = 'pengguna';
    } elseif ($url[1] == 'company' OR strpos($url[1], 'company') !== false) {
      $active = 'company';
    } elseif ($url[1] == 'menus' OR strpos($url[1], 'menus') !== false) {
      $active = 'menus';
    } elseif ($url[1] == 'profile' OR strpos($url[1], 'profile') !== false) {
      $active = 'profile';
    } elseif ($url[1] == 'report' OR strpos($url[1], 'report') !== false) {
      $active = 'report';
    } elseif ($url[1] == 'data' OR strpos($url[1], 'data') !== false) {
      $active = 'data';
    }elseif ($url[1] == 'rights' OR strpos($url[1], 'rights') !== false) {
      $active = 'rights';
    }elseif ($url[1] == 'message' OR strpos($url[1], 'message') !== false) {
      $active = 'message';
    }
  }
?>
<ul id="main-menu" class="auto-inherit-active-class">
  <!-- add class "multiple-expanded" to allow multiple submenus to open -->
  <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
  <!-- Search Bar -->
  <li id="search">
    <?php echo CHtml::form(Yii::app()->createUrl('/search'), 'get') ?>
    <?php echo CHtml::textField('q', isset($_GET['q']) ? $_GET['q'] : '',
      array('class' => 'search-input', 'placeholder' => 'Search something...', 'name' => 'q')) ?>
    <button type="submit">
      <i class="entypo-search"></i>
    </button>
    <?php echo CHtml::endForm() ?>
  </li>
  <!--  --><?php //Helper::dd(Rights::getAssignedRoles(Yii::app()->user->id))?>
  <li class="<?= $active == 'beranda' ? 'active' : ''; ?>">
    <a href="<?= $this->baseUrl ?>">
      <i class="entypo-gauge"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="<?= ($active == 'petani' || $active == 'gudang' || $active == 'groups' || $active == 'warehouse') ? 'active opened active' : ''; ?>">
    <?php if (!Users::model()->isSuperUser() === true){ ?>
    <?php //if (!Yii::app()->user->checkAccess('SuperAdmin')){ ?>
    <a href="#">
      <i class="entypo-database"></i>
      <span>Data Management</span>
    </a>
    <ul>
      <li class="<?= $active == 'warehouse' ? 'active' : ''; ?>">
        <a href="<?= $this->baseUrl ?>/warehouse">
          <span>Warehouse Data </span>
        </a>
      </li>
      <li class="<?= $active == 'groups' ? 'active' : ''; ?>">
        <a href="<?= $this->baseUrl ?>/groups">
          <span>Groups Data</span>
        </a>
      </li>
      <li class="<?= $active == 'petani' ? 'active' : ''; ?>">
        <a href="<?= $this->baseUrl ?>/petani">
          <span>Farmer Data</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="<?= $active == 'message' ? 'active' : ''; ?>">
    <a href="<?= $this->baseUrl ?>/message">
      <i class="entypo-mail"></i>
      <span>Mailbox</span>
    </a>
  </li>

  <li class="<?= $active == 'commodity' ? 'active' : ''; ?>">
    <a href="<?= $this->baseUrl ?>/commodity">
      <i class="entypo-monitor"></i>
      <span>Seaweed Management</span>
    </a>
  </li>
  <li class="<?= $active == 'user' ? 'active' : ''; ?>">
    <a href="<?= $this->baseUrl ?>/user">
      <i class="entypo-user-add"></i>
      <span>User Management <label class="badge"><?= (Yii::app()->user->isSuperUser === true) ? 'SuperAdmin' : 'Admin'?></label> </span>
    </a>
  </li>
<?php } else { ?>
  <!--  Manajemen User Menu-->
  <li class="<?= ($active == 'user') ? 'active' : ''; ?>">
    <a href="<?= $this->baseUrl; ?>/rights">
      <i class="entypo-users"></i>
      <span>Users Management <label class="badge"><?= (Yii::app()->user->isSuperUser === true) ? 'SuperAdmin' : 'Admin'?></label>  </span>
    </a>
  </li>
<?php } ?>
  <!-- Report Menu -->
  <li class="<?= $active == 'report' ? 'active opened active' : ''; ?>">
    <a href="/report">
      <i class="entypo-docs"></i>
      <span>Report Management</span>
    </a>
  </li>

</ul>


