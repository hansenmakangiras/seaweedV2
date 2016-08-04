<!-- compose new email button -->
<?php $active = Helper::setActive(Yii::app()->request->url,"kospermindo");?>
<div class="mail-sidebar-row hidden-xs">
  <a href="/kospermindo/message/create" class="btn btn-success btn-icon btn-block">
    Buat Pesan
    <i class="entypo-pencil"></i>
  </a>
</div>

<!-- menu -->
<ul class="mail-menu">
  <?php //echo Helper::dd(Helper::setActive(Yii::app()->request->url,true))?>
  <li class="<?php echo $active == 'inbox' ? 'active' : ''; ?>">
    <a href="/kospermindo/message">
      <span class="badge badge-danger pull-right"><?php echo Kospermindo::getCountUnreadMessages(); ?></span>
      Kotak Masuk
    </a>
  </li>

  <li class="<?php echo $active == 'sent' ? 'active' : ''; ?>">
    <a href="/kospermindo/message/sent">
      <span class="badge badge-gray pull-right"><?php echo Kospermindo::getSentMessageStatus(); ?></span>
      Pesan Terkirim
    </a>
  </li>

  <li class="<?php echo $active == 'draft' ? 'active' : ''; ?>">
    <a href="/kospermindo/message/draft">
      <span class="badge badge-info pull-right"><?php echo Kospermindo::getCountDraft(); ?></span>
      Pesan Tersimpan
    </a>
  </li>
</ul>

<div class="mail-distancer"></div>

<h4>Tags</h4>

<!-- menu -->
<ul class="mail-menu">
  <?php foreach ($tags as $tag) { ?>
    <li>
      <a href="/kospermindo/tags?id=<?= $tag->id; ?>">
        <span class="badge <?= $tag->class; ?> badge-roundless pull-right"></span>
        <?= $tag->tags ?>
      </a>
    </li>
  <?php } ?>
</ul>