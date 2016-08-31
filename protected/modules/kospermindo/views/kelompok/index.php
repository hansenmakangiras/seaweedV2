<?php

	Yii::app()->clientScript->registerScript('search', "

		var element = $('#main-menu li[data-nav=\"master\"]');

		element.addClass('active opened');

		element.find('ul').addClass('visible');

		element.find('ul li:nth-child(2)').addClass('active');

");

?>



<div class="headline">

	<ol class="breadcrumb bc-3">

		<li>

			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>

		</li>

		<li class="active">

			<strong><?php echo 'Data Kelompok'; ?></strong>

		</li>

	</ol>

	<h2>Data Kelompok</h2><br/>

</div>



<div class="row">

	<div class="col-md-12">

		<div class="row">

			<div class="col-md-12">

				<button id="btn-tmbh" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert"><i class="entypo-plus"></i>&nbsp;Tambah</button>

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

				<table id="tblkelompok" class="table table-responsive table-hover table-bordered" cellspacing="0" width="100%">

					<thead>

					<tr>

						<th class="text-center" width="5%">No</th>

						<th>ID Kelompok</th>

						<th>Nama Kelompok</th>

						<th>Nama Gudang</th>

						<th>Ketua Kelompok</th>

						<th width="200px">Aksi</th>

					</tr>

					</thead>

					<tbody>

					<?php if (!empty($data->getData())) { $i=1;?>

						<?php $i = !empty($_GET['page']) ? (($_GET['page'] - 1) * 10) + 1 : 1;

						foreach ($data->getData() as $value) { ?>

							<tr>

								<?php if ($value->status == 0) { ?>

									<td class="text-center"><?= $i; ?></td>

									<td><?= ucfirst($value->kode_kelompok); ?></td>

									<td><?= ucfirst($value->nama_kelompok); ?></td>

									<td><?= !empty($value->kode_gudang) ? ucfirst(Kelompok::model()->getNamaGudang($value->kode_gudang)) : '-';?></td>

									<td><?= !empty($value->ketua_kelompok) ? ucfirst(Kelompok::model()->getNamaPetani($value->ketua_kelompok)) : "Belum ada ketua kelompok";?></td>

									<td>

										<a id="sunting" class="btn btn-default btn-sm btn-icon icon-left" href="#" class='modal-edit' data-id="<?= $value['id_kelompok'];?>"	>
										
											<i class="entypo-pencil"></i>Sunting</a>

										<a href="#" data-record-id="<?= $value['id_kelompok']; ?>" data-record-title="Konfirmasi"

											 data-href="<?php echo $this->baseUrl; ?>/kospermindo/kelompok/hapus"

											 data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"

											 data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i

												class="entypo-trash"></i>

										</a>
										
									</td>

								<?php $i++;} ?>

							</tr>

						<?php } ?>

					<?php } else { ?>

                        <td colspan="6" class="text-center">Tidak ada hasil ditemukan</td>

					<?php } ?>

					</tbody>

				</table>

			</div>

		</div>

	</div>

</div>

<div class="row">

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

				<h4 class="modal-title" id="myModalLabel">Tambah Kelompok</h4>

			</div>

			<div class="modal-body">

				<div class="row">



					<form action="/kospermindo/kelompok" method="POST" class="form-horizontal" id="form-kelompok">



						<div class="col-md-12">

							<div id="alert-modal" class="alert-view hidden">
									<div class="alert-custom">

									</div>

							</div>

							<input id="nama_kelompok" type="text" placeholder="Nama Kelompok" class="form-control input-lg" required>

							<br>


							<select class="form-control input-lg" id="jenis_gudang" required>

								<option value="0">Pilih Jenis Gudang</option>

									<?php foreach ($jenisGudang as $key => $valJenisGudang) { ?>

										<option value="<?= $valJenisGudang->kode_jenis_gudang ?>"><?= $valJenisGudang->jenis_gudang ?></option>

									<?php } ?>

							</select>

														
							<br>

							<select  id="nama_gudang" class="form-control input-lg" required disabled>

								

							</select>

							<br/>

							<select  id="ketua_kelompok" class="form-control input-lg" required disabled>

								<option value="-">Pilih Ketua Kelompok</option>

							</select>

						</div>

						
						<div class="col-md-12">

							<hr>

							<br/>

							<div class="alert hidden"><strong></strong></div>

							<br/>

							<div class="pull-right">

								<button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>

								<a id="edit" class="btn btn-info btn-lg" data-id=""><i class="entypo-pencil"></i>Sunting</a>

							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>



<script>

	var baseurl;

	var pesan = '<?php $pesan ?>';

	var kelompok = '<?php $data->getData(); ?>';

</script>

<?php

	Yii::app()->clientScript->registerScript('showNotif', '

		setTimeout(function () {

				$("#pesan").addClass("hidden");

		 }, 5000); 

		setTimeout(function() {
			$("#alert-flash").addClass("hidden");
		}, 5000);

		$("#add").click(function (e) {

			toastr.error("Anda Harus Menambahkan Data Gudang Terlebih Dahulu!!!", pesan);

			e.preventDefault();

		});

	 
		$("#modal-insert").prependTo("#modal-view");


		$.ajax({
			type: "POST",
			url: "/kospermindo/kelompok/getNamaGudang",
			data:{
			},
			success: function(data){
				msg = $.parseJSON(data);
				$.each(msg, function(i, v){
					$("#nama_gudang").append("<option value=\""+ v +"\">"+ v +"</option>");
				});
			}
		});

		$("#jenis_gudang").on("change", function(){
			$.ajax({
				type: "POST",
				url: "/kospermindo/kelompok/getGudang",
				data:{
				"jenis_gudang" : $("#jenis_gudang").val(),
				},
				success: function(data){
					msg = $.parseJSON(data);
					console.log(msg);
					$("#nama_gudang").empty();
					$("#nama_gudang").removeAttr("disabled");
					if(msg.length === 0){
						$("#nama_gudang").append("<option value=\'0\'>Belum Ada Gudang. Silahkan isi gudang</option>");
					}else{
						$("#nama_gudang").append("<option value=>Pilih Nama Gudang</option>");
						$.each(msg, function(i, v){
						$("#nama_gudang").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
						});
					}
					
				}
			});
		});

		$("#nama_gudang").on("change", function(){
			$.ajax({
				type: "POST",
				url: "/kospermindo/kelompok/getPetani",
				data:{
					"id_kelompok" : "",
				},
				success: function(data){
					msg = $.parseJSON(data);
					$("#ketua_kelompok").empty();
					$("#ketua_kelompok").removeAttr("disabled");
					if(msg.length === 0){
						$("#ketua_kelompok").append("<option value=\'0\'>Belum Ada Petani di Gudang ini</option>");
					}else{
						$("#ketua_kelompok").append("<option value=\'0\'>Belum Ada Petani di Gudang ini</option>");
						$.each(msg, function(i, v){
							$("#ketua_kelompok").append("<option value=\'"+ v.id +"\'>"+ v.nama_petani +"</option>");
						});
					}
				}
			});
		});

		$("#btn-tmbh").on("click", function(){
			$("#myModalLabel").html("Tambah Kelompok");
			$("#jenis_gudang").val("0");
			$("#nama_kelompok").val("");
			$("#ketua_kelompok").empty();
			$("#nama_gudang").empty();
			$("#nama_gudang").attr("disabled","");
			$("#ketua_kelompok").attr("disabled","");
			$("#nama_gudang").append("<option >Pilih Nama Gudang</option>");
			$("#ketua_kelompok").append("<option >Pilih Ketua Kelompok</option>");
			$("#edit").addClass("hidden");
			$("#submit").removeClass("hidden");
		});

		$(document).on("click","#sunting", function(){
			var id_klpk = $(this).attr("data-id");
			$.ajax({
				type :  "POST",
				url  :  "/kospermindo/kelompok/getsuntingkelompok",
				data :  {
							"id_kelompok" : id_klpk,
				},
				success : function(data){
					msg = $.parseJSON(data);
					$("#edit").attr("data-id",msg.id_kelompok);
					$("#nama_kelompok").val(msg.nama_kelompok);
					$("#jenis_gudang").val(msg.kode_jenis_gudang);
					$.ajax({
						type: "POST",
						url: "/kospermindo/kelompok/getGudang",
						data:{
							"jenis_gudang" : msg.kode_jenis_gudang,
						},
						success: function(data){
							msgjns = $.parseJSON(data);
							$("#nama_gudang").empty();
							$("#nama_gudang").removeAttr("disabled");
							if(msgjns.length === 0){
								$("#nama_gudang").append("<option value=\'0\'>Belum Ada Gudang. Silahkan isi gudang</option>");
							}else{
								$("#nama_gudang").append("<option value=>Pilih Nama Gudang</option>");
								$.each(msgjns, function(i, v){
									$("#nama_gudang").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
								});
							}
							$("#nama_gudang").val(msg.kode_gudang);
						}
					});

					$.ajax({
						type: "POST",
						url: "/kospermindo/kelompok/getPetani",
						data:{
							"id_kelompok" : id_klpk,
						},
						success: function(data){
							msgketkel = $.parseJSON(data);
							$("#ketua_kelompok").empty();
							$("#ketua_kelompok").removeAttr("disabled");
							if(msgketkel.length === 0){
								$("#ketua_kelompok").append("<option value=\'0\'>Belum Ada Petani di Gudang ini</option>");
							}else{
								$("#ketua_kelompok").append("<option value=\'0\'>Pilih Petani</option>");
								$.each(msgketkel, function(i, vk){
									$("#ketua_kelompok").append("<option value=\'"+ vk.id +"\'>"+ vk.nama_petani +"</option>");
								});
							}
							$("#ketua_kelompok").val(msg.ketua_kelompok);
						}
					});
				}
			});
			$("#edit").removeClass("hidden");
			$("#submit").addClass("hidden");
			$("#modal-insert").modal("show");
		});

		$("#edit").on("click", function(){
			$("#edit").html("<i class=\"entypo-plus\"></i>Proses");
			$("#edit").addClass("disabled");
			$.ajax({
			type: "POST",
			url: "/kospermindo/kelompok/ubah",
			data:{
				"nama_kelompok"   	: $("#nama_kelompok").val(),
				"kode_jenis_gudang" : $("#jenis_gudang").val(),
				"kode_gudang"     	: $("#nama_gudang").val(),
				"ketua_kelompok"  	: $("#ketua_kelompok").val(),
				"id"            	: $(this).attr("data-id")
			},
			success: function(data){
					msg = $.parseJSON(data);

					if(msg.message === "success"){
						window.location.reload(true);
					}else if(msg.message === "failed"){
						$("#alert-modal").removeClass("hidden");
						$("#alert-modal .alert-custom").addClass("alert-custom-danger");
						$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data Kelompok");
						setTimeout(function() {
								$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
								$("#edit").removeClass("disabled");
								$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
								$("#alert-modal .alert-custom").html("");
								$("#alert-modal").addClass("hidden");
							}, 1500);
					}else if(msg.message === "double"){
						$("#alert-modal").removeClass("hidden");
						$("#alert-modal .alert-custom").addClass("alert-custom-danger");
						$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data Kelompok, data Kelompok sudah ada !");
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

		$("#form-kelompok").submit(function(e){
			e.preventDefault();
			 
			$("#submit").html("<i class=\"entypo-plus\"></i>Proses");
			$("#submit").addClass("disabled");
			
			$.ajax({
				type: "POST",
				url: "/kospermindo/kelompok/tambah",
				data:{
					"nama_kelompok"   : $("#nama_kelompok").val(),
					"jenis_gudang"     : $("#jenis_gudang").val(),
					"kode_gudang"     : $("#nama_gudang").val(),
					"ketua_kelompok"  : $("#ketua_kelompok").val(),
				},
				success: function(data){
					msg = $.parseJSON(data);
					if(msg.message === "success"){
						window.location.reload(true);    
					}else if(msg.message === "failed"){
						$("#alert-modal").removeClass("hidden");
						$("#alert-modal .alert-custom").addClass("alert-custom-danger");
						$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data Kelompok");
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
						$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data Kelompok, data Kelompok sudah ada !");
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

	',CClientScript::POS_END);

?>

