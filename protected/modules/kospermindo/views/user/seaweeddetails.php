<!--<h1 class="margin-bottom">Settings</h1>-->

<br/>
<div class="row">
  <div class="col-md-9 col-sm-7">
    <h2>Seaweed Details : <strong><?= ucfirst($seaweed);?></strong></h2>
  </div>

  <div class="col-md-3 col-sm-5">

    <form method="get" role="form" class="search-form-full">

      <div class="form-group">
        <input type="text" class="form-control" name="s" id="search-input" placeholder="Search..."/>
        <i class="entypo-search"></i>
      </div>

    </form>

  </div>
</div>
<!-- Member Entries -->
<?php foreach ($detail as $value) { ?>

  <div class="member-entry">

<!--    <a href="#" class="member-img">-->
<!--      <img src="--><?php //$this->baseUrl?><!--/static/admin/images/member.jpg" class="img-responsive img-rounded"/>-->
<!--      <i class="entypo-forward"></i>-->
<!--    </a>-->
    <div class="member-details">
      <h4>
        <a href="<?php echo $this->baseUrl; ?>/profile?id=<?php echo $value->id; ?>"><?= ucfirst($value->id_user); ?> <strong><?php  ?></strong></a>
      </h4>

      <!-- Details with Icons -->
      <div class="row info-list">

        <div class="col-sm-4">
          <i class="entypo-database"></i>
          <a href="#">Jenis Seaweed : <label class="label label-primary"><?= !empty($value->nama_komoditi) ? strtoupper($value->nama_komoditi) : "No Results"; ?></label></a>
        </div>

        <div class="col-sm-4">
          <i class="entypo-water"></i>
          <a href="#">Kadar Air : <strong><?= $value->kadar_air; ?>%</strong></a>
        </div>

        <div class="col-sm-4">
          <i class="entypo-clipboard"></i>
          <a href="#">Jumlah Bentangan : <strong><?= $value->jumlah_bentangan; ?></strong> Meter</a>
        </div>

        <div class="clear"></div>

        

        <div class="col-sm-4">
          <i class="entypo-traffic-cone"></i>
          <a href="#">Total Panen All : <strong><?= $value->total_panen; ?></strong> Ton</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<div class="row">
  <div class="col-md-12">
    <ul class="pager">
      <li><a href="#"><i class="entypo-left-thin"></i> Previous</a></li>
      <li><a href="#">Next <i class="entypo-right-thin"></i></a></li>
    </ul>
  </div>
</div>
