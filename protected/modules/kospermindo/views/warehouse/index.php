<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Data Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Data Gudang</h2><br/>
</div>

<div class="row">
  <div class="col-md-12">
    <div id="pesan">
      <?php if (Yii::app()->user->hasFlash('success')) { ?>
        <div id="pesan" class="alert alert-success"><strong>
            <?php echo Yii::app()->user->getFlash('success'); ?></strong></div>
      <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
        <div id="pesan" class="alert alert-danger"><strong>
            <?php echo Yii::app()->user->getFlash('error'); ?></strong></div>
      <?php } ?>
    </div>
    <!--    <div id="pesan" class="alert alert-success hidden"><strong></strong></div>-->
    <form action="/kospermindo/warehouse" method="POST" class="row">
      <div class="col-md-5">
        <input id="lokasi" type="text" placeholder="Lokasi Gudang" name="lokasi" class="form-control input-lg">
      </div>
      <div class="col-md-7">
        <button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>
      </div>
    </form>
    <br>
    <br>
    <div class="row">
      <div class="col-md-6">
        <table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
          <thead>
          <tr>
            <th>Lokasi Gudang</th>
            <th width="200px">Aksi</th>
            <!-- <th width="20%">Action</th> -->
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($data->getdata())) { ?>
            <?php foreach ($data->getData() as $key => $value) { ?>
              <tr>
                <?php if ($value['status'] == 1) { ?>
                  <td><?= $value['lokasi']; ?></td>
                  <td>
                    <a class="btn btn-default btn-sm btn-icon icon-left"
                       href="<?= $this->baseUrl; ?>/kospermindo/warehouse/ubah?id=<?= strtolower($value['id']); ?>"><i
                        class="entypo-pencil"></i>Sunting</a>
                    <a href="#" data-record-id="<?= $value['id']; ?>" data-record-title="Confirmation"
                       data-href="<?php echo $this->baseUrl; ?>/kospermindo/warehouse/delete"
                       data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
                       data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
                        class="entypo-cancel"></i>
                    </a>
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <td colspan="2">Tidak ada hasil ditemukan</td>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
          $pages = $data->getPagination();
          $this->widget('CLinkPager', array(
            'pages'             => $data->pagination,
            'pageSize'          => 10,
            'htmlOptions'       => array('class' => 'pagination'),
            'firstPageCssClass' => 'active',
            'currentPage'       => '',
            'nextPageLabel'     => 'Berikutnya',
            'prevPageLabel'     => 'Sebelumnya',
          ));
        ?>
        <!--        <ul class="pagination">-->
        <!--          <li><a href="#"><i class="entypo-left-open-mini"></i></a></li>-->
        <!--          <li><a href="#">1</a></li>-->
        <!--          <li class="active"><a href="#">2</a></li>-->
        <!--          <li><a href="#">3</a></li>-->
        <!--          <li class="disabled"><a href="#">4</a></li>-->
        <!--          <li><a href="#">5</a></li>-->
        <!--          <li><a href="#">6</a></li>-->
        <!--          <li><a href="#"><i class="entypo-right-open-mini"></i></a></li>-->
        <!--        </ul>-->
      </div>
    </div>
  </div>
</div>

<script>
  var baseurl;
</script>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
     Yii::app()->clientScript->registerScript(\'close-alert\', \'
  setTimeout(function () {
    $("#pesan").addClass("hidden");
  }, 5000);
//    // Tambah Data gudang
//    $("#submit").click(function(){
//      //$("#pesan").addClass("alert alert-success hidden");
//      $.ajax({
//        url: "/kospermindo/warehouse/tambah",
//        method: "POST",
//        dataType: "JSON",
//        data: {
//            lokasi: $("input#lokasi").val(),
//        },
//        success: function (response) {
//        console.log(response.data);
//          var login_status = response.login_status;
//            setTimeout(function () {
//              if (login_status === "invalid") {
//                  $("#pesan").removeClass("alert alert-success hidden");
//                  $("#pesan").addClass("alert alert-danger");
//                  $("#pesan").text(response.message);
//                  setTimeout(function () {
//                    $("#pesan").addClass("hidden");
//                  }, 2000);
//              }else if (login_status === "success") {
//                $("#pesan").removeClass("hidden");
//                $("#pesan").text(response.message);
//
//                $.each(response.data,function(index,value){
//                  console.log(value, index);
//                });
////                setTimeout(function () {
////                    $("#pesan").removeClass("hidden");
////                    $("#pesan").text(response.message);
////                    $("#tblwarehouse table > tbody:first").append(data);
////                    var redirect_url = baseurl;
////                    if (response.redirect_url && response.redirect_url.length) {
////                        redirect_url = response.redirect_url;
////                    }
////                    window.location = redirect_url;
////                }, 2000);
//              }
//           }, 500);
//        }
//      });
//    });
//
//    // Update Data gudang
//    $("#sunting").click(function(){
//
//    });
    
  ', CClientScript::POS_END);
?>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
  setTimeout(function () {
    $("#pesan").addClass("hidden");
  }, 5000);   
  ', CClientScript::POS_END);
?>