<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"manage-user\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(3)').addClass('active');
");
?>
<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong><?php echo 'Manajemen Komoditi'; ?></strong>
		</li>
	</ol>
	<h2>Manajemen Komoditi</h2><br/>
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
	        <?php }else{ ?>
	          <div></div>
	        <?php } ?>
	      </div>
	    </div>
		<?php if (Users::model()->isSuperUser() == true) { ?>
			<table id="tblpetani" class="table table-responsive table-hover">
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
			<a class="btn btn-info btn-lg" href="<?php echo $this->baseUrl; ?>/kospermindo/users/tambahkomoditi" class="btn btn-default">+ &nbsp;Tambah</a>
			<br/>
			<br/>
			<br/>

			<table id="tblpetani" class="table table-responsive table-hover table-bordered">
				<thead>
				<tr>
					<th width="5%">ID</th>
					<th>Nama Petani</th>
					<th>Kelompok</th>
					<th>Lokasi</th>
					<th>Jenis Komoditi</th>
					<th>Total Panen</th>
					<th>Kadar Air</th>
					<th>Jumlah Bentangan</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($komoditi as $value) { ?>
					<?php if($value['status']==1) { ?>
						<tr>
							<td><?= $value['id']; ?></td>
							<td><?= $value['nama_petani']; ?></td>
							<td><?= $value['nama_kelompok'];?></td>
							<td><?= $value['lokasi'];?></td>
							<td><?= $value['nama_komoditi'] ?></td>
							<td><?= $value['total_panen'] ?></td>
							<td><?= $value['kadar_air'] ?></td>
							<td><?= $value['jumlah_bentangan'] ?></td>
							<td>
								<a class="btn btn-default btn-sm btn-icon icon-left" href=<?= $this->baseUrl; ?>/kospermindo/users/update?id=<?= strtolower($value['id']); ?>"><i class="entypo-pencil"></i>Sunting</a>
								<a href="#" data-record-id="<?= $value['id_user']; ?>" data-record-title="Confirmation" data-href="<?php echo $this->baseUrl; ?>/kospermindo/users/delete" data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i class="entypo-cancel"></i></a>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
			</table>
		<?php } ?>	

	</div>
</div>
<script>
  var baseurl;
</script>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
  setTimeout(function () {
    $("#pesan").addClass("hidden");
  }, 5000); 
   
  ', CClientScript::POS_END);
?>
	