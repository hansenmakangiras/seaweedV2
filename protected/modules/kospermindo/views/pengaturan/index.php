<h1 class="margin-bottom">Pengaturan</h1>
<ol class="breadcrumb 2">
  <li>
    <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Dashboard</a>
  </li>
  <li class="active">
    <strong>
      <?= 'Pengaturan'; ?>
    </strong>
  </li>
</ol>

<br/>

<form role="form" method="POST" class="form-horizontal form-groups-bordered validate" action="/kospermindo/pengaturan">

  <div class="row">
    <div class="col-md-12">
      <?php $this->renderPartial("/alert/alert"); ?>
      <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
          <div class="panel-title">
            Pengaturan Akun
          </div>

          <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          </div>
        </div>

        <div class="panel-body">

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Nama Site</label>

            <div class="col-sm-5">
              <input type="text" name="Settings[site-name]" class="form-control" id="sitename" value="Neon">
            </div>
          </div>

          <div class="form-group">
            <label for="field-3" class="col-sm-3 control-label">Alamat Website</label>

            <div class="col-sm-5">
              <input type="text" class="form-control" name="Settings[site-url]" id="site-url"
                     data-validate="required,url" value="http://exampledomain.com/neon">
            </div>
          </div>

          <div class="form-group">
            <label for="field-4" class="col-sm-3 control-label">Alamat Email</label>

            <div class="col-sm-5">
              <input type="text" class="form-control" name="Settings[email]" id="email" data-validate="required,email"
                     value="john@doe.com">
              <span class="description">Here you will receive site notifications.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="field-4" class="col-sm-3 control-label">Help Desk Phone</label>

            <div class="col-sm-5">
              <input type="text" class="form-control" name="Settings[phone]" id="phone" data-validate="required"
                     value="+62 8114199010">
              <span class="description">Here you will receive site notifications.</span>
            </div>
          </div>
          <hr>
          <h4><span><strong>Pengaturan Perkiraan Pendapatan</strong></span></h4><br>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Jumlah Bal</label>

            <div class="col-sm-5">

              <input type="text" name="Settings[jumlah-bal]" id="jumlah-bal" class="form-control"
                     data-validate="required,number" value="5"/>

            </div>
          </div>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Nilai Tetap</label>

            <div class="col-sm-5">

              <input type="text" name="Settings[nilai-tetap]" id="maximum-login" class="form-control"
                     data-validate="required,number" value="50"/>

            </div>
          </div>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Biaya Proses</label>

            <div class="col-sm-5">
              <input type="text" name="Settings[biaya-proses]" id="biaya-proses" class="form-control" data-validate="required,number" value="50"/>
            </div>
          </div>
          <div class="form-group">
            <label for="field-5" class="col-sm-3 control-label">Biaya Kontainer</label>

            <div class="col-sm-5">
              <input type="text" name="Settings[biaya-kontainer]" id="biaya-kontainer" class="form-control" data-validate="required,number" placeholder="50"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group default-padding" style="margin-bottom: 50px;">
    <button type="submit" class="btn btn-success">Save Changes</button>
    <button type="reset" class="btn">Reset Previous</button>
  </div>
</form>
