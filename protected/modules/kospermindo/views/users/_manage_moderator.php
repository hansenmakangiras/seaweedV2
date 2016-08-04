<!--<h1 class="margin-bottom">Settings</h1>-->

<br />
<div class="row">
  <div class="col-md-12">
    <h2 class="page-title">Manajemen Moderator</h2>
    <div class="hr-dashed"></div>
    <div class="panel panel-primary" data-collapsed="0">

      <div class="panel-heading">
        <div class="panel-title">
          <!-- <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=2" class="btn btn-default">Add Group</a> -->
          <a href="<?php echo $this->baseUrl; ?>/kospermindo/groups/create" class="btn btn-default" id="<?php if($pesan=='gagal') { echo "add"; } ?>">Tambah Kelompok</a>
        </div>

        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>
      <?php if (Users::model()->isSuperUser() == true) { ?>
        <table id="tblpetani" class="table table-responsive table-hover">
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
              <td><?= ($value->status === '1') ? 'Aktif' : 'Non Aktif'; ?></td>
              <td>
                <a class="btn btn-sm btn-default"
                   href="<?= $this->baseUrl; ?>/kospermindo/user/update?id=<?= strtolower($value->id); ?>">
                  Edit
                </a>
                <?php if ($value->status === '0') { ?>
                  <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/aktifkandata"
                     data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                     data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                  </a>
                <?php } else { ?>
                  <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
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
        <a href="<?= $this->baseUrl; ?>/kospermindo/users/create"
           class=" btn btn-black btn-sm btn-icon icon-left">
          <i class="entypo-user-add"></i>
          Tambah Moderator
        </a>
        <br/>
        <table id="tblpetani" class="table table-responsive table-hover">
          <thead>
          <tr>
            <th width="5%">ID</th>
            <th>Nama Moderator</th>
            <th>Status</th>
            <th>Aksi</th>

          </tr>
          </thead>
          <tbody>
          <?php foreach ($moderator as $value) { ?>

            <tr>
              <td><?= $value->id; ?></td>
              <td><?= $value->username; ?></td>
              <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
              <td>
                <?php if (($value->status) === '0') { ?>
                  <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/users/delete"
                     data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                     data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Aktifkan
                  </a>
                <?php } else { ?>
                  <a class="btn btn-default btn-sm btn-icon icon-left"
                     href="<?= $this->baseUrl; ?>/kospermindo/users/update?id=<?= strtolower($value['id']); ?>"><i
                      class="entypo-pencil"></i>
                    Edit
                  </a>
                  <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/users/delete"
                     data-record-body="Apakah anda yakin ingin menghapus data ini?"
                     data-toggle="modal" data-target="#confirm-delete"
                     class="btn btn-danger btn-sm btn-icon icon-left">Hapus
                    <i class="entypo-cancel"></i>
                  </a>

                <?php } ?>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      <?php } ?>
      <div class="panel panel-footer">
        <div class="row">
          <div class="col-sm-6">
            <?php
              //echo Helper::dd($data->pagination);
              $pages = $data->getPagination();
              $this->widget('CLinkPager', array(
                'pages' => $data->pagination,
//                'currentPage'=>$pages->currentPage,
//                'itemCount'=>$data->getItemCount(),
//                'pageSize'=>$pages->pageSize,
//                'maxButtonCount'=>5,
//                //'nextPageLabel'=>'My text >',
//                'header'=>'',
//                'htmlOptions'=>array('class'=>'pagination pagination-sm'),
              ));?>
          </div>
          <div class="col-sm-6">
            <!--            <h5>Total Data : --><?php //echo $data->getTotalItemCount(); ?><!--</h5>-->
          </div>
        </div>
      </div>
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