<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Manajemen Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Manajemen Gudang</h2><br/>
</div>

<div class="row">
  <div class="col-md-12">
    <?php if (Yii::app()->user->hasFlash('success')) { ?>
      <div class="alert alert-success"><strong>
          <?php echo Yii::app()->user->getFlash('success'); ?></strong></div>
    <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
      <div class="alert alert-danger"><strong>
          <?php echo Yii::app()->user->getFlash('error'); ?></strong></div>
    <?php } ?>
    <div id="pesan" class="alert alert-success hidden"><strong></strong></div>
    <form action="/kospermindo/warehouse/ubah" method="POST" class="row">
      <div class="col-md-5">
        <input id="lokasi" type="text" placeholder="Lokasi Gudang" value="<?php //$data; ?>" name="lokasi" class="form-control input-lg">
      </div>
      <div class="col-md-7">
        <a id="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</a>
      </div>
    </form>
    <br>
    <br>
<!--    <div class="row">-->
<!--      <div class="col-md-6">-->
<!--        <table class="table table-bordered table-responsive table-hover">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Lokasi Gudang</th>-->
<!--            <th width="200px">Aksi</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          --><?php //if (!empty($data->getdata())) { ?>
<!--            --><?php //foreach ($data->getData() as $key => $tet) { ?>
<!--              <tr>-->
<!--                --><?php //if ($tet['status'] == 1) { ?>
<!--                  <td>--><?//= $tet['lokasi']; ?><!--</td>-->
<!--                  <td>-->
<!--                    <a id="sunting" class="btn btn-default btn-sm btn-icon icon-left"-->
<!--                       href="--><?php //echo Kospermindo::getBaseUrl() ?><!--/warehouse/ubah?id=--><?php //echo $tet->id; ?><!--"><i-->
<!--                        class="entypo-pencil"></i>Sunting</a>-->
<!--                    <a id="hapus" href="#" data-toggle="modal" data-target="#confirm-delete"-->
<!--                       class="btn btn-danger btn-sm btn-icon icon-left">Hapus<i class="entypo-cancel"></i></a>-->
<!--                  </td>-->
<!--                --><?php //} ?>
<!--              </tr>-->
<!--            --><?php //} ?>
<!--          --><?php //} else { ?>
<!--            <td>Tidak ada hasil ditemukan</td>-->
<!--          --><?php //} ?>
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->
<!--    </div>-->
    <?php
      //$pages = $data->getPagination();
      $this->widget('CLinkPager', array(
        //'pages' => $data->pagination,
      )); ?>

  </div>
</div>
<script>
  var baseurl;
</script>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
    // Tambah Data gudang
    $("#submit").click(function(){
      //$("#pesan").addClass("alert alert-success hidden");
      $.ajax({
        url: "/kospermindo/gudang/tambah",
        method: "POST",
        dataType: "JSON",
        data: {
            lokasi: $("input#lokasi").val(),            
        },
        success: function (response) {
        console.log(response);
          var login_status = response.login_status;
            setTimeout(function () {
              if (login_status === "invalid") {
                  $("#pesan").removeClass("alert alert-success hidden");
                  $("#pesan").addClass("alert alert-danger");
                  $("#pesan").text(response.message);
                  setTimeout(function () {
                    $("#pesan").addClass("hidden");
                  }, 2000);
              }else if (login_status === "success") {
                setTimeout(function () {
                    $("#pesan").removeClass("hidden");
                    $("#pesan").text(response.message);
                    var redirect_url = baseurl;
                    if (response.redirect_url && response.redirect_url.length) {
                        redirect_url = response.redirect_url;
                    }
                    window.location = redirect_url;
                }, 2000);
              }  
           }, 500);
        }
      });
    });
    
    // Update Data gudang
    $("#sunting").click(function(){
      
    });
    
  ', CClientScript::POS_END);
?>