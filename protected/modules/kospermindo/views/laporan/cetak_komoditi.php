<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Neon Admin Panel" />
<meta name="author" content="" />

<script type="text/javascript" src="/assets/1b7e959/jquery.js"></script>
<title>Panrita - Petani Report</title>
<link rel="shortcut icon" href="/static/admin/images/favicon-seaweed.png" type="image/x-icon" />
<link rel="stylesheet" href="/static/admin/css/bootstrap.css">
<style type="text/css">
	.table-noborder > thead > tr > th, .table-noborder > tbody > tr > th, .table-noborder > tfoot > tr > th, .table-noborder > thead > tr > td, .table-noborder > tbody > tr > td, .table-noborder > tfoot > tr > td {
		border: 0;
	}
</style>
</head>

<body data-url="/kospermindo">

<h3 align="center">Laporan Komoditi Petani Rumput Laut</h3>

<br>
<br>

<div class="col-md-6">
<table class="table table-noborder">
	<tr>
		<td>Nama Petani</td>
		<td>:</td>
		<td>Baco</td>
	</tr>
	<tr>
		<td>Tempat, Tanggal Lahir</td>
		<td>:</td>
		<td>Makassar, 16 Juni 1987</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>Pettarani 2 Makassar</td>
	</tr>
	<tr>
		<td>Nomor Telepon</td>
		<td>:</td>
		<td>08938191331115</td>
	</tr>
	<tr>
		<td>Panjang Bentangan</td>
		<td>:</td>
		<td>230 m</td>
	</tr>
	<tr>
		<td>Luas Lokasi</td>
		<td>:</td>
		<td>100 m</td>
	</tr>
</table>
</div>
<br/>
<table class="table table-bordered">
				<thead>
				<tr>
					<!-- <th>ID Petani</th> -->
					<th>No</th>
					<th colspan="2">Jenis Komoditi</th>
					<th>Total Panen</th>
					<th>Kadar Air</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>1</td>
					<td colspan="2">Sango-Sango laut</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>2</td>
					<td colspan="2">Spinosom</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>3</td>
					<td colspan="2">Euchema Cotoni</td>
					<td></td>
					<td></td>
				</tr>
				<!-- <tr>
					<td rowspan="4">4</td>
					<td >Gracillaria</td>
					<td></td>
					<td></td>
				</tr> -->
				<tr>
					<td rowspan="3">4</td>
					<td rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gracillaria</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gracillaria KW 3</td>
					<td></td>
					<td></td>
					
				</tr>
				
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gracillaria KW 4</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gracillaria BS</td>
					<td></td>
					<td></td>
				</tr>
				<!-- <?php if (!empty($isFarmerKomoditi)) { ?>
					<?php foreach ($isFarmerKomoditi as $value) { ?> 
						<tr>
							<?php if ($value['status']==1) { ?>
								<td><?= $value['nama_komoditi']; ?></td>
								<td><?= $value['total_panen']; ?></td>
								<td><?= $value['kadar_air']; ?></td>
							<?php } ?>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<td>Tidak ada hasil ditemukan</td>
				<?php } ?> -->
				</tbody>
			</table>

</body>
</html>