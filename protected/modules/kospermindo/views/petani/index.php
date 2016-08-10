<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"master\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible');
		element.find('ul li:nth-child(3)').addClass('active');
");
?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong><?php echo 'Daftar Petani'; ?></strong>
		</li>
	</ol>
	<h2>Daftar Petani</h2><br/>
</div>

<div class="row">
	<div class="col-md-12">

		<a href="<?php echo $this->baseUrl; ?>/kospermindo/petani/tambah" class="btn btn-success btn-lg">+ &nbsp;Tambah</a>

		<br>
		<br>

		<table class="table table-responsive table-hover table-bordered">
			<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Nama Petani</th>
				<th>Nama Gudang</th>
				<th>Nama Kelompok</th>
				<th>Jenis Komoditi</th>
				<th width="10%">Luas Lokasi</th>
				<th width="10%">Panjang Bentangan</th>
				<th width="200px">Aksi</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($petani)){ ?>
				<?php $i=!empty($_GET['page']) ? (($_GET['page']-1)*10)+1 : 1; foreach ($petani as $key => $value) { ?>
					<tr style="cursor: pointer">
							<td class="text-center"><?= $i++;?></td>
							<td onclick="window.location.href = '/kospermindo/profile?id=<?= $value['id_petani'] ?>'"><?= $value['nama_petani']; ?></td>
							<td onclick="window.location.href = '/kospermindo/profile?id=<?= $value['id_petani'] ?>'"><?= Petani::model()->getGudang($value->id_gudang) ?></td>
							<td onclick="window.location.href = '/kospermindo/profile?id=<?= $value['id_petani'] ?>'"><?= Petani::model()->getKelompok($value->id_kelompok) ?></td>
							<td onclick="window.location.href = '/kospermindo/profile?id=<?= $value['id_petani'] ?>'"><?php 
									foreach (Petani::model()->getKomoditi($value->jenis_komoditi) as $key => $val) { ?>
									<?= $val ?>
									<br>
								<?php } ?></td>
							<td onclick="window.location.href = '/kospermindo/profile?id=<?= $value['id_petani'] ?>'"><?= $value->luas_lahan ?> m<sup>2</sup></td>
							<td onclick="window.location.href = '/kospermindo/profile?id=<?= $value['id_petani'] ?>'"><?= $value->jumlah_bentangan ?> m</td>
							<td>
								<a class="btn btn-default btn-sm btn-icon icon-left"
									 href="<?= $this->baseUrl; ?>/kospermindo/petani/sunting?id=<?= $value->id_petani ?>"><i
										class="entypo-pencil"></i>Sunting</a>&nbsp;
								<a href="#"  data-id="<?= $value->id_petani ?>" id="hapus-komo" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
												class="entypo-trash"></i>
							</td>
					</tr>
				<?php } ?>
			<?php } else { ?>
				<td colspan="5">Tidak ada hasil ditemukan</td>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-12">
	<?php //Helper::dd($data->totalItemCount);
		$pages = $data->pagination;
		$this->widget('CLinkPager', array(
			'pages'                => $pages,
			'maxButtonCount'       => 30,
			'pageSize'             => 10,
			'itemCount'            => (int)$data->totalItemCount,
			'htmlOptions'          => array('class' => 'pagination pagination-custom'),
			'hiddenPageCssClass'   => '',
			//'firstPageCssClass' => 'active',
			//'lastPageCssClass' => 'active',
			'selectedPageCssClass' => 'active',
			//'currentPage'       => '1',
			'header'               => '',
			'nextPageLabel'        => 'Berikutnya',
			'prevPageLabel'        => 'Sebelumnya',
			'lastPageLabel'        => 'Akhir',
			'firstPageLabel'       => 'Awal',
		));
	?>
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
	 $("#add").click(function (e) {
			toastr.error("Tambahkan Data Kelompok Terlebih Dahulu !!!", pesan);
			e.preventDefault();
	 });

	$("#konfirm-yes").on("click", function(){
		$.ajax({
			type: "POST",
			url: "/kospermindo/petani/delete",
			data:{
				"id"      : $(this).attr("data-id")
			},
			success: function(data){
				msg = $.parseJSON(data);

				if(msg.message === "success"){
					window.location.reload(true);
				}else{
					$(".alert strong").html("Petani Terhapus !");
					$(".alert").removeClass("hidden");
					$(".alert").addClass("alert-danger");
					setTimeout(function() {
						$(".alert strong").html("");
						$(".alert").addClass("hidden");
						$(".alert").removeClass("alert-danger");
					}, 2500);
				}
			}
		});		
	});

	$(document).on("click","#hapus-komo", function(){
		$("#konfirm-yes").attr("data-id", $(this).attr("data-id"));
		$("#konf-del-komoditi").modal("show");
	});
	', CClientScript::POS_END);
?>