<?php
	/**
	 * Created by PhpStorm.
	 * User: hanse
	 * Date: 5/25/2016
	 * Time: 2:37 PM
	 */
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"report\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(5)').addClass('active');
");
?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong><?php echo 'Laporan Stok Barang'; ?></strong>
		</li>
	</ol>
	<h2>Laporan Stok Barang</h2><br/>
</div>


<div class="row">
	<form method="post" class="search-bar" action="" enctype="application/x-www-form-urlencoded">  
		<div class="col-md-2">
			<a type="button" style="width: 100%" class="btn btn-lg btn-primary btn-icon" target="_blank" href="<?= $this->baseUrl; ?>/kospermindo/report/cetakhasilpetani">Cetak<i class="entypo-print"></i></a>
		</div>
		<div class="col-md-2">
			<a type="button" style="width: 100%" data-toggle="modal" data-target="#modal-filter" class="btn btn-primary btn-lg btn-icon" target="_blank" href="#">Filter<i class="entypo-list"></i></a>
		</div>
		<div class="col-md-8">
			<div class="input-group">
				<input type="text" class="form-control input-lg" name="search" placeholder="Cari Sesuatu...">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-lg btn-primary">
						<i class="entypo-search"></i>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>

<br>
<br>

<div class="row">
	<div class="col-md-12">

		
		<?php if (Users::model()->isSuperUser() == true) { ?>
			<table id="tblpetani" class="table table-responsive table-hover table-bordered">
				<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="10%">Username</th>
					<th>Help Desk Phone</th>
					<th width="15%">Email</th>
					<?php if (Users::model()->isSuperUser() == true) { ?>
						<th>Type of Commodity</th>
					<?php } ?>
					<th>Status</th>
					<th width="15%">Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($data as $value) { ?>
					<tr>
						<td><?= $value->id; ?></td>
						<td><?= $value->username; ?></td>
						<td><?= $value->no_handphone; ?></td>
						<td><?= $value->email; ?></td>
						<?php if (Users::model()->isSuperUser() == true) { ?>
							<td><?= $value->komoditi; ?></td>
						<?php } ?>
						<td><?= ($value->status === '1') ? 'Aktif' : 'Non Aktif'; ?></td>
						<td>
							<a class="btn btn-sm btn-default"
								 href="<?= $this->baseUrl; ?>/kospermindo/user/update?id=<?= strtolower($value->id); ?>">
								Edit
							</a>
							<?php if ($value->status === '0') { ?>
								<a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
									 data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/aktifkandata"
									 data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
									 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
								</a>
							<?php } else { ?>
								<a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
									 data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
									 data-record-body="Apakah anda yakin ingin menghapus data ini?"
									 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Disable
								</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php } else { ?>

			<table id="tblpetani" class="table table-responsive table-hover table-bordered">
				<thead>
				<tr>
					<th width="5%">ID</th>
					<th>Lokasi Gudang</th>
					<th>Penganggung Jawab Gudang</th>
					<th>Stok Masuk</th>
					<th>Stok Keluar</th>
					<th>Tanggal Masuk</th>
					
					<th width="200px">Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($warehouseData as $value) { ?>
					<?php if($value->status==='1') { ?>
					<tr>
						<td><?= $value->id; ?></td>
						<td><?= $value->lokasi_gudang; ?></td>
						<td><?= $value->nama_koordinator; ?></td>
						<td><?= !empty($value->stok_masuk) ? $value->stok_masuk : "-"; ?></td>
						<td><?= !empty($value->stok_keluar) ? $value->stok_keluar : "-"; ?></td>
						<td></td>
						
						<td>
							<?php if (($value->status) === '0') { ?>
								<a href="#" data-record-id="<?= strtolower($value->id_user); ?>" data-record-title="Confirmation"
									 data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
									 data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
									 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Aktifkan
								</a>
							<?php } else { ?>
								<a class="btn btn-default btn-sm btn-icon icon-left"
									 href="<?= $this->baseUrl; ?>/kospermindo/user/update?id=<?= strtolower($value['id_user']); ?>"><i
										class="entypo-pencil"></i>
									Sunting
								</a>
								<a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation"
									 data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
									 data-record-body="Apakah anda yakin ingin menghapus data ini?"
									 data-toggle="modal" data-target="#confirm-delete"
									 class="btn btn-danger btn-sm btn-icon icon-left">Hapus
									<i class="entypo-cancel"></i>
								</a>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
			</table>
		<?php } ?>
	</div>
</div>