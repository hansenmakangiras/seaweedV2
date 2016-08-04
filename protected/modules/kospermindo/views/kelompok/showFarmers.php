<!--<h1 class="margin-bottom">Settings</h1>-->
<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/kelompok">Kelompok</a>
    </li>
    <li class="active">
      <strong><?php echo 'Detail Kelompok'; ?></strong>
    </li>
  </ol>
  <h2>Detail Gudang : <strong><?php echo ucfirst($_GET['id']); ?></strong></h2><br/>
</div>
<br/>
<div class="row">
  <div class="col-md-12">
    <div class="panel minimal minimal-gray">
      <div class="panel-heading"></div>
      <div class="panel-body">
        <?php foreach ($model as $value) { ?>
          <div class="member-entry">

            <!--    <a href="#" class="member-img">-->
            <!--      <img src="--><?php //$this->baseUrl?><!--/static/admin/images/member.jpg" class="img-responsive img-rounded"/>-->
            <!--      <i class="entypo-forward"></i>-->
            <!--    </a>-->
            <div class="member-details">
              <h4>
                <a href="#"><strong><?= TabelKelompok::model()->getLokasiGudang($value->idgudang); ?></strong></a>
              </h4>
              <!-- Details with Icons -->
              <div class="row info-list">
                <div class="col-sm-12 col-md-push-1">
                  <i class="entypo-user"></i>
                  <a href="#">Nama Kelompok : <strong><?= $value->nama_kelompok; ?></strong> %</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- <div class="row">
  <div class="col-md-12">
    <ul class="pager">
      <li><a href="#"><i class="entypo-left-thin"></i> Previous</a></li>
      <li><a href="#">Next <i class="entypo-right-thin"></i></a></li>
    </ul>
  </div>
</div> -->
