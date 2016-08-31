<div class="mail-body">
  <div class="mail-header">
    <!-- title -->
    <h3 class="mail-title">
      Kotak Masuk
      <span id="inbox" class="count"><?php echo "(" . Kospermindo::getCountUnreadMessages() . ")"; ?></span>
    </h3>

    <!--     search-->
    <form method="get" role="form" action="/kospermindo/pesan/cari" class="mail-search">
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Cari pesan..."/>
        <div class="input-group-addon">
          <i class="entypo-search"></i>
        </div>
      </div>
    </form>
  </div>

  <!-- mail table -->
  <table class="table mail-table">
    <!-- mail table header -->
    <thead>
    <tr>
      <th width="5%">
        <div class="checkbox checkbox-replace">
          <input id="markasread" name="markasread" type="checkbox"/>
        </div>
      </th>
      <th colspan="4">

        <div class="mail-select-options">Tandai sudah dibaca</div>

        <div class="mail-pagination" colspan="2">
          <strong>1-30</strong> <span>of <?= $totaldata; ?></span>
          <div class="btn-group">
            <a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a>
            <a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a>
          </div>
        </div>
      </th>
    </tr>
    </thead>

    <!-- email list -->
    <tbody>
    <?php if (count($messageAdapter->data) !== 0) { ?>
      <?php foreach ($messageAdapter->data as $index => $value) { ?>
        <tr class="<?php echo ($value->is_read === '0') ? "unread" : "read" ?>"><!-- new email class: unread -->
          <td>
            <div class="checkbox checkbox-replace">
              <?php echo CHtml::checkBox("Message[$index][selected]", false, array('type' => 'checkbox')); ?>
            </div>
          </td>

          <td class="col-name">

            <a href="/kospermindo/pesan/lihat?id=<?= $value->id ?>"
               class="col-name"><?php echo ucfirst(Petani::model()->getUserName($value->sender_id)); ?></a>
          </td>
          <td class="col-subject">
            <a href="/kospermindo/pesan/lihat?id=<?= $value->sender_id ?>">
              <?php echo $value->content ?>
            </a>
          </td>
          <!--          <td class="col-options">-->
          <!--            <a href="/kospermindo/pesan/lihat"><i class="entypo-attach"></i></a>-->
          <!--          </td>-->
          <td class="col-time"><?php echo date('H:i', strtotime($value->attributes['date_receive'])); ?></td>
        </tr>
      <?php } ?>
    <?php } else { ?>
      <tr>
        <td colspan="12" class="text-center">Tidak ada pesan masuk</td>
      </tr>
    <?php } ?>

    </tbody>

    <!-- mail table footer -->
    <tfoot>
    <tr>
      <th width="5%">
        <div class="checkbox checkbox-replace">
          <?php echo CHtml::checkBox("Message[$index][selected]", false, array('type' => 'checkbox')); ?>
        </div>
      </th>
      <th colspan="4">

        <div class="mail-pagination" colspan="2">
          <?php $this->widget('CLinkPager', array('pages' => $messageAdapter->getPagination())) ?>
          <strong>1-30</strong> <span>of <?= $totaldata; ?></span>

          <div class="btn-group">
            <a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a>
            <a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a>
          </div>
        </div>
      </th>
    </tr>
    </tfoot>
  </table>

</div>

