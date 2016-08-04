<div class="mail-body">

  <div class="mail-header">
    <!-- title -->
    <h3 class="mail-title">
      Draft
      <span class="count"><?php echo "(".Kospermindo::getCountDraft().")"; ?></span>
    </h3>

    <!-- search -->
    <form method="get" role="form" action="/kospermindo/message/search" class="mail-search">
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search for mail..."/>

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

        <div class="mail-select-options"></div>

        <div class="mail-pagination" colspan="2">
          <strong><?= $totaldata; ?></strong> <span>of <?= $totaldata; ?></span>

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
    <?php //Helper::dd($model); ?>
    <?php foreach ($model as $value) { ?>
      <tr class="<?php echo ($value->attributes['is_read'] == '0') ? "unread" : "" ?>"><!-- new email class: unread -->
        <td>
          <div class="checkbox checkbox-replace">
            <input type="checkbox"/>
          </div>
        </td>
        <td class="col-name">
          <a href="/kospermindo/message/view?id=<?= $value->attributes["id"]?>" class="col-name"><?php echo ucfirst(Users::model()->getUserName($value->attributes['userid'])); ?></a>
        </td>
        <td class="col-subject">
          <a href="/kospermindo/message/view?id=<?= $value->attributes["id"]?>">
            <?php echo $value->attributes['subject']?>
          </a>
        </td>
        <!--        <td class="col-options">-->
        <!--          <a href="/kospermindo/message/view"><i class="entypo-attach"></i></a>-->
        <!--        </td>-->
        <td class="col-time"><?php echo date('H:i',strtotime($value->attributes['date_receive'])); ?></td>
      </tr>
    <?php } ?>
    </tbody>

    <!-- mail table footer -->
    <tfoot>
    <tr>
      <th width="5%">
        <div class="checkbox checkbox-replace">
          <input type="checkbox"/>
        </div>
      </th>
      <th colspan="4">

        <div class="mail-pagination" colspan="2">
          <strong><?= $totaldata; ?></strong> <span>of <?= $totaldata; ?></span>

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
