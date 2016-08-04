<h2 class="page-title"><?php echo $this->pageTitle; ?></h2>
<div class="row">
  <div class="col-md-12">

    <div class="panel panel-primary" data-collapsed="0">

      <div class="panel-heading">
        <div class="panel-title">
          <a href="/company/create" class="btn btn-default">Create new company</a>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>
      <table id="tblpetani" class="display table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
          <th>Prefix</th>
          <th>Nama</th>
          <th>Lokasi</th>
          <th>Telepon</th>
          <th>Alamat</th>
          <th width="13%">Tipe Komoditi</th>
          <th width="13%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->getData() as $value) { ?>
          <tr>
            <td><?= $value->prefix; ?></td>
            <td><?= $value->name; ?></td>
            <td><?= $value->location; ?></td>
            <td><?= $value->telephone; ?></td>
            <td><?= $value->address; ?></td>
            <td><?= KomoditiType::trKomoditiTipe($value->komoditi_type); ?></td>
            <td>
              <a class="btn btn-sm btn-default"
                 href="<?= $this->baseUrl; ?>/company/update?id=<?= strtolower($value->id); ?>">Edit</a>
              <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                 data-href="<?php echo $this->baseUrl; ?>/company/delete"
                 data-record-body="Apakah anda yakin ingin menghapus data ini?"
                 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Delete
              </a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>



