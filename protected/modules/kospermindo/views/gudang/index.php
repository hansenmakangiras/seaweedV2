<?php
  Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"master\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible');
		element.find('ul li:nth-child(1)').addClass('active');
");
?>

<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Data Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Manajemen Data Gudang</h2><br/>
</div>

<div class="row">
  <div class="col-md-12">
    <div id="pesan" class="row">
      <div class="col-md-6">
        <?php if (Yii::app()->user->hasFlash('success')) { ?>
          <div class="alert alert-success">
            <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?></strong>
          </div>
        <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
          <div class="alert alert-danger">
            <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('error')); ?></strong>
          </div>
        <?php } else { ?>
          <div></div>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <a id="tambah" class="btn btn-success btn-lg" data-type ="insert" data-toggle="modal" data-target="#modal-insert"><i
            class="entypo-plus"></i>&nbsp;Tambah
        </a>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
          <thead>
          <tr>
            <th class="text-center" rowspan="2" width="5%">No</th>
            <th class="text-center" rowspan="2">Nama Gudang</th>
            <th class="text-center" rowspan="2">Luas Gudang</th>
            <th class="text-center" rowspan="2">Telpon / HP</th>
            <th class="text-center" colspan="3">Lokasi Gudang</th>
            <th class="text-center" rowspan="2">Penanggung Jawab Gudang</th>
            <th class="text-center" width="200px" rowspan="2">Aksi</th>
          </tr>
          <tr>
            <th class="text-center">Alamat</th>
            <th class="text-center">Provinsi</th>
            <th class="text-center">Kabupaten</th>
          </tr>
          <thead>

          <tbody>
          <?php if (!empty($data->getdata())) {
            $i = 1; ?>
            <?php foreach ($data->getData() as $key => $value) { ?>
              <tr>
                <?php if ($value['status'] == 1) { ?>
                  <td class="text-center"><?= $i; ?></td>
                  <td class="text-center"><?= $value['nama']; ?></td>
                  <td class="text-center"><?= $value['luas'] . " m<sup>2</sup>"; ?></td>
                  <td class="text-center"><?= $value['telp']; ?></td>
                  <td><?= $value['alamat']; ?></td>
                  <td><?= Gudang::model()->getProvinsi($value['provinsi']); ?></td>
                  <td><?= Gudang::model()->getKabupaten($value['kabupaten']); ?></td>
                  <td><?= $value['koordinator']; ?></td>
                  <td>
                    <a id="sunting" class="btn btn-default btn-sm btn-icon icon-left"
                       href="#" data-type="edit" data-toggle='modal' data-target="#modal-edit" data-id='<?= $value['id_gudang']; ?>'><i
                        class="entypo-pencil"></i>Sunting</a>
                    <a href="#" data-record-id="<?= $value['id_gudang'] ?>" data-record-title="Konfirmasi"
                       data-href="<?php echo $this->baseUrl; ?>/kospermindo/gudang/hapus"
                       data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
                       data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
                        class="entypo-trash"></i>
                    </a>
                  </td>
                  <?php $i++;
                } ?>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <td colspan="10" class="text-center">Tidak ada hasil ditemukan</td>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12 center">
    <?php
      $pages = $data->pagination;
      $this->widget('CLinkPager', array(
        'pages'                => $pages,
        'maxButtonCount'       => 30,
        'pageSize'             => 10,
        'itemCount'            => (int)$data->totalItemCount,
        'htmlOptions'          => array('class' => 'pagination pagination-custom'),
        'hiddenPageCssClass'   => '',
        'selectedPageCssClass' => 'active',
        'header'               => '',
        'nextPageLabel'        => 'Berikutnya',
        'prevPageLabel'        => 'Sebelumnya',
        'lastPageLabel'        => 'Akhir',
        'firstPageLabel'       => 'Awal',
      ));
    ?>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Gudang</h4>
      </div>

      <div id="tes"></div>
      <form action="/kospermindo/gudang/tambah" method="POST" class="form-horizontal">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-12">
                  <h4><b>Informasi Dasar</b></h4>
                  <hr>
                </div>

                <div class="col-md-6">
                  <input id="nama-gudang" type="text" placeholder="Nama Gudang" name="nama_gudang"
                         class="form-control input-lg" required>
                  <br>
                </div>

                <div class="col-md-6">
                  <input id="pj_gudang" type="text" placeholder="Penanggung Jawab Gudang" name="pj_gudang"
                         class="form-control input-lg" required>
                  <br>
                </div>

                <div class="col-md-6">
                  <input type="number" id="tel" placeholder="Telpon / HP" name="tel" class="form-control input-lg"
                         required>
                  <br>
                </div>

                <div class="col-md-6">
                  <div class="input-group">
                    <input id="luas_gudang" type="number" placeholder="Luas Gudang"
                           name="luas_gudang" class="form-control input-lg" required>
                    <span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
                  </div>
                  <br>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-12">
                  <h4><b>Lokasi Gudang</b></h4>
                  <hr>

                  <input id="alamat" type="text" placeholder="Alamat" name="alamat" class="form-control input-lg"
                         required>
                  <br>

                  <select name="provinsi" id="provinsi" class="form-control input-lg" required>
                    <option value="">Pilih Provinsi</option>
                  </select>
                  <br>

                  <select name="kabupaten" id="kabupaten" class="form-control input-lg" required>
                    <option value="">Pilih Kabupaten</option>
                  </select>
                  <br>

                  <!-- <h4><b>Titik Kordinat</b></h4>
                  <hr> -->
                </div>

                <!-- <div class="col-md-6">
                  <input id="ls" type="text" placeholder="LS" name="ls" class="form-control input-lg" required>
                  <br>
                </div>

                <div class="col-md-6">
                  <input id="lu" type="text" placeholder="LU" name="lu" class="form-control input-lg" required>
                  <br>
                </div> -->

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  var baseurl;
</script>

<?php
//  Yii::app()->clientScript->registerScript('close-alert', '
//    setTimeout(function () {
//        $("#pesan").addClass("hidden");
//    }, 5000);
//
//    $("#modal-insert").prependTo("#modal-view");
//
//    $.ajax({
//        type: "POST",
//        url: "/kospermindo/gudang/getprov",
//        data:{
//        },
//        success: function(data){
//            msg = $.parseJSON(data);
//            $.each(msg, function(i, v){
//                $("#provinsi").append("<option value=\""+ v.provinsi_id +"\">"+ v.provinsi_nama +"</option>");
//            });
//        }
//    });
//
//    $("#provinsi").on("change", function(){
//        $.ajax({
//            type: "POST",
//            url: "/kospermindo/gudang/getkota",
//            data:{
//                "prov" : $("#provinsi").val(),
//            },
//            success: function(data){
//                msg = $.parseJSON(data);
//                console.log(msg);
//                $("#kabupaten").empty();
//                $.each(msg, function(i, v){
//                    $("#kabupaten").append("<option value=\""+ v.kota_id +"\">"+ v.kokab_nama +"</option>");
//                });
//            }
//        });
//    });
//
//    $("#edit").on("click", function(){
//		$.ajax({
//			type: "POST",
//			url: "/kospermindo/gudang/ubah",
//			data:{
//				"nama_gudang"   : $("#nama-gudang").val(),
//				"pj_gudang"	  	: $("#pj_gudang").val(),
//				"tel"	  		: $("#tel").val(),
//				"luas_gudang"	: $("#luas_gudang").val(),
//				"alamat"	  	: $("#alamat").val(),
//				"kabupaten"	  	: $("#kabupaten").val(),
//				"provinsi"	  	: $("#provinsi").val(),
//				"id"      		: $(this).attr("data-id")
//			},
//			success: function(data){
//				msg = $.parseJSON(data);
//
//				if(msg.message === "success"){
//						$(".alert strong").html("Gudang Berhasil Terubah !");
//						$(".alert").removeClass("hidden");
//						$(".alert").addClass("alert-success");
//					setTimeout(function() {
//						$(".alert strong").html("");
//						$(".alert").addClass("hidden");
//						$(".alert").removeClass("alert-success");
//						window.location.reload(true);
//					}, 2500);
//				}else{
//					$(".alert strong").html("Gudang Gagal Terubah !");
//					$(".alert").removeClass("hidden");
//					$(".alert").addClass("alert-danger");
//					setTimeout(function() {
//						$(".alert strong").html("");
//						$(".alert").addClass("hidden");
//						$(".alert").removeClass("alert-danger");
//					}, 2500);
//				}
//			}
//		});
//	});
//
//    $("#btn-tmbh").on("click", function(){
//        $("#myModalLabel").html("Tambah Gudang");
//        $("#edit").addClass("hidden");
//        $("#submit").removeClass("hidden");
//    });
//
//    $(document).on("click","#sunting", function(e){
//        console.log(e.target);
//        $("#nama-gudang").val($(this).attr("data-nm-gudang"));
//        $("#pj_gudang").val($(this).attr("data-pj-gudang"));
//        $("#tel").val($(this).attr("data-telp"));
//        $("#luas_gudang").val($(this).attr("data-luas"));
//        $("#alamat").val($(this).attr("data-alamat"));
//        $("#provinsi").val($(this).attr("data-provinsi"));
//        $("#kabupaten").append("<option value=\""+ $(this).attr("data-kabupaten") +"\" selected>"+ $(this).attr("data-kabupaten") +"</option>");
//        $("#myModalLabel").html("Ubah Gudang");
//        $("#edit").attr("data-id", $(this).attr("data-id"));
//        $("#edit").removeClass("hidden");
//        $("#submit").addClass("hidden");
//        $("#modal-insert").modal("show");
//
//    });
//
//    $("#tel").keypress(function (e) {
//		if (e.which != 7 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//			return false;
//		}
//	});
//
//    ', CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/modal-loader.js',CClientScript::POS_END);
?>
