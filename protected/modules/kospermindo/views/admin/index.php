<!--<h1 class="margin-bottom">Settings</h1>-->

<br />
<div class="row">
  <div class="col-md-12">
    <h2 class="page-title">Pengguna</h2>
    <div class="hr-dashed"></div>
    <div class="panel panel-primary" data-collapsed="0">

      <div class="panel-heading">
        <div class="panel-title">
          <!-- <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=2" class="btn btn-default">Add Group</a> -->
          <a href="<?php echo $this->baseUrl; ?>/kospermindo/admin/create" class="btn btn-default btn-icon icon-left">Tambah Pengguna<i class="entypo-plus"></i></a>
        </div>

        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <table class="table table-hover table-responsive">
        <thead>
        <tr>
          <th>No.</th>
          <th>Username</th>
          <th>Perusahaan</th>
          <th>Komoditi</th>
          <th>Level</th>
          <th>Action</th>
        </tr>
        </thead>
        <?php if (!empty($data->getData())) { ?>
          <tbody>
            <?php foreach($data->getData() as $value) { ?>
              <tr>
                <?php if($value->status==1) { ?>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->username; ?></td>
                <td><?php echo $value->companyid; ?></td>
                <td><?php echo $value->seaweed_id; ?></td>
                <td><?php echo $value->levelid; ?></td>
                <!--<td><?php echo ($value->status !== 0) ? 'Aktif' : 'Non Aktif' ; ?></td> -->
                <td>
                  <a class = "btn btn-sm btn-primary tooltip-default " data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Data" href="<?= $this->baseUrl; ?>/kospermindo/admin/update?id=<?= strtolower($value->id); ?>"><i class="entypo-pencil"></i> </a>
                  <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/admin/delete"
                     data-record-body="Apakah anda yakin ingin menghapus data ini?"
                     data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-primary"><i class="entypo-trash"></i>
                  </a>
                  <a class = "btn btn-sm btn-primary tooltip-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Data Petani" href="<?= $this->baseUrl; ?>/kospermindo/admin/view?id=<?= strtolower($value->id); ?>"><i class="entypo-users"></i> </a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        <?php } else { ?>
          <tr>
            <td>Hasil tidak ditemukan</td>
          </tr>
        <?php } ?>


      </table>

    </div>

  </div>
</div>
<script>
  var pesan = '<?php $pesan ?>';
</script>
<?php
  Yii::app()->clientScript->registerScript('showNotif','
    $("#add").click(function (e) {
    toastr.error("Please Add Warehose Name First!!!", pesan);
    e.preventDefault();
  });
  ');
?>