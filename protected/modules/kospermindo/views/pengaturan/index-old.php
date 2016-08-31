
<div class="headline">

  <ol class="breadcrumb bc-3">

    <li>

      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>

    </li>

    <li class="active">

      <strong><?php echo 'Pengaturan'; ?></strong>

    </li>

  </ol>

  <h2>Pengaturan</h2><br/>

</div>

<form role="form" method="POST" class="form-horizontal form-groups-bordered validate" action="/kospermindo/pengaturan">

  <div class="row">
    <div class="col-md-12">
      <?php $this->renderPartial("/alert/alert"); ?>
      <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
          <div class="panel-title">
            Pengaturan Umum
          </div>

          <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          </div>
        </div>

        <div class="panel-body">

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Nama Situs</label>

            <div class="col-sm-5">
              <input type="text" name="Settings[site-name]" class="form-control" id="sitename" value="Panrita">
              <span class="description">Nama website resmi.</span>
            </div>
          </div>

          <div class="form-group">
            <label for="field-3" class="col-sm-3 control-label">Alamat Website</label>

            <div class="col-sm-5">
              <input type="text" class="form-control" name="Settings[site-url]" id="site-url"
                     data-validate="required,url" value="https://panrita.id/kospermindo">
              <span class="description">Alamat website yang digunakan pada aplikasi.</span>
            </div>
          </div>

          <div class="form-group">
            <label for="field-4" class="col-sm-3 control-label">Alamat Email</label>

            <div class="col-sm-5">
              <input type="text" class="form-control" name="Settings[email]" id="email" data-validate="required,email"
                     value="kospermindo@panrita.id">
              <span class="description">Alamat email resmi yang digunakan pada aplikasi.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="field-4" class="col-sm-3 control-label">Help Desk Phone</label>

            <div class="col-sm-5">
              <input type="text" class="form-control" name="Settings[phone]" id="phone" data-validate="required"
                     value="+62 8114199010">
              <span class="description">No Telepon yang akan digunakan sebagai bantuan.</span>
            </div>
          </div>
          <hr>
          <h4><span><strong>Pengaturan Perkiraan Pendapatan</strong></span></h4><br>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Jumlah Bal</label>

            <div class="col-sm-5">

              <input type="text" name="Settings[jumlah-bal]" id="jumlah-bal" class="form-control"
                     data-validate="required,number" value="5"/>
              <span class="description">Nilai default jumlah ton.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Nilai Tetap</label>

            <div class="col-sm-5">

              <input type="text" name="Settings[nilai-tetap]" id="maximum-login" class="form-control"
                     data-validate="required,number" value="50"/>
              <span class="description">Nilai tetap untuk perkiraan pendapatan.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Biaya Proses</label>

            <div class="col-sm-5">
              <input type="text" name="Settings[biaya-proses]" id="biaya-proses" class="form-control" data-validate="required,number" value="50"/>
              <span class="description">Nilai biaya proses untuk perkiraan pendapatan.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Biaya Kontainer</label>

            <div class="col-sm-5">
              <input type="text" name="Settings[biaya-kontainer]" id="biaya-kontainer" class="form-control" data-validate="required,number" placeholder="50"/>
              <span class="description">Nilai biaya container untuk perkiraan pendapatan.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group default-padding" style="margin-bottom: 50px;">
    <div class="col-sm-5 col-sm-offset-4">
      <button type="submit" class="btn btn-success btn-lg"><i class="entypo-check"></i> Simpan</button>
      <button type="reset" class="btn btn-danger btn-lg"><i class="entypo-cancel"></i>Batal</button>
    </div>
  </div>
</form>
