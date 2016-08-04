<h2>Farmer Details</h2><br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
    <div class="panel-heading">
      <div class="form-group">
        <label class="col-sm-2 control-label">Farmer Name</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['nama_petani']; ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
          <label class="col-sm-10 control-label"><?= $model_petani['alamat']; ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Telephone</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['no_telp']; ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Identity Number</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['nmr_identitas']; ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Place of Birth</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['tempat_lahir']; ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Date of Birth</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= Helper::DateToIndo($model_petani['tanggal_lahir']); ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Spacious Location</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['luas_lokasi']; ?></label>
        </div>
      </div>
      <!--<div class="form-group">
        <label class="col-sm-2 control-label">Jenis Komoditi</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['jenis_komoditi']; ?></label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kadar Air</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['kadar_air']; ?></label>
        </div>
      </div>-->
      <div class="form-group">
        <label class="col-sm-2 control-label">Amount of Stretch</label>
        <div class="col-sm-10">
          <label class="col-sm-2 control-label"><?= $model_petani['jumlah_bentangan']; ?></label>
        </div>
      </div>
      </div>
    </div>
  </div>
  </div>