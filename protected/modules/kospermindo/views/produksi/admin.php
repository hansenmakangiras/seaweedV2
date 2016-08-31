<?php

	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"produksi\"]');
		element.addClass('active');
	");

?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong>Produksi Petani</strong>
		</li>
	</ol>
	<h2>Produksi Petani</h2><br/>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3">
					<select name="test" id="gudang" class="select2" data-allow-clear="true" data-placeholder="Pilih Gudang" style="font-size:15px">
						<option></option>
						<optgroup label="Cadangan">
							<?php foreach ($gudang as $key => $valcad) { 
								if($valcad->kode_jenis_gudang == '111'){ ?>
								<option value="<?= $valcad->id_gudang ?>" <?= ($id_gudang==$valcad->id_gudang) ? 'selected' : '' ?>><?= $valcad->nama ?></option>
							<?php }} ?>
						</optgroup>
						<optgroup label="Koperasi">
							<?php foreach ($gudang as $key => $valkop) { 
								if($valkop->kode_jenis_gudang == '112'){ ?>
								<option value="<?= $valkop->id_gudang ?>" <?= ($id_gudang==$valkop->id_gudang) ? 'selected' : '' ?>><?= $valkop->nama ?></option>
							<?php }} ?>
						</optgroup>
						<optgroup label="Gapoktan">
							<?php foreach ($gudang as $key => $valgap) { 
								if($valgap->kode_jenis_gudang == '113'){ ?>
								<option value="<?= $valgap->id_gudang ?>" <?= ($id_gudang==$valgap->id_gudang) ? 'selected' : '' ?>><?= $valgap->nama ?></option>
							<?php }} ?>
						</optgroup>
					</select>
				</div>
				<div class="col-md-3">
					<select name="" id="kelompok" class="form-control input-lg">
						<?php foreach ($kelompok as $key => $valkelompok) { ?>
							<option value="<?= $valkelompok->id_kelompok ?>" <?= ($id_klpk == $valkelompok->id_kelompok) ? 'selected' :'' ?> ><?= $valkelompok->nama_kelompok ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3">
					<select name="" id="petani" class="form-control input-lg">
						<?php foreach ($petani as $key => $valpetani) { ?>
							<option value="<?= $valpetani->id_petani ?>" <?= ($id_tani == $valpetani->id_petani) ? 'selected' :'' ?> ><?= $valpetani->nama_petani ?></option>
						<?php } ?>
					</select>
				</div>
				<?php if(!empty($petani)){ ?>
					<button id="btn-tmbh" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert"><i class="entypo-plus"></i>&nbsp;Tambah</button>
				<?php } ?>
				<?php if (Yii::app()->user->hasFlash('success')) { ?>
					<br>
					<div id="alert-flash" class="alert-view">
						<div class="alert-custom alert-custom-success">
							<i class="entypo-check"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?>
						</div>
					</div>
				<?php }else if(Yii::app()->user->hasFlash('failed')){ ?>
					<br>
					<div id="alert-flash" class="alert-view">
						<div class="alert-custom alert-custom-danger">
							<i class="entypo-cancel"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('failed')); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-md-12">
				<table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
					<thead>
						<tr>
							<th class="text-center" width="5%">No</th>
							<th class="text-center">Kode Produksi</th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">Jenis Rumput Laut</th>
							<th class="text-center">Hasil Panen (kg)</th>
							<th class="text-center">Kadar Air (%)</th>
							<th class="text-center" width="200px">Aksi</th>
						</tr>
					<thead>
					<tbody>
					<?php if (!empty($history)) { ?>

						<?php $i = !empty($_GET['page']) ? (($_GET['page'] - 1) * 10) + 1 : 1; foreach ($history as $key => $valhis) { ?>
							<tr>
								<td class="text-center"><?= $i++ ?></td>
								<td class="text-center"><?= $valhis->kode_produksi ?></td>
								<td class="text-center"><?= $valhis->created_date ?></td>
								<td class="text-center"><?= Seaweed::model()->getSeaweed($valhis->id_seaweed) ?></td>
								<td style="text-align: right"><?= number_format((float)$valhis->total_panen, 2, '.', '') ?></td>
								<td style="text-align: right"><?= number_format((float)$valhis->kadar_air, 2, '.', '') ?></td>
								<td class="text-center">
									<a class="btn btn-default btn-sm btn-icon icon-left" id="sunting" data-id="<?= $valhis->id ?>" href="#"><i class="entypo-pencil"></i>Sunting</a>&nbsp;
									<a href="#" data-record-id="<?= $valhis->id ?>" data-record-title="Konfirmasi"
										 data-href="<?php echo $this->baseUrl; ?>/kospermindo/produksi/delete"
										 data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
										 data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
											class="entypo-trash"></i>
									</a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
					<?php } else { ?>
						<td colspan="7" class="text-center">Tidak ada hasil ditemukan</td>
					<?php } ?>
				</table>
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

		</div>

	</div>

</div>

<!-- Modal -->

<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Tambah Produksi</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<form action="#" method="POST" class="form-horizontal" id="form-produksi">
									<div class="col-md-12">
										<div id="alert-modal" class="alert-view hidden">
											<div class="alert-custom">
											</div>
										</div>
										<br>
										<div class="col-md-12">
											<div class="form-group">
												<select name="" id="seaweed" class="form-control input-lg" required>
													<option value="">Pilih Rumput Laut</option>
													<?php foreach ($jenis_seaweed as $key => $valjns) { ?>
														<option value="<?= $valjns['id_komoditi'] ?>"><?= $valjns['jenis'] ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<div class="input-group">
													<input type="text" id="hasil" placeholder="Hasil Panen" class="form-control input-lg" required>
													<span class="input-group-addon" id="basic-addon1">Kg</span>
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<input type="text" id="kadar_air" placeholder="Kadar Air" class="form-control input-lg" required>
													<span class="input-group-addon" id="basic-addon1">%</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<hr>
										<div class="pull-right">
											<button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Simpan</button>
											<a id="edit" class="btn btn-info btn-lg" data-id=""><i class="entypo-pencil"></i>Sunting</a>							
										</div>
									</div>
								</form>
							</div>
						</div>
				</div>
		</div>
</div>

<?php

	Yii::app()->clientScript->registerScript('close-alert', '

		$("#modal-insert").prependTo("#modal-view");
		setTimeout(function() {
			$("#alert-flash").addClass("hidden");
		}, 5000);

		$(document).ready(function(){
			$("#hasil").keypress(function (e) {
				if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});
			$("#kadar_air").keypress(function (e) {
				if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});

			$("#btn-tmbh").on("click", function(){
				$("#myModalLabel").text("Tambah Produksi");
				$("#edit").addClass("hidden");
				$("#submit").removeClass("hidden");
				$("#modal-insert").modal("show");
				$("#hasil").val("");
				$("#kadar_air").val("");
				$("#myModalLabel").text("Tambah Produksi");

			});

			$("#form-produksi").submit(function(e){
				var kadar_air = parseInt($("#kadar_air").val());
				e.preventDefault();

				$("#submit").html("<i class=\"entypo-plus\"></i>Proses");
				$("#submit").addClass("disabled");
				
				if(kadar_air >50 ){
					$("#alert-modal").removeClass("hidden");
					$("#alert-modal .alert-custom").addClass("alert-custom-danger");
					$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Kadar Air Tidak Boleh Melebihi 50%");
					setTimeout(function() {
							$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
							$("#submit").removeClass("disabled");
							$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("");
							$("#alert-modal").addClass("hidden");
						}, 1500);
				}else{
					$.ajax({
						type: "POST",
						url: "/kospermindo/produksi/createproduksiadmin",
						data:{
							"id_petani"		: $("#petani").val(),
							"hasil"  		: $("#hasil").val(),
							"kadar_air"   	: $("#kadar_air").val(),
							"seaweed"		: $("#seaweed").val(),
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
										$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
										$("#submit").removeClass("disabled");
										$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
										$("#alert-modal .alert-custom").html("");
										$("#alert-modal").addClass("hidden");
									}, 1500);
							}
						}
					});
				}
			});

			$(document).on("click","#sunting", function(){
				$("#hasil").val("");
				$("#kadar_air").val("");
				$.ajax({
					type: "POST",
					url: "/kospermindo/produksi/getproduksi",
					data:{
						"id"   : $(this).attr("data-id"),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#edit").attr("data-id",msg.id);
						$("#hasil").val(msg.hasil);
						$("#kadar_air").val(msg.kadar_air);
						$("#seaweed").val(msg.seaweed);
						$("#edit").removeClass("hidden");
						$("#submit").addClass("hidden");
						$("#myModalLabel").text("Sunting Produksi");		
						$("#modal-insert").modal("show");

					}
				});
			});	
			
			$("#edit").on("click", function(){
				var kadar_air = parseInt($("#kadar_air").val());
				$("#edit").html("<i class=\"entypo-floppy\"></i>Proses");
				$("#edit").addClass("disabled");
				
				if(kadar_air >50 ){
					$("#alert-modal").removeClass("hidden");
					$("#alert-modal .alert-custom").addClass("alert-custom-danger");
					$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Kadar Air Tidak Boleh Melebihi 50%");
					setTimeout(function() {
							$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
							$("#submit").removeClass("disabled");
							$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("");
							$("#alert-modal").addClass("hidden");
						}, 1500);
				}else{
					$.ajax({
						type: "POST",
						url: "/kospermindo/produksi/editproduksi",
						data:{
							"id"			: $(this).attr("data-id"),
							"hasil"  		: $("#hasil").val(),
							"kadar_air"   	: $("#kadar_air").val(),
							"seaweed"		: $("#seaweed").val(),
						},
						success: function(data){
							msg = $.parseJSON(data);
							if(msg.message === "success"){
								window.location.reload(true);    
							}else if(msg.message === "failed"){
								$("#alert-modal").removeClass("hidden");
								$("#alert-modal .alert-custom").addClass("alert-custom-danger");
								$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Data Gagal disunting");
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
				}
			});


			$("#gudang").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getkelompok",
					data:{
						"id" : $("#gudang").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#kelompok").empty();
						$("#kelompok").end();
						$("#petani").empty();
						$("#petani").end();
						$.each(msg, function(i, v){
							$("#kelompok").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
						});
						$.ajax({
							type: "POST",
							url: "/kospermindo/petani/getpetani",
							data:{
								"id_gudang" : $("#gudang").val(),
								"id_kelompok" : $("#kelompok").val()
							},
							success: function(data){
								msg = $.parseJSON(data);
								$("#petani").empty();
								$("#petani").end();
								$.each(msg, function(i, v){
									$("#petani").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
								});
								$.ajax({
									type: "POST",
									url: "/kospermindo/produksi/getpetani",
									data:{
										"id_gudang" : $("#gudang").val(),
										"id_kelompok" : $("#kelompok").val(),
										"id_petani" : $("#petani").val(),
									},
									success: function(data){
										msg = $.parseJSON(data);
										window.location.reload(true);
									}
								});

							}
						});

					}
				});
			});

			$("#kelompok").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getpetani",
					data:{
						"id_gudang" : $("#gudang").val(),
						"id_kelompok" : $("#kelompok").val()
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#petani").empty();
						$("#petani").end();
						$.each(msg, function(i, v){
							$("#petani").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
						});
						$.ajax({
							type: "POST",
							url: "/kospermindo/produksi/getpetani",
							data:{
								"id_gudang" : $("#gudang").val(),
								"id_kelompok" : $("#kelompok").val(),
								"id_petani" : $("#petani").val(),
							},
							success: function(data){
								msg = $.parseJSON(data);
								window.location.reload(true);
							}
						});
					}
				});
			});
			
			$("#petani").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/produksi/getpetani",
					data:{
						"id_gudang" : $("#gudang").val(),
						"id_kelompok" : $("#kelompok").val(),
						"id_petani" : $("#petani").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						window.location.reload(true);
					}
				});
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
		});

	', CClientScript::POS_END);

?>





