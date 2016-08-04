<table id="tblkomoditi" class="table table-bordered table-responsive table-hover" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th width="15%">ID</th>
    <th>Tipe</th>
    <th>Jenis Seaweed</th>
    <th>Deskripsi</th>
    <th width="15%">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($datakomoditi as $tet) { ?>
  <?php $nama = Seaweed::model()->getSeaweedById($tet->seaweed_id)  ?>
    <tr>
      <td><?= strtoupper($tet->id); ?></td>
      <td><?= $tet->type; ?></td>
      <td><?= $nama['nama_komoditi']; ?></td>
      <td><?= $tet->description; ?></td>
      <td>
        <a class="btn btn-sm btn-default"
           href="<?= $this->baseUrl; ?>/komoditi/update?id=<?= $tet->id; ?>">Edit</a>
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->baseUrl; ?>/komoditi/delete?id=<?= $tet->id; ?>"
           onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Non Aktifkan</a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>