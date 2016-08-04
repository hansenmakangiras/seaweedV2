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
		<?php if(Yii::app()->user->hasFlash('pesan')) {?>
			<div class="alert alert-success" id="myHideEffect"><strong><?php echo Yii::app()->user->getFlash('pesan'); ?></strong></div>
		<?php  } ?>

		<form action="<?= $this->baseUrl; ?>/kospermindo/groups/create?>" method="post" class="row">
			<div class="col-md-5">
				<select name="lokasiKelompok" class="form-control input-lg">
					<?php if($namaKelompok!=null) { ?>
						<?php foreach ($namaKelompok as $key => $value) { ?>
							<option value="<?= $value->id_user; ?>"><?= $value->lokasi;?></option>
						<?php } ?>
					<?php } else { ?>

					<?php }?>
				</select>
			</div>
			<div class="col-md-5">
				<input type="text" name="namaKelompok" placeholder="Nama Kelompok" class="form-control input-lg" required>
			</div>
			<div class="col-md-2">
				<button class="btn btn-info btn-lg" id="<?php if($namaKelompok==null) { echo "add"; } ?>">+ &nbsp;Tambah</button>
			</div>
		</form>

		<br>
		<br>

		<div class="row">
			<div class="col-md-8">
				<table id="tblkelompok" class="table table-responsive table-hover table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Nama Kelompok</th>
							<th>Lokasi</th>
							<th width="200px">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($data->getData())) { ?>
					<?php foreach($data->getData() as $value) { ?>
						<tr>
						<?php if($value->status==1) { ?>
							
							
							<td><?= $value->nama_kelompok; ?></td>
							<td><?= $value->lokasi; ?></td>            
							<!--<td><?php echo ($value->status !== 0) ? 'Aktif' : 'Non Aktif' ; ?></td> -->
							<td>
								<a class="btn btn-default btn-sm btn-icon icon-left" href="<?= $this->baseUrl; ?>/kospermindo/groups/update?id=<?= strtolower($value['id_user']); ?>"><i class="entypo-pencil"></i>Sunting</a>
                            	<a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation" data-href="<?php echo $this->baseUrl; ?>/kospermindo/groups/delete" data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i class="entypo-cancel"></i>
							</td>
						<?php } ?>    
						</tr>
					<?php } ?>
					<?php } else { ?>
						<td colspan = "3">Tidak ada hasil ditemukan</td>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<?php
			$pages = $data->getPagination();
			$this->widget('CLinkPager', array(
				'pages' => $data->pagination
			));
		?>

	</div>
</div>
<script>
  var pesan = '<?php $pesan ?>';
</script>
<?php
  Yii::app()->clientScript->registerScript('showNotif','
    $("#add").click(function (e) {
    toastr.error("Anda Harus Menambahkan Data Gudang Terlebih Dahulu!!!", pesan);
    e.preventDefault();
  });
  ');
?>