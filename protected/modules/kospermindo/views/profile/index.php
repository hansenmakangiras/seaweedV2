<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Data Petani</a>
		</li>
		<li class="active">
			<strong><?= $model_petani['nama_petani']; ?></strong>
		</li>
	</ol>
	<h2>Detail Petani</h2><br/>
</div>

<div class="profile-env">
	<header class="row">
		<div class="col-sm-2">
			<a href="#" class="profile-picture">
				<img src="<?= $this->baseUrl?>/static/admin/images/profile-picture.png" class="img-responsive img-circle" />
			</a>
		</div>
		<div class="col-sm-9">
			<ul class="profile-info-sections">
				<li>
					<div class="profile-name">
						<strong style="margin-bottom: 5px; text-transform: capitalize; color: #333;"><?= $model_petani['nama_petani']; ?></strong>
						<span><a href="#">Petani Rumput Laut</a></span>
					</div>
					<br>
					<div>
						<a class="btn btn-default btn-sm btn-icon icon-left" href="<?= $this->baseUrl; ?>/kospermindo/user/update?id=<?= $model_petani['id_user']; ?>"><i class="entypo-pencil"></i>Sunting</a>&nbsp;
						<a href="#" data-record-id="<?= $model_petani['id_user']; ?>" data-record-title="Confirmation" data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete" data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus<i class="entypo-cancel"></i></a>
					</div>
				</li>
			</ul>
		</div>

	</header>
	<br>


	<section class="">

		<div class="row">

			<div class="col-sm-offset-2 col-sm-5">

				<table class="table">
					<tr>
						<td>Nomor Identitas</td>
						<td>:</td>
						<td><?= $model_petani['nmr_identitas']; ?></td>
					</tr>
					<tr>
						<td>Tempat, Tanggal Lahir</td>
						<td>:</td>
						<td><?= $model_petani['tempat_lahir']; ?> , <?= Helper::DateToIndo($model_petani['tanggal_lahir']); ?></td>
					</tr>
					<tr>
						<td>Nomor Telpon</td>
						<td>:</td>
						<td><?= $model_petani['no_telp']; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?= $model_petani['alamat']; ?></td>
					</tr>
					<tr>
						<td>Nama Kelompok</td>
						<td>:</td>
						<td></td>
					</tr>
					<tr>
						<td>Jabatan Kelompok</td>
						<td>:</td>
						<td></td>
					</tr>
					<tr>
						<td>Luas Lokasi</td>
						<td>:</td>
						<td></td>
					</tr>
					<tr>
						<td>Panjang Bentangan</td>
						<td>:</td>
						<td></td>
					</tr>
				</table>
				<br>
				<br>
			</div>
		</div>

	</section>
</div>