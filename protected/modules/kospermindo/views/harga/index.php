<?php


	Yii::app()->clientScript->registerScript('search', "

		var element = $('#main-menu li[data-nav=\"harga\"]');

		element.addClass('active');

");

?>



<?php //$this->widget('zii.widgets.CListView', array(

	//	'dataProvider'=>$dataProvider,

	//	'itemView'=>'_view',

	//)); ?>





<div class="headline">

	<ol class="breadcrumb bc-3">

		<li>

			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>

		</li>

		<li>

			<a href="<?= Kospermindo::getBaseUrl(); ?>/komoditi">Komoditi</a>

		</li>

		<li class="active">

			<strong><?php echo 'Harga'; ?></strong>

		</li>

	</ol>

	<h2>Info Harga Komoditi</h2><br/>

</div>

<?php $this->renderPartial('/alert/alert'); ?>



<div class="row">

	<div class="col-md-12">

		<div class="row">

			<div class="col-md-12">

				<button id="btn-tmbh" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert"><i class="entypo-plus"></i>&nbsp;Tambah</button>

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

						<th class="text-center" width="5%">No</th>

						<th class="text-center">Jenis Komoditi</th>

						<th class="text-center">Harga</th>

						<th class="text-center" width="200px">Aksi</th>

					</tr>

					<thead>



					<tbody>

					<?php if (!empty($dataProvider->getdata())) { $i=1; ?>

						<?php foreach ($dataProvider->getData() as $key => $value) { ?>

							<tr style="cursor : pointer">

								<?php if ($value['status'] == 0) { ?>

									<td class="text-center" onclick="window.location.href = '/kospermindo/harga/grafik?id=<?= $value['id'] ?>'">

										<?= $i;?>
										
									</td>

									<td onclick="window.location.href = '/kospermindo/harga/grafik?id=<?= $value['id'] ?>'">
										
										<?= JenisKomoditi::model()->getJenisKomoditiharga($value['id_jenis_komoditi']); ?>
									</td>

									<td class="text-center" onclick="window.location.href = '/kospermindo/harga/grafik?id=<?= $value['id'] ?>'">

										<?= Helper::convertToRupiah((int) $value['harga']);?>

									<td>

										<a id="sunting" class="btn btn-default btn-sm btn-icon icon-left" href="#" data-id="<?= $value['id'];?>"><i class="entypo-pencil"></i>Sunting</a>

										<a href="#" data-record-id="<?= $value['id'] ?>" data-record-title="Konfirmasi"

											 data-href="<?php echo $this->baseUrl; ?>/kospermindo/harga/hapus"

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

	<div class="col-md-12 center">

		<?php

			$pages = $dataProvider->pagination;

			$this->widget('CLinkPager', array(

				'pages'             => $pages,

				'maxButtonCount'=> 30,

				'pageSize'          => 10,

				'itemCount'         => (int) $dataProvider->totalItemCount,

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

							<h4 class="modal-title" id="myModalLabel">Tambah Harga Komoditi</h4>

						</div>

						<div class="modal-body">

							<div class="row">


								<form action="/kospermindo/harga" method="POST" class="form-horizontal" id="form-harga">


									<div class="col-md-12">

										<div id="alert-modal" class="alert-view hidden">
											<div class="alert-custom">

											</div>

										</div>

										<select class="form-control input-lg" id="id_komoditi" required>
											<option value="0">Pilih Jenis Komoditi</option>

											<?php foreach ($jenis_komoditi as $key => $jenkom) { ?>

												<option value="<?= $jenkom['id_komoditi'] ?>"><?= $jenkom['jenis'] ?>
																			
												</option>

											<?php } ?>
										</select>

										<br>

										<div class="col-md-12">

											<div class="form-group">

												<div class="input-group">

													<span class="input-group-addon" id="basic-addon1">Rp.</span>

													<input id="harga" type="text" placeholder="Harga" class="form-control input-lg" data-mask="fdecimal" data-dec="," data-rad="." max-length="20" required>

												</div>

											</div>

										</div>

										<br>

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

<script>

		var baseurl;

		var pesan = '<?php $pesan ?>';

		var kelompok = '<?php $dataProvider->getData(); ?>';

</script>

<?php

	Yii::app()->clientScript->registerScript('close-alert', '

		setTimeout(function () {
				$("#pesan").addClass("hidden");
		}, 5000); 

		setTimeout(function() {
				$("#alert-flash").addClass("hidden");
		}, 5000);

		$("#modal-insert").prependTo("#modal-view");

		$("#btn-tmbh").on("click", function(){
			$("#myModalLabel").html("Input Harga Komoditi");
			$("#id_komoditi").val("0");
			$("#id_komoditi").removeAttr("disabled");
			$("#harga").val("");
			$("#edit").addClass("hidden");
			$("#submit").removeClass("hidden");
		});

		$("#form-harga").submit(function(e){
			e.preventDefault();
			 
			$("#submit").html("<i class=\"entypo-plus\"></i>Proses");
			$("#submit").addClass("disabled");
			
			$.ajax({
				type: "POST",
				url: "/kospermindo/harga/tambah",
				data:{
						"id_komoditi"   : $("#id_komoditi").val(),
						"harga"     : $("#harga").val(),
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
										$("#submit").html("<i class=\"entypo-floppy\"></i>Tambah");
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
										$("#submit").html("<i class=\"entypo-floppy\"></i>Tambah");
										$("#submit").removeClass("disabled");
										$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
										$("#alert-modal .alert-custom").html("");
										$("#alert-modal").addClass("hidden");
								}, 1500);
					}
				}
			});

		});
		$(document).on("click","#sunting", function(){
			$.ajax({
				type: "POST",
				url: "/kospermindo/harga/getdetailharga",
				data:{
						"id"   : $(this).attr("data-id"),
				},
				success: function(data){
						msg = $.parseJSON(data);
						console.log(msg.harga);
						$("#edit").attr("data-id",msg.id);
						$("#harga").val(parseInt(msg.harga));
						$("#info-dasar").removeClass("hidden");
						$("#edit").removeClass("hidden");
						$("#id_komoditi").append("<option selected>"+msg.jenis_komoditi+"</option>");
						$("#id_komoditi").attr("disabled","");
						$("#myModalLabel").html("Edit Harga Komoditi");
						$("#submit").addClass("hidden");
						$("#modal-insert").modal("show");

				}
			});
		});

		$("#edit").on("click", function(){
			$("#edit").html("<i class=\"entypo-plus\"></i>Proses");
			$("#edit").addClass("disabled");
			$.ajax({
			type: "POST",
			url: "/kospermindo/harga/ubah",
			data:{
					"id_komoditi"   : $("#id_komoditi").val(),
					"harga"     : $("#harga").val(),
					"id"                : $(this).attr("data-id")
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

		$("#harga").keypress(function (e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						return false;
				}
		});

		$(document).ajaxError(function( event, request, settings ) {
			$("#alert-modal").removeClass("hidden");
			$("#alert-modal .alert-custom").addClass("alert-custom-danger");
			$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Proses gagal !");
			setTimeout(function() {
					$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
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





