<h2>Seaweed Management</h2><br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0" style="margin-bottom: 50px;">
      <div class="panel-heading">
        <div class="panel-title">
          <?php $this->renderPartial('menu'); ?>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>
      <?php if($this->id === 'commodity' and $this->action->id !== 'index') { ?>
      <?php $this->renderPartial('viewtipe',array('datakomoditi' => $datakomoditi)); ?>
      <?php } else { ?>
        <table id="tblkomoditi" class="table table-bordered table-responsive table-hover" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th width="-40%">ID</th>
            <th>User</th>
            <th>Nama Seaweed</th>
<!--            <th>Jenis Komoditi</th>-->
            <th>Kadar Air</th>
            <th>Jumlah Bentangan</th>
            <th>Status</th>
            <th width="15%">Action</th>
          </tr>
          </thead>
          <tbody>
          <?php //Helper::dd($data)?>
          <?php foreach ($data as $tet) { ?>
            <tr>
              <td><?= strtoupper($tet->id); ?></td>
              <td><?= ($tet->id_user === 0) ? $tet->id_user : Yii::app()->user->name; ?></td>
              <td><?= $tet->nama_komoditi; ?></td>
              <?php //echo $tet->jenis_komoditi; ?><!--</td>-->
              <td><?= $tet->kadar_air; ?></td>
              <td><?= $tet->jumlah_bentangan; ?></td>
              <td><?php echo ($tet->status === '0') ? 'Non Aktif' : 'Aktif'; ?></td>
              <td>
                <a class="btn btn-sm btn-default" href="<?= $this->baseUrl; ?>/kospermindo/commodity/update?id=<?= strtolower($tet->id); ?>">
                  Edit
                </a>
                <?php if($tet->status === '0') { ?>
                  <a href="#" data-record-id="<?= strtolower($tet->id); ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/kospermindo/commodity/aktifkandata"
                         data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Aktifkan
                  </a>
                <?php } else { ?>
                  <a href="#" data-record-id="<?= strtolower($tet->id); ?>" data-record-title="Confirmation"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/commodity/delete"
                     data-record-body="Apakah anda yakin ingin menghapus data ini?"
                     data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Non Aktifkan
                  </a>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      <?php }  ?>
    </div>

  </div>
<!--  <div class="col-md-12">-->
<!--  <h3>Type Commodity</h3><br />-->
<!--    <div class="panel panel-primary">-->
<!--      <div class="panel-heading">-->
<!--        <div class="panel-title">-->
<!---->
<!--        </div>-->
<!--        <div class="panel-body">-->
<!--          --><?php //$this->renderPartial('viewtipe',array('datakomoditi' => $datakomoditi)); ?>
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
</div>