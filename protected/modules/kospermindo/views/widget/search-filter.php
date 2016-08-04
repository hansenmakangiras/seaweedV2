<div class="row">
  <form method="post" class="search-bar" action="" enctype="application/x-www-form-urlencoded">
    <div class="col-md-2">
      <a type="button" style="width: 100%" class="btn btn-lg btn-primary btn-icon" target="_blank"
         href="<?= $this->baseUrl; ?>/kospermindo/laporan/cetakhasilpetani">Cetak<i class="entypo-print"></i></a>
    </div>
    <div class="col-md-2">
      <a type="button" href="#" style="width: 100%" class="btn btn-primary btn-lg btn-icon" data-toggle="modal"
         data-target="#modal-filter">
        Filter
        <i class="entypo-list"></i></a>
    </div>
    <div class="col-md-8">
      <div class="input-group">
        <input type="text" class="form-control input-lg" name="search" placeholder="Cari Sesuatu...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-lg btn-primary">
            <i class="entypo-search"></i>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>