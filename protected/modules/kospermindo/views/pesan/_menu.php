<!-- compose new email button -->
<?php $active = Helper::setActive(Yii::app()->request->url,"kospermindo");?>
<div class="mail-sidebar-row hidden-xs">
  <a href="/kospermindo/pesan/buat" class="btn btn-success btn-icon btn-block">
    Buat Pesan Baru
    <i class="entypo-pencil"></i>
  </a>
</div>

<!-- menu -->
<ul class="mail-menu">
  <?php //echo Helper::dd(Helper::setActive(Yii::app()->request->url,true))?>
  <li class="<?php echo $active == 'masuk' ? 'active' : ''; ?>">
    <a href="/kospermindo/pesan">
      <span id="menu-0" class="badge badge-danger pull-right"><?php echo Kospermindo::getCountUnreadMessages(); ?></span>
      Kotak Masuk
    </a>
  </li>

  <li class="<?php echo $active == 'keluar' ? 'active' : ''; ?>">
    <a href="/kospermindo/pesan/keluar">
      <span id="menu-1" class="badge badge-gray pull-right"><?php echo Kospermindo::getSentMessageStatus(); ?></span>
      Kotak Keluar
    </a>
  </li>

  <li class="<?php echo $active == 'simpan' ? 'active' : ''; ?>">
    <a href="/kospermindo/pesan/simpan">
      <span id="menu-2" class="badge badge-info pull-right"><?php echo Kospermindo::getCountDraft(); ?></span>
      Kotak Tersimpan
    </a>
  </li>
</ul>

<div class="mail-distancer"></div>
