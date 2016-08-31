<div class="mail-body">
  <div class="mail-header">
    <!-- title -->
    <div class="mail-title">
      <?php echo ucfirst($model->content);?>
    </div>
    <!-- links -->
    <div class="mail-links">
      <a href="/kospermindo/pesan/hapus?id=<?php echo $model->id; ?>" class="btn btn-default">
        <i class="entypo-trash"></i>
      </a>

      <a href="/kospermindo/pesan/balas?id=<?php echo $model->id; ?>" class="btn btn-primary btn-icon">
        Balas
        <i class="entypo-reply"></i>
      </a>
    </div>
  </div>

  <div class="mail-info">

    <div class="mail-sender dropdown">
      <?php if($model->sent_status === 0) {?>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $this->baseUrl; ?>/static/admin/images/thumb-1.png" class="img-circle" width="30" />
          <span><?php echo isset($model->from) ? ucfirst($model->from) : 'Admin'; ?></span>
          to <span>me</span>
        </a>
      <?php }else{ ?>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $this->baseUrl; ?>/static/admin/images/thumb-1.png" class="img-circle" width="30" />
          <span>me</span>
          to <span><?php echo isset($model->to) ? ucfirst($model->to) : 'Guest'; ?></span>
        </a>
      <?php } ?>

      <ul class="dropdown-menu dropdown-red">
        <li>
          <a href="/kospermindo/pesan/tambah">
            <i class="entypo-user"></i>
            Tambahkan Kontak
          </a>
        </li>
        <li>
          <a href="/kospermindo/pesan/lihat-pesan-lain">
            <i class="entypo-menu"></i>
            Lihat Pesan Lainnya
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="/kospermindo/pesan/balas?id=<?php echo $model->id; ?>">
            <i class="entypo-reply"></i>
            Balas
          </a>
        </li>
      </ul>

    </div>

    <div class="mail-date">
      <?php echo date('H:i',strtotime($model->date_receive))?> - <?php echo Helper::DateToIndo($model->date_receive)?>
    </div>

  </div>

  <div class="mail-text">

    <p><?php echo $model->content; ?></p>

  </div>

  <div class="mail-reply">

    <div class="fake-form">
      <div>
        <a href="/kospermindo/pesan/balas?id=<?php echo $model->id ?>">Balas</a> pesan ini...
      </div>
    </div>

  </div>
</div>
