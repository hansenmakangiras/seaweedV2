<?php
	Yii::app()->clientScript->registerScript('nav', "
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
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Data Petani</a>
		</li>
		<li class="active">
			<strong><?= $petani['nama_petani']; ?></strong>
		</li>
	</ol>
	<h2>Detail Petani</h2><br/>
</div>

<div class="profile-env">
	<header class="row">
		<div class="col-sm-2">
			<a href="#" class="profile-picture">
				<img src="<?= $petani['url_foto'] ?>" class="img-responsive" />
			</a>
		</div>
		<div class="col-sm-6">
			<ul class="profile-info-sections">
				<li>
					<div class="profile-name">
						<strong style="margin-bottom: 5px; text-transform: capitalize; color: #333;"><?= $petani['nama_petani']; ?></strong>
						<span><a href="#">Petani Rumput Laut</a></span>
					</div>
					<br>
					<div>
						<a class="btn btn-default btn-sm btn-icon icon-left" href="<?= $this->baseUrl; ?>/kospermindo/petani/sunting?id=<?= $petani['id_petani'] ?>"><i class="entypo-pencil"></i>Sunting</a>&nbsp;
						<a href="#" data-id="<?= $petani['id_petani'] ?>" id="hapus-komo" class="btn btn-danger btn-sm btn-icon icon-left">Hapus<i class="entypo-cancel"></i></a>
					</div>
				</li>
			</ul>
			<br>
			<br>
			<table class="table">
				<tr>
					<td>Nomor Identitas</td>
					<td>:</td>
					<td><?= $petani['nik']; ?></td>
				</tr>
				<tr>
					<td>Tempat, Tanggal Lahir</td>
					<td>:</td>
					<td><?= $petani['tempat_lahir']; ?> , <?= Helper::DateToIndo($petani['tgl_lahir']); ?></td>
				</tr>
				<tr>
					<td>Nomor Telpon</td>
					<td>:</td>
					<td><?= $petani['no_telp']; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><?= $petani['alamat'].', '.$petani['kabupaten'].'-'.$petani['provinsi']; ?></td>
				</tr>
				<tr>
					<td>Nama Gudang</td>
					<td>:</td>
					<td><?= Petani::model()->getGudang($petani['id_gudang']) ?></td>
				</tr>					<tr>
					<td>Nama Kelompok</td>
					<td>:</td>
					<td><?= Petani::model()->getKelompok($petani['id_kelompok']) ?></td>
				</tr>
				<tr>
					<td>Jabatan Kelompok</td>
					<td>:</td>
					<td><?= Petani::model()->getJabatanKelompok($petani['id_petani']) ?></td>
				</tr>
				<tr>
					<td>Jenis Komoditi</td>
					<td>:</td>
					<td><?php 
						foreach (Petani::model()->getKomoditi($petani['jenis_komoditi']) as $key => $val) { ?>
							<?= $val ?>
							<br>
						<?php } ?>
					</td>
				</tr>					
				<tr>
					<td>Luas Lokasi</td>
					<td>:</td>
					<td><?= $petani['luas_lahan']; ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td>Panjang Bentangan</td>
					<td>:</td>
					<td><?= $petani['jumlah_bentangan'] ?> m</td>
				</tr>
			</table>
		</div>

	</header>
	<br>


	<section class="">

		<div class="row">

			<div class="col-sm-offset-2 col-sm-5">

				<br>
				<br>
			</div>
		</div>

	</section>
</div>

<?php
	Yii::app()->clientScript->registerScript('close-alert', '

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
					window.location.href = "/kospermindo/petani";
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