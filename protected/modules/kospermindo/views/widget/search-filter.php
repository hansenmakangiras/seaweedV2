<div class="row hidden-print" >
  <form method="post" class="search-bar" action="" enctype="application/x-www-form-urlencoded">
    <div class="col-md-2">
<!--      <a type="button" style="width: 100%" class="btn btn-lg btn-primary btn-icon" target="_blank"-->
<!--         href="--><?php //echo $this->baseUrl; ?><!--/kospermindo/laporan/cetakhasilpetani">Cetak<i class="entypo-print"></i>-->
<!--      </a>-->
      <a type="button" style="width: 100%" class="btn btn-lg btn-primary btn-icon hidden-print" target="_blank"
         href="javascript:window.print();">Cetak<i class="entypo-print"></i>
      </a>
    </div>
    <div class="col-md-2">
      <a type="button" href="#" style="width: 100%" class="btn btn-primary btn-lg btn-icon hidden-print" data-toggle="modal"
         data-target="#modal-filter">
        Filter
        <i class="entypo-list"></i></a>
    </div>
    <div class="col-md-8 hidden-print">
      <div class="input-group">
        <input type="text" class="form-control input-lg" name="search" placeholder="Cari Sesuatu...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-lg btn-primary hidden-print">
            <i class="entypo-search"></i>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>