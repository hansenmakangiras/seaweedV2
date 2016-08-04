<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"manage-user\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(2)').addClass('active');
");
?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong><?php echo 'Manajemen Moderator'; ?></strong>
		</li>
	</ol>
	<h2>Manajemen Moderator</h2><br/>
</div>

<div class="row">
	<div class="col-md-8">
	 
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
								 href="<?= $this->baseUrl; ?>/kospermindo/user/updatemoderator?id=<?= strtolower($value->id); ?>">
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
					<th>Nama Moderator</th>
					<th>Status</th>
					<th width="200px">Aksi</th>

				</tr>
				</thead>
				<tbody>
				<?php foreach ($moderator as $value) { ?>
					
					<tr>
						<td><?= $value->id; ?></td>
						<td><?= $value->username; ?></td>
						<td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
						<td>
							<?php if (($value->status) === '0') { ?>
								<a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
									 data-href="<?php echo $this->baseUrl; ?>/kospermindo/users/delete"
									 data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
									 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Aktifkan
								</a>
							<?php } else { ?>
								<a class="btn btn-default btn-sm btn-icon icon-left"
									 href="<?= $this->baseUrl; ?>/kospermindo/users/updatemoderator?id=<?= strtolower($value['id']); ?>"><i
										class="entypo-pencil"></i>
									Sunting
								</a>

								<a href="#" class="btn btn-danger btn-sm btn-icon icon-left">Hapus<i class="entypo-cancel"></i></a>
								

							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php } ?>	

	</div>
</div>

	