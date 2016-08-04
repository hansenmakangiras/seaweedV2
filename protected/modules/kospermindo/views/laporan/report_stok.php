<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Laporan Produksi'; ?></strong>
    </li>
  </ol>
  <h2>Laporan Produksi</h2><br/>
</div>

<div class="col-md-12">
  <hr/>

  <?php if (Users::model()->isSuperUser() == true) { ?>
    <table id="tblpetani" class="table table-hover table-responsive" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="10%">Username</th>
        <th>Help Desk Phone</th>
        <th width="15%">Email</th>
        <?php if (Users::model()->isSuperUser() == true) { ?>
          <th>Type of Commodity</th>
        <?php } ?>
        <th>Status</th>
        <th width="15%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($data as $value) { ?>

        <tr>
          <td><?= $value->id; ?></td>
          <td><?= $value->username; ?></td>
          <td><?= $value->no_handphone; ?></td>
          <td><?= $value->email; ?></td>
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <td><?= $value->komoditi; ?></td>
          <?php } ?>
          <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
          <td>
            <a class="btn btn-sm btn-default"
               href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value->id); ?>">
              Edit
            </a>
            <?php if ($value->status === '0') { ?>
              <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                 data-href="<?php echo $this->baseUrl; ?>/user/aktifkandata"
                 data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
              </a>
            <?php } else { ?>
              <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
                 data-href="<?php echo $this->baseUrl; ?>/user/delete"
                 data-record-body="Apakah anda yakin ingin menghapus data ini?"
                 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Disable
              </a>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>

      </tbody>
    </table>
  <?php } else { ?>
    <?php $this->renderPartial('/widget/search-filter'); ?>

    <br>
    <br/>
    <table id="tblpetani" class="table table-hover table-responsive table-bordered" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Item</center>
        </th>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Sango-Sango Laut</center>
        </th>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Spinosom</center>
        </th>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Euchema Cotoni</center>
        </th>
        <th colspan="5">
          <center>Gracillia</center>
        </th>
      </tr>
      <tr>
        <th>
          <center>KW 3</center>
        </th>
        <th>
          <center>KW 4</center>
        </th>
        <th>
          <center>BS</center>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          <center>Total Panen</center>
        </td>
        <?php { ?>
          <td>
            <center><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[1]['total_panen']) ? $summary[1]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[2]['total_panen']) ? $summary[2]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[3]['total_panen']) ? $summary[3]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[4]['total_panen']) ? $summary[4]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[5]['total_panen']) ? $summary[5]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
        <?php } ?>

      </tr>
      <tr>
        <td>
          <center>Kadar Air</center>
        </td>
        <td>
          <center><?= !empty($summary[0]['kadar_air']) ? $summary[0]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[1]['kadar_air']) ? $summary[1]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[2]['kadar_air']) ? $summary[2]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[3]['kadar_air']) ? $summary[3]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[4]['kadar_air']) ? $summary[4]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[5]['kadar_air']) ? $summary[5]['kadar_air'] . "%" : "-"; ?></center>
        </td>

      </tr>
      <tr>
        <td>
          <center>Jumlah Bentangan</center>
        </td>
        <td>
          <center><?= !empty($summary[0]['jumlah_bentangan']) ? $summary[0]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[1]['jumlah_bentangan']) ? $summary[1]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[2]['jumlah_bentangan']) ? $summary[2]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[3]['jumlah_bentangan']) ? $summary[3]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[4]['jumlah_bentangan']) ? $summary[4]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[5]['jumlah_bentangan']) ? $summary[5]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>

      </tr>
      <tr>
        <td>
          <center>Aksi</center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=1"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=2"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=3"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=4"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=5"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=6"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
      </tr>
      </tbody>
    </table>

  <?php } ?>

</div>
</div>

<?php
  Yii::app()->clientScript->registerScript('showNotif', '
    var element = $("#main-menu li[data-nav=\'laporan\']");
    
    element.addClass("active opened");
    element.find("ul").addClass("visible").removeAttr("style");
    element.find("ul").find("li:nth-child(1)").addClass("active");

    $("#add").click(function (e) {
      toastr.error("Please Add Warehose Name First!!!", pesan);
      e.preventDefault();
    });
    
    function printData() {
      var divToPrint = document.getElementById("printTable");
      newWin = window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      //newWin.close();
    }
  
    $(\'#cetak\').on(\'click\', function () {
      printData();
    })
	');
?>
