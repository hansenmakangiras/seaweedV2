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
			<b>Data Gudang</b>
		</li>
	</ol>
	<h2>Manajemen Data Gudang</h2><br/>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert" id="btn-tmbh"><i class="entypo-plus"></i>&nbsp;Tambah</button>
				<br>
				<br>
				<br>
				<?php if (Yii::app()->user->hasFlash('success')) { ?>
					<div id="alert-flash" class="alert-view">
						<div class="alert-custom alert-custom-success">
							<i class="entypo-check"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?>
						</div>
					</div>
				<?php }else if(Yii::app()->user->hasFlash('failed')){ ?>
					<div id="alert-flash" class="alert-view">
						<div class="alert-custom alert-custom-danger">
							<i class="entypo-cancel"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('failed')); ?>          
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
					<thead>
						<tr>
							<th class="text-center" rowspan="2" width="5%">No</th>
							<th class="text-center" rowspan="2">Kode Gudang</th>
							<th class="text-center" rowspan="2">Nama Gudang</th>
							<th class="text-center" rowspan="2">Luas Gudang</th>
							<th class="text-center" colspan="2">Lokasi Gudang</th>
							<th class="text-center" width="200px" rowspan="2">Aksi</th>
						</tr>
						<tr>
							<th class="text-center">Provinsi</th>
							<th class="text-center">Kabupaten</th>
						</tr>
					<thead>

					<tbody>
					<?php if (!empty($data->getdata())) { $i=1; ?>
						<?php $i = !empty($_GET['page']) ? (($_GET['page'] - 1) * 10) + 1 : 1;
						foreach ($data->getData() as $key => $value) { ?>
							<tr style="cursor: pointer">
								<?php if ($value['status'] == 0) { ?>
									<td onclick="showDetail(<?= $value['id_gudang'];?>)" class="text-center" data-nm-gudang="<?= $value['nama'];?>"><?= $i;?></td>
									<td onclick="showDetail(<?= $value['id_gudang'];?>)" class="text-center"><?= $value['kode_gudang'];?></td>
									<td onclick="showDetail(<?= $value['id_gudang'];?>)" class="text-center"><?= ucfirst($value['nama']); ?></td>
									<td onclick="showDetail(<?= $value['id_gudang'];?>)" class="text-center"><?= $value['luas']." m<sup>2</sup>"; ?></td>
									<td onclick="showDetail(<?= $value['id_gudang'];?>)"><?= Gudang::model()->getProvinsi($value['provinsi']);?></td>
									<td onclick="showDetail(<?= $value['id_gudang'];?>)"><?= Gudang::model()->getKabupaten($value['kabupaten']); ?></td>
									<td>
										<a class="btn btn-default btn-sm btn-icon icon-left" href="#" class='modal-edit' id="sunting" data-id="<?= $value['id_gudang'];?>"><i class="entypo-pencil"></i>Sunting</a>
										<a href="#" data-record-id="<?= $value['id_gudang'] ?>" data-record-title="Konfirmasi"
											 data-href="<?php echo $this->baseUrl; ?>/kospermindo/gudang/hapus"
											 data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
											 data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
												class="entypo-trash"></i>
										</a>
									</td>
								<?php $i++; } ?>
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
	<div class="col-md-12">
		<?php
			$pages = $data->pagination;
			$this->widget('CLinkPager', array(
				'pages'             => $pages,
				'maxButtonCount'=> 30,
				'pageSize'          => 10,
				'itemCount'         => (int) $data->totalItemCount,
				'htmlOptions'       => array('class' => 'pagination pagination-custom'),
				'hiddenPageCssClass' => '',
				'selectedPageCssClass' => 'active',
				'header' => '',
				'nextPageLabel'     => 'Berikutnya',
				'prevPageLabel'     => 'Sebelumnya',
				'lastPageLabel'     => 'Akhir',
				'firstPageLabel'     => 'Awal',
			));
		?>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Gudang</h4>
			</div>

			<div id="tes"></div>
			<form action="/kospermindo/gudang" method="POST" class="form-horizontal" id="form-gudang">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div id="alert-modal" class="alert-view hidden">
									<div class="alert-custom">
									</div>
								</div>
								<div class="col-md-12">
									<select class="form-control input-lg" id="jenis_gudang" required>
										<option value="0">Pilih Jenis Gudang</option>
										<?php foreach ($jenis_gudang as $key => $valJenisGudang) { ?>
											<option value="<?= $valJenisGudang->kode_jenis_gudang ?>"><?= $valJenisGudang->jenis_gudang ?></option>
										<?php } ?>
									</select>
									<br>
								</div>

								<div id="info-dasar">									
									<div class="col-md-12">
										<h4><b>Informasi Dasar</b></h4>
										<hr>
									</div>

									<div class="col-md-6">
										<input id="gudang" type="text" placeholder="Nama Gudang" name="nama_gudang" class="form-control input-lg" maxlength="100" required>
										<br>
									</div>

									<div class="col-md-6">
										<input type="text" id="kor_gudang" placeholder="Penganggung Jawab Gudang" name="pj_gudang" class="form-control input-lg" maxlength="100" required>
										<br>
									</div>

									<div class="col-md-6">
										<input type="text" id="telepon" placeholder="Telpon / HP" name="tel" class="form-control input-lg" maxlength="15" required>
										<br>
									</div>

									<div class="col-md-6">
										<div id="luas_gudang" class="input-group">
											<input id="luas_gdg" type="text" type="luas_gudang" placeholder="Luas Gudang" name="luas_gudang" class="form-control input-lg" maxlength="10" required>
											<span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
										</div>
										<br>
									</div>

									<div class="clearfix"></div>

									<div class="col-md-12">
										<h4><b>Lokasi Gudang</b></h4>
										<hr>

										<input id="almt" type="text" placeholder="Alamat" name="alamat" class="form-control input-lg" required>
										<br>
										
										<select id="provinsi" class="form-control input-lg" required>
											<option value="">Pilih Provinsi</option>
										</select>
										<br>

										<select id="kabupaten" class="form-control input-lg hidden" required>
											<option value="">Pilih Kabupaten/Kota</option>
										</select>
										<br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>
					<a id="edit" class="btn btn-info btn-lg" data-id=""><i class="entypo-pencil"></i>Sunting</a>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabelDetail"></h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<label>Jenis Gudang</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="jengudang"></div>
					</div>

					<div class="clearfix"></div>
					
					<br>
					
					<div class="col-md-4">
						<label>Nama Gudang</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="ngudang"></div>
					</div>

					<div class="clearfix"></div>
					
					<br>

					<div class="col-md-4">
						<label>Penanggung Jawab Gudang</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="penanggung-jawab-gudang"></div>
					</div>

					<div class="clearfix"></div>

					<br>

					<div class="col-md-4">
						<label>Telpon / HP</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="telpon"></div>
					</div>

					<div class="clearfix"></div>
					
					<br>

					<div class="col-md-4">
						<label>Luas Gudang</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="luas-gudang"> m<sup>2</sup></div>
					</div>

					<div class="clearfix"></div>
					
					<br>

					<div class="col-md-4">
						<label>Alamat Gudang</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="alamt"></div>
					</div>

					<div class="clearfix"></div>
					
					<br>

					<div class="col-md-4">
						<label>Provinsi</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="provin"></div>
					</div>

					<div class="clearfix"></div>
					
					<br>

					<div class="col-md-4">
						<label>Kabupaten / Kota</label>
					</div>
					<div class="col-md-8">
						<div class="detail-val" id="kab"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var baseurl;
	var pesan = '<?php $pesan ?>';
</script>
<?php
	Yii::app()->clientScript->registerScript('close-alert', '
	setTimeout(function () {
		$("#pesan").addClass("hidden");
	}, 5000);

	setTimeout(function() {
		$("#alert-flash").addClass("hidden");
	}, 5000);

	$("#modal-insert, #modal-detail").prependTo("#modal-view");

	$("#info-dasar").addClass("hidden");

	function showDetail(id){
		$.ajax({
			type: "POST",
			url: "/kospermindo/gudang/getDetail",
			data:{
				"id_gudang"   : id,
			},
			success: function(data){
				msg = $.parseJSON(data);
				$("#myModalLabelDetail").html(msg.nama);
				$("#jengudang").text(msg.kode_jenis_gudang);
				$("#ngudang").text(msg.nama);
				$("#penanggung-jawab-gudang").text(msg.koordinator);
				$("#kab").text(msg.kabupaten);
				$("#provin").text(msg.provinsi);
				$("#alamt").text(msg.alamat);
				$("#luas-gudang").html(msg.luas+" m<sup>2</sup>");
				$("#telpon").text(msg.telp);

			}
		});
		$("#modal-detail").modal("show");
	}

	$("#jenis_gudang").on("change", function(){
		$("#info-dasar").removeClass("hidden");

		if($(this).val() == 111){
			$("div#luas_gudang").removeClass("hidden");
			$("#luas_gdg").attr("required","");
		}else{
			$("div#luas_gudang").addClass("hidden");
			$("#luas_gdg").removeAttr("required");

		}
	});

	$("#form-gudang").submit(function(e){
		e.preventDefault();
		 
		$("#submit").html("<i class=\"entypo-plus\"></i>Proses");
		$("#submit").addClass("disabled");
		
		$.ajax({
			type: "POST",
			url: "/kospermindo/gudang/tambah",
			data:{
				"jenis_gudang"  : $("#jenis_gudang").val(),
				"nama_gudang"   : $("#gudang").val(),
				"pj_gudang"		: $("#kor_gudang").val(),
				"telp"			: $("#telepon").val(),
				"luas_gudang"	: $("#luas_gdg").val(),
				"alamat"		: $("#almt").val(),
				"provinsi"		: $("#provinsi").val(),
				"kabupaten"		: $("#kabupaten").val()
			},
			success: function(data){
				msg = $.parseJSON(data);
				if(msg.message === "success"){
					window.location.reload(true);    
				}else if(msg.message === "failed"){
					$("#alert-modal").removeClass("hidden");
					$("#alert-modal .alert-custom").addClass("alert-custom-danger");
					$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru");
					setTimeout(function() {
							$("#submit").html("<i class=\"entypo-plus\"></i>Tambah");
							$("#submit").removeClass("disabled");
							$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("");
							$("#alert-modal").addClass("hidden");
						}, 1500);
				}else if(msg.message === "double"){
					$("#alert-modal").removeClass("hidden");
					$("#alert-modal .alert-custom").addClass("alert-custom-danger");
					$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, data gudang sudah ada !");
					setTimeout(function() {
							$("#submit").html("<i class=\"entypo-plus\"></i>Tambah");
							$("#submit").removeClass("disabled");
							$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("");
							$("#alert-modal").addClass("hidden");
						}, 1500);
				}
			}
		});

	});

	$.ajax({
		type: "POST",
		url: "/kospermindo/gudang/getprov",
		data:{
		},
		success: function(data){
			msg = $.parseJSON(data);
			$.each(msg, function(i, v){
				$("#provinsi").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
			});
		}
	});

	$("#provinsi").on("change", function(){
		$.ajax({
			type: "POST",
			url: "/kospermindo/gudang/getkota",
			data:{
				"prov" : $("#provinsi").val(),
			},
			success: function(data){
				msg = $.parseJSON(data);
				$("#kabupaten").empty();
				$("#kabupaten").removeClass("hidden");
				$("#kabupaten").append("<option selected>Pilih Kabupaten</option>");	
				$.each(msg, function(i, v){
					$("#kabupaten").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
				});
			}
		});
	});

	$("#edit").on("click", function(){
		$("#edit").html("<i class=\"entypo-plus\"></i>Proses");
		$("#edit").addClass("disabled");
		$.ajax({
			type: "POST",
			url: "/kospermindo/gudang/ubah",
			data:{
				"jenis_gudang"  : $("#jenis_gudang").val(),
				"nama_gudang"   : $("#gudang").val(),
				"pj_gudang"		: $("#kor_gudang").val(),
				"telp"			: $("#telepon").val(),
				"luas_gudang"	: $("#luas_gdg").val(),
				"alamat"		: $("#almt").val(),
				"provinsi"		: $("#provinsi").val(),
				"kabupaten"		: $("#kabupaten").val(),
				"id"      		: $(this).attr("data-id")
			},
			success: function(data){
				msg = $.parseJSON(data);

				if(msg.message === "success"){
					window.location.reload(true);    
				}else if(msg.message === "failed"){
					$("#alert-modal").removeClass("hidden");
					$("#alert-modal .alert-custom").addClass("alert-custom-danger");
					$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data gudang");
					setTimeout(function() {
							$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
							$("#edit").removeClass("disabled");
							$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("");
							$("#alert-modal").addClass("hidden");
						}, 1500);
				}else if(msg.message === "any_gudang"){
					$("#alert-modal").removeClass("hidden");
					$("#alert-modal .alert-custom").addClass("alert-custom-danger");
					$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data gudang, data gudang sudah ada !");
					setTimeout(function() {
							$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
							$("#edit").removeClass("disabled");
							$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("");
							$("#alert-modal").addClass("hidden");
						}, 1500);
				}
			}
		});
	});

	$("#btn-tmbh").on("click", function(){
		$("#myModalLabel").html("Tambah Gudang");
		$("#info-dasar").addClass("hidden");
		$("#jenis_gudang").val("0");
		$("#gudang").val("");
		$("#kor_gudang").val("");
		$("#telepon").val("");
		$("#luas_gdg").val("");
		$("#almt").val("");
		$("#provinsi").val("0");
		$("#kabupaten").empty();
		$("#kabupaten").addClass("hidden");
		$("#edit").addClass("hidden");
		$("#submit").removeClass("hidden");
	});
	
	$(document).on("click","#sunting", function(){
		$.ajax({
			type: "POST",
			url: "/kospermindo/gudang/getgudang",
			data:{
				"id_gudang"   : $(this).attr("data-id"),
			},
			success: function(data){
				msg = $.parseJSON(data);
				$("#edit").attr("data-id",msg.id_gudang);
				$("#jenis_gudang").val(msg.kode_jenis_gudang);
				$("#gudang").val(msg.nama);
				$("#kor_gudang").val(msg.koordinator);
				$("#telepon").val(msg.telp);
				if(msg.kode_jenis_gudang == 111){
					$("#luas_gdg").val(msg.luas);
					$("div#luas_gudang").removeClass("hidden");
					$("#luas_gdg").attr("required","");
				}else{
					$("div#luas_gudang").addClass("hidden");
					$("#luas_gdg").removeAttr("required");
				}
				$("#almt").val(msg.alamat);
				$("#provinsi").val(msg.provinsi);
				$.ajax({
					type: "POST",
					url: "/kospermindo/gudang/getkota",
					data:{
						"prov" : msg.provinsi,
					},
					success: function(data){
						msgi = $.parseJSON(data);
						$("#kabupaten").empty();
						$("#kabupaten").removeClass("hidden");
						$("#kabupaten").append("<option value=\"\">Pilih Kabupaten</option>");	
						$.each(msgi, function(i, v){
							$("#kabupaten").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
						});
						$("#kabupaten").val(msg.kabupaten);
					}
				});
				$("#info-dasar").removeClass("hidden");
				$("#kabupaten").removeClass("hidden");
				$("#edit").removeClass("hidden");
				$("#submit").addClass("hidden");
				$("#modal-insert").modal("show");

			}
		});
	});

	$("#telepon").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});

	$("#luas_gdg").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});

	$(document).ajaxError(function( event, request, settings ) {
		$("#alert-modal").removeClass("hidden");
		$("#alert-modal .alert-custom").addClass("alert-custom-danger");
		$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Proses gagal !");
		setTimeout(function() {
				$("#submit").html("<i class=\"entypo-plus\"></i>Tambah");
				$("#submit").removeClass("disabled");
				$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
				$("#edit").removeClass("disabled");
				$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
				$("#alert-modal .alert-custom").html("");
				$("#alert-modal").addClass("hidden");
			}, 1500);
	});
	', CClientScript::POS_END);
?>
