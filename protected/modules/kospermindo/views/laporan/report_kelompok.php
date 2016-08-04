<?php
	/**
	 * Created by PhpStorm.
	 * User: hanse
	 * Date: 5/25/2016
	 * Time: 2:37 PM
	 */
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"laporan\"]');
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
				<strong><?php echo 'Laporan Kelompok'; ?></strong>
			</li>
		</ol>
		<h2>Laporan Kelompok</h2><br/>
	</div>

	<div class="row">

		<div class="col-sm-3">

			<div class="tile-stats tile-aqua">

				<div class="num" data-start="0" data-end="<?= !empty($allFarmers) ? $allFarmers : "0";?>" data-postfix="" data-duration="1500"
						 data-delay="1200">0
				</div>
				<span><strong>Orang</strong></span>

				<h3>Total User</h3>
			</div>

		</div>

		<div class="col-sm-3">

			<div class="tile-stats tile-blue">

				<div class="num" data-start="0" data-end="<?= !empty($allWarehouses) ? $allWarehouses : "0";?>" data-postfix="" data-duration="1500"
						 data-delay="1800">0
				</div>
				<span><strong>Gudang</strong></span>

				<h3>Total Gudang</h3>
			</div>

		</div>
		<div class="col-sm-3">

			<div class="tile-stats tile-green">

				<div class="num" data-start="0" data-end="<?= !empty($allGroups) ? $allGroups : "0";?>" data-postfix="" data-duration="1500"
						 data-delay="1800">0
				</div>
				<span><strong>Kelompok</strong></span>

				<h3>Total Kelompok</h3>
			</div>

		</div>
	</div>

	<hr>
	<div class="row">
		<div class="col-md-12">
			<form method="post" class="search-bar" action="" enctype="application/x-www-form-urlencoded">
				<div class="col-md-2">
					<a type="button" style="width: 100%" class="btn btn-lg btn-primary btn-icon" target="_blank" href="<?= $this->baseUrl; ?>/kospermindo/report/cetakhasilpetani">Cetak<i class="entypo-print"></i></a>
				</div>
				<div class="col-md-2">
					<a type="button" href="#" style="width: 100%" class="btn btn-primary btn-lg btn-icon" data-toggle="modal" data-target="#modal-filter">
						Filter
						<i class="entypo-list"></i></a>
				</div>
				<div class="col-md-8">
					<div class="input-group">
						<input type="text" class="form-control input-lg" name="search" placeholder="Cari Sesuatu...">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-lg btn-primary">
								Cari
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<br/>
	<br/>
	<table class="table table-hover table-responsive table-bordered">
		<thead>
		<tr>
			<th class="text-center">Nama Kelompok</th>
			<th class="text-center">Lokasi</th>

			<th class="text-center">Total Petani</th>
			<th class="text-center">Total Panen (Ton)</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($panenkelompok as $key=> $value) { ?>
			<tr>
				<td class="text-center"><a href=""><?= $value['nama_kelompok']?></a></td>
				<td class="text-center"><?= $value['idgudang'];?></td>
				<td class="text-center"><?=!empty($allkelompok[$key]) ? $allkelompok[$key] : "0";?></td>
				<td class="text-center"><?=!empty($value['total']) ? $value['total'] : "0";?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

</div>


<?php
	Yii::app()->clientScript->registerScript('showNotif','
		$("#add").click(function (e) {
		toastr.error("Please Add Warehose Name First!!!", pesan);
		e.preventDefault();
	});
	');
?>
<script type="text/javascript">
	function printData()
	{
	 var divToPrint=document.getElementById("printTable");
	 newWin= window.open("");
	 newWin.document.write(divToPrint.outerHTML);
	 newWin.print();
	 //newWin.close();
	}

	$('#cetak').on('click',function(){
	printData();
})
</script>