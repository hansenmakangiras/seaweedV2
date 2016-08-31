<?php

	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"laporan\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(1)').addClass('active');
");
?>
<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong><?php echo 'Laporan Gudang'; ?></strong>
		</li>
	</ol>
	<h2>Laporan Gudang</h2><br/>
</div>

<div class="row">

	<form method="post" class="search-bar" action="" enctype="application/x-www-form-urlencoded">
		<div class="col-md-3">
			<input value="" type="text" id="range_date" data-format="DD/MM/YYYY" class="form-control daterange input-lg" placeholder="Rentang Waktu" />
		</div>
		<div class="col-md-3">
			<select name="" id="gudang" class="form-control input-lg">
					<option value="" >Pilih Gudang</option>
			</select>
		</div>
	</form>

	<div class="clearfix"></div>

	<div class="col-md-12">
		<hr>
	</div>

	<?php
		$colors = ['red', 'aqua', 'blue', 'green', 'cyan', 'orange'];
		$colorHex = ['#f56954','#00c0ef', '#0073b7', '#00a65a', '#009987', '#f89d00'];
	?>
	
		<div class="col-sm-3">
			<div class="tile-stats tile-red">

				<div id="" class="num" data-start="0" data-end="" data-postfix="" data-duration="1500"
						 data-delay="1200">200
				</div>
				<span><strong>/TON</strong></span>

				<h3>Ikan Paus</h3>
			</div>

		</div>

		<div class="col-sm-3">
			<div class="tile-stats tile-aqua">

				<div id="" class="num" data-start="0" data-end="" data-postfix="" data-duration="1500"
						 data-delay="1200">200
				</div>
				<span><strong>/TON</strong></span>

				<h3>Ikan Paus</h3>
			</div>

		</div>
		<div class="col-sm-3">
			<div class="tile-stats tile-blue">

				<div id="" class="num" data-start="0" data-end="" data-postfix="" data-duration="1500"
						 data-delay="1200">200
				</div>
				<span><strong>/TON</strong></span>

				<h3>Ikan Paus</h3>
			</div>

		</div>

</div>

<br/>
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
				<tr>
					<th width="50%" class="col-padding-1">
						<div class="pull-left">
							<div class="h4" style="font-size: 14px;">Hasil Panen</div>
							<small style="font-size: 28px; font-weight: bold; color: #00a65a" id="total_panen">2000 Ton</small>
						</div>
					</th>
					<th width="50%" class="col-padding-1">
						<div class="pull-left">
							<div class="h4" style="font-size: 14px;">Total Petani</div>
							<small style="font-size: 28px; font-weight: bold; color: #00a65a" id="petani">100 Orang</small>
						</div>
					</th>
				</tr>
				</thead>

			</table>

		</div>

	</div>

</div>

BN39-01576A

</div>


<?php
	Yii::app()->clientScript->registerScript('graph', '

		$(document).ready(function(){

			var line_chart_demo = $("#line-chart-demo");
			var line_chart = Morris.Line({
				element: "line-chart-demo",
				data: [{y : 2016-08-09, a:200},{y : 2016-08-09, a:200},{y : 2016-08-08, a:200},{y : 2016-08-13, a:200}],
				xkey: "y",
				ykeys: ["a","b","c","d"],
				labels: ["contoh a", "contoh b", "contoh c", "contoh d"],
				yLabelFormat: function(y) { return y.toString() + " Ton"; },
				redraw: true,
				lineColors : ["#f56954","#00c0ef", "#0073b7", "#00a65a"]
			});
					
			line_chart_demo.parent().attr("style", "");

		});
		

	', CClientScript::POS_END);
?>