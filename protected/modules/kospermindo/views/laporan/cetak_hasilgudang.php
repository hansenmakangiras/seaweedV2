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

<h3 align="center">Laporan Hasil Panen Semua Komoditi</h3>

<br/>
<br/>

<table class="table table-bordered">
  <thead>
  <tr>
    <th class="text-center">Lokasi</th>
    <th class="text-center">Total Kelompok</th>
    <th class="text-center">Total Panen (Ton)</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($warehouse as $key => $value) { ?>
  <tr>
    <td class="text-center"><?= !empty($value['lokasi_gudang']) ? $value['lokasi_gudang'] : "No Warehouse";?></td>
    <td class="text-center"><?= !empty($total_group[$key]) ? $total_group[$key] : "0";?></td>
    <td class="text-center"><?= !empty($totalPanengudang[$key]['total']) ? $totalPanengudang[$key]['total'] : "0";?></td>
  </tr>
  <?php } ?>
  </tbody>
</table>


</body>
</html>