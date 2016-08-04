<h2>Responsible For Warehouse</h2><br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <!-- <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=1" class="btn btn-default">Add Warehouse</a> -->
          <a href="<?php echo $this->baseUrl; ?>/kordinator/create" class="btn btn-default">Add Warehouse</a>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>
      <table id="tblkordinator" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
        <thead>
        <tr>
          
          <th>Warehouse Name</th>
          <th>Location</th>
          <th>Coordinator Name</th>
          <th>Yields amount</th>
          <th width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data->getData() as $tet) { ?>
          <tr>
          <?php if($tet['status']==1) { ?>
            
            <td><?= $tet['nama_gudang']; ?></td>
            <td><?= $tet['lokasi_gudang']; ?></td>
            <td><?= $tet['nama_koordinator']; ?></td>
            <td></td>
            <td>
                <a class="btn btn-sm btn-default" href="<?= $this->baseUrl; ?>/kordinator/update?id=<?= strtolower($tet['id_user']); ?>">
                  Edit
                </a>
                <a href="#" data-record-id="<?= strtolower($tet['id_user']); ?>" data-record-title="Confirmation"
                   data-href="<?php echo $this->baseUrl; ?>/kordinator/delete"
                   data-record-body="Apakah anda yakin ingin menonaktifkan data ini?"
                   data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Non Aktifkan
                </a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>