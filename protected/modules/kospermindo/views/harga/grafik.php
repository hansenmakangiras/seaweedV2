<?php

	Yii::app()->clientScript->registerScript('search', "

		var element = $('#main-menu li[data-nav=\"harga\"]');

		element.addClass('active');

");

?>
<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<b>Grafik Harga Komoditi</b>
		</li>
	</ol>
	<h2>Grafik Harga Komoditi</h2><br/>
</div>
<input type="hidden" id="id_komoditi" value="<?= $id;?>">
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-primary" id="charts_env" style="margin-bottom: 50px;">

			<div class="panel-heading">
				<div class="panel-title">Grafik Komoditi</div>
			</div>

			<div class="panel-body">
				<div id="line-chart-demo" class="morrischart" style="height: 300px"></div>
			</div>

		</div>

	</div>

</div>

<footer class="main">
	© 2016 <strong>Panrita</strong> - <a href="https://www.docotel.com" target="_blank">PT. Docotel Teknologi Celebes</a>
</footer>

</div>


<?php
	Yii::app()->clientScript->registerScript('graph', '
		$(document).ready(function(){

			function toRp(angka){
				var rev     = parseInt(angka, 10).toString().split("").reverse().join("");
				var rev2    = "";
				for(var i = 0; i < rev.length; i++){
					rev2  += rev[i];
					if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
						rev2 += ".";
					}
				}
				return "Rp. " + rev2.split("").reverse().join("") + ",00";
			}

			$.ajax({
				type : "POST",
				url  : "/kospermindo/harga/grafikperubahanharga",
				data :{
					"id" : $("#id_komoditi").val(),
				},
				success : function(data){
					var lbl = [],
						msg = $.parseJSON(data),
						line_chart_demo = $("#line-chart-demo");
					
					var line_chart = Morris.Line({
						element: "line-chart-demo",
						data: JSON.parse(data),
						parseTime: false,
						xkey: "id",
						ykeys: ["harga"],
						labels: ["Harga(Tgl)"],
						redraw: true,
						hoverCallback: function(index, options, content) {
							var data = options.data[index];
							$(".morris-hover").html("<div><b>"+ data.created_date +"</b></div><br><div>Harga : " + toRp(data.harga) + "</div>");
						},
					});
					line_chart_demo.parent().attr("style", "");
				}
			});
		});

	', CClientScript::POS_END);
?>