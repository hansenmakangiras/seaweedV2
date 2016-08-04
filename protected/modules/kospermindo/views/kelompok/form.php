

<form action="/kospermindo/kelompok/buat" method="POST" class="form-horizontal validate">

  <div class="form-group">
    <div class="col-md-5">
      <select name="lokasiKelompok" class="form-control input-lg" required>
        <option>Pilih Gudang</option>
        <?php if ($namaGudang && is_array($namaGudang)) { ?>
          <?php foreach ($namaGudang as $key => $value) { ?>
            <option value="<?= $value->id; ?>"><?= $value->lokasi; ?></option>
          <?php } ?>
        <?php } else { ?>
          <option><?= $namaGudang; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-5">
      <input id="namakelompok" type="text" name="namaKelompok" placeholder="Nama Kelompok" class="form-control input-lg" data-validate="required" />
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-info btn-lg" id="submit"><i class="entypo-plus"></i> &nbsp;Tambah
      </button>
    </div>
  </div>
</form>