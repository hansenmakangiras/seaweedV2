
<div class="headline">

	<ol class="breadcrumb bc-3">

	<li class="active">

		 <a href="<?= $this->baseUrl; ?>"><i class="entypo-home"></i>Beranda</a>

	</li>

	</ol>

	<h2>Beranda</h2><br/>

</div>



<div class="row">

	
	<?php $red = array("blue","green","aqua","brown","red","purple","plum","cyan","orange","pink");  ?>
	<?php for($i=0; $i<=count($sumProduksiByJenis)-1;$i++) {  ?>
		<div class="col-sm-3">

			<div class="tile-stats tile-<?php echo $red[$i]; ?>">

				<h3><?= !empty($sumProduksiByJenis[$i]['jenis']) ? ucfirst($sumProduksiByJenis[$i]['jenis']) : 'Komoditi';?></h3>

				<h2 style="color:#fff"><b><?=!empty($sumProduksiByJenis[$i]['total_produksi']) ? number_format($sumProduksiByJenis[$i]['total_produksi'], 2, '.', '') : '0';?></b> TON</h2>

			</div>



		</div>
	<?php } ?>

</div>

<br/>

<div class="row">

	<div class="col-sm-12">

	<div class="panel panel-primary" id="charts_env" style="margin-bottom: 50px;">

		<div class="panel-heading">

			<div class="panel-title">Grafik Komoditi</div>

		</div>

		<div class="panel-body">

			<div id="line-chart-demo" class="morrischart" style="height: 300px"></div>

		</div>

		<table class="table table-bordered table-responsive">

			<thead>

				<tr class="count-footer">

					<th width="25%" class="col-padding-1">

					<div class="pull-left">

						<i class="entypo-leaf"></i>

						<div class="h4" style="font-size: 14px;">Hasil Panen</div>

						<small style="font-size: 20px; font-weight: bold; color: #00a65a"><?= !empty($allPanen[0]["total_produksi"]) ? number_format($allPanen[0]["total_produksi"], 2, '.', '') : "0";?> Ton</small>

					</div>

					</th>
					<?php if (Yii::app()->user->akses != 3)  { ?>
					<th width="25%" class="col-padding-1">

					<div class="pull-left">

						<i class="entypo-home"></i>

						<div class="h4" style="font-size: 14px;">Total Gudang</div>

						<small style="font-size: 20px; font-weight: bold; color: #00a65a"><?= !empty($allGudang) ? count($allGudang) : "0";?> Gudang</small>

					</div>

					</th>

					<th width="25%" class="col-padding-1">

					<div class="pull-left">

						<i class="entypo-users"></i>

						<div class="h4" style="font-size: 14px;">Total Kelompok</div>

						<small style="font-size: 20px; font-weight: bold; color: #00a65a"><?= !empty($allKelompok) ? count($allKelompok) : "0";?> Kelompok</small>

					</div>

					</th>
					<th width="25%" class="col-padding-1">

					<div class="pull-left">

						<i class="entypo-user"></i>

						<div class="h4" style="font-size: 14px;">Total Petani</div>

						<small style="font-size: 20px; font-weight: bold; color: #00a65a"><?= !empty($allFarmers[0]['total_petani']) ? $allFarmers[0]['total_petani'] : "0";?> Orang</small>

					</div>

					</th>
					<?php } ?>

				</tr>

			</thead>

		</table>


	</div>

	</div>

<!--  --><?php

//    if (Yii::app()->user->isSuperuser) {

//      $all_roles= new RAuthItemDataProvider('roles', array(

//        'type'=>2,

//      ));

//      $data=$all_roles->fetchData();

//      ?>

<!--      <div class="col-md-12">-->

<!--        <label for="type_id">Type</label>-->

<!--        --><?php //echo CHtml::dropDownList("Type",'',CHtml::listData($data,'name','name'), array('class' =>'form-control'));?>

<!--      </div>-->

<!--  --><?php //} ?>

</div>



<br/>

<?php

	Yii::app()->clientScript->registerScript('graph', '

	//var data = $.getJSON("/kospermindo/dashboard/getData");
	//console.log(data);


	$.ajax({

		url : "/kospermindo/dashboard/getData",

		type : "JSON",

		method : "POST",

	}).done(function(respond){

		var line_chart_demo = $("#line-chart-demo");

		var data = JSON.parse(respond);

		var line_chart = Morris.Bar({

		element: "line-chart-demo",

		data: JSON.parse(respond),

		xkey: "jenis",

		ykeys: ["total_produksi"],

		labels: ["Total Produksi"],

		barColors : function (row, series, type) {
			var colors = ["#00639e", "#00a65a", "#00c0ef", "#6c541e", "#f56954", "#ba79cb", "#701c1c", "#00b29e", "#ffa812", "#ec3b83"];
			return colors[row.x];
		}


	});

	line_chart_demo.parent().attr("style", "");

	});
	
	', CClientScript::POS_END);

?>
