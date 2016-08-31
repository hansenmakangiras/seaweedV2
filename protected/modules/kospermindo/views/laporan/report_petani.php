<?php

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
        <strong><?php echo 'Laporan Petani'; ?></strong>
      </li>
    </ol>
    <h2>Laporan Petani</h2><br/>
  </div>

  <div class="row">

    <form method="post" class="search-bar" action="" enctype="application/x-www-form-urlencoded">
      <div class="col-md-3">
        <input value="<?= (!empty($range)) ? $range : date('d/m/Y') . ' - ' . date('d/m/Y') ?>" type="text"
               id="range_date" data-format="DD/MM/YYYY" class="form-control daterange input-lg"
               placeholder="Rentang Waktu"/>
      </div>
      <div class="col-md-3">
        <select name="test" id="gudang" class="select2" data-allow-clear="true" data-placeholder="Pilih Gudang"
                style="font-size:15px">
          <option></option>
          <optgroup label="Cadangan">
            <?php foreach ($gudang as $key => $valcad) {
              if ($valcad->kode_jenis_gudang == '111') { ?>
                <option
                  value="<?= $valcad->id_gudang ?>" <?= ($id_gudang == $valcad->id_gudang) ? 'selected' : '' ?>><?= $valcad->nama ?></option>
              <?php }
            } ?>
          </optgroup>
          <optgroup label="Koperasi">
            <?php foreach ($gudang as $key => $valkop) {
              if ($valkop->kode_jenis_gudang == '112') { ?>
                <option
                  value="<?= $valkop->id_gudang ?>" <?= ($id_gudang == $valkop->id_gudang) ? 'selected' : '' ?>><?= $valkop->nama ?></option>
              <?php }
            } ?>
          </optgroup>
          <optgroup label="Gapoktan">
            <?php foreach ($gudang as $key => $valgap) {
              if ($valgap->kode_jenis_gudang == '113') { ?>
                <option
                  value="<?= $valgap->id_gudang ?>" <?= ($id_gudang == $valgap->id_gudang) ? 'selected' : '' ?>><?= $valgap->nama ?></option>
              <?php }
            } ?>
          </optgroup>
        </select>
      </div>
      <div class="col-md-3">
        <select name="" id="kelompok" class="form-control input-lg">
          <?php foreach ($kelompok as $key => $valkelompok) { ?>
            <option
              value="<?= $valkelompok->id_kelompok ?>" <?= ($id_klpk == $valkelompok->id_kelompok) ? 'selected' : '' ?> ><?= $valkelompok->nama_kelompok ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-3">
        <select name="" id="petani" class="form-control input-lg">
          <?php foreach ($petani as $key => $valpetani) { ?>
            <option
              value="<?= $valpetani->id_petani ?>" <?= ($id_tani == $valpetani->id_petani) ? 'selected' : '' ?> ><?= $valpetani->nama_petani ?></option>
          <?php } ?>
        </select>
      </div>
    </form>

    <div class="clearfix"></div>

    <div class="col-md-12">
      <hr>
    </div>

    <?php
      $colors = ['red', 'aqua', 'blue', 'green', 'cyan', 'orange'];
      $colorHex = ['#f56954', '#00c0ef', '#0073b7', '#00a65a', '#009987', '#f89d00'];
    ?>

    <?php $i = 0;
      $total_panen = 0;
      foreach ($jenis_komoditi as $key => $valjnsk) {
        $total_panen = $total_panen + (float)$valjnsk['jumlah'][0]['SUM(total_panen)'] / 1000 ?>
        <div class="col-sm-3">

          <div class="tile-stats tile-<?= $colors[$i] ?>">

            <h3><?= JenisKomoditi::model()->getJenisKomoditi($valjnsk['id'])['jenis'] ?></h3>
            <h2 style="color:#fff"><b>
                <div id="<?= $valjnsk['id'] ?>" class="num" data-start="0" data-end="" data-postfix=""
                     data-duration="1500"
                     data-delay="1200"
                     data-color-hex="<?= $colorHex[$i] ?>"><?= (!is_null($valjnsk['jumlah'][0]['SUM(total_panen)'])) ? number_format((float)$valjnsk['jumlah'][0]['SUM(total_panen)'] / 1000,
                    2, '.', '') : '0' ?>
                </div>
              </b> TON
            </h2>
          </div>

        </div>

        <?php
        if ($i == 5) {
          $i = 0;
        } else {
          $i++;
        }
      } ?>

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
          <tr class="count-footer">
            <th width="50%" class="col-padding-1">
              <div class="pull-left">
                <i class="entypo-leaf"></i>
                <div class="h4" style="font-size: 14px;">Hasil Panen</div>
                <small style="font-size: 20px; font-weight: bold; color: #00a65a" id="total_panen"><?= $total_panen; ?>
                  Ton
                </small>
              </div>
            </th>
          </tr>
          </thead>

        </table>

      </div>

    </div>

  </div>


  </div>


<?php
  Yii::app()->clientScript->registerScript('graph', '

		$(document).ready(function(){
			$("label[for=daterangepicker_start]").text("Mulai");
			$("label[for=daterangepicker_end]").text("Sampai");
			$(".applyBtn").text("Cek");
			$(".cancelBtn").text("Batal"); 

			$("#line-chart-demo").html("");
			$("div.num").html("0");
			$.ajax({
				type: "POST",
				url: "/kospermindo/laporan/chartpetani",
				data:{
					"id_gudang" : $("#gudang").val(),
					"id_kelompok" : $("#kelompok").val(),
					"id_petani" : $("#petani").val(),
					"start" : $("input[name=daterangepicker_start]").val(),
					"end" : $("input[name=daterangepicker_end]").val(),
				},
				success: function(data){
					msg = $.parseJSON(data);
					colorHex = [];
						$.each(msg[0].ykeys, function(k, v){
							colorHex.push($("#"+v).attr("data-color-hex"));
						});
					var line_chart_demo = $("#line-chart-demo");
					var line_chart = Morris.Line({
						element: "line-chart-demo",
						data: msg[0].data,
						xkey: "y",
						ykeys: msg[0].ykeys,
						labels: msg[0].label,
						yLabelFormat: function(y) { return y.toString() + " Ton"; },
						redraw: true,
						lineColors : colorHex
					});
					
					line_chart_demo.parent().attr("style", "");
					$("#total_panen").html(msg[0].hasil_panen + " TON");
					var jenis = msg[0].count_jenis;
					$.each(jenis, function(key, value){
						$.each(value, function(keys, val) {
							$("#"+keys).html(val);
						});

					});
	
				}
			});

			$(".applyBtn").on("click", function(){
				$("#line-chart-demo").html("");
				$("div.num").html("0");
				$.ajax({
					type: "POST",
					url: "/kospermindo/laporan/chartpetani",
					data:{
						"id_gudang" : $("#gudang").val(),
						"id_kelompok" : $("#kelompok").val(),
						"id_petani" : $("#petani").val(),
						"start" : $("input[name=daterangepicker_start]").val(),
						"end" : $("input[name=daterangepicker_end]").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						colorHex = [];
						$.each(msg[0].ykeys, function(k, v){
							colorHex.push($("#"+v).attr("data-color-hex"));
						});
						var line_chart_demo = $("#line-chart-demo");
						var line_chart = Morris.Line({
							element: "line-chart-demo",
							data: msg[0].data,
							xkey: "y",
							ykeys: msg[0].ykeys,
							labels: msg[0].label,
							yLabelFormat: function(y) { return y.toString() + " Ton"; },
							redraw: true,
							lineColors : colorHex
						});
						
						line_chart_demo.parent().attr("style", "");
						$("#total_panen").html(msg[0].hasil_panen + " TON");
						var jenis = msg[0].count_jenis;
						$.each(jenis, function(key, value){
							$.each(value, function(keys, val) {
								$("#"+keys).html(val);
							});

						});


					}
				});
			});


			$("#gudang").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getkelompok",
					data:{
						"id" : $("#gudang").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#kelompok").empty();
						$("#kelompok").end();
						$("#petani").empty();
						$("#petani").end();
						$.each(msg, function(i, v){
							$("#kelompok").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
						});
						$.ajax({
							type: "POST",
							url: "/kospermindo/petani/getpetani",
							data:{
								"id_gudang" : $("#gudang").val(),
								"id_kelompok" : $("#kelompok").val()
							},
							success: function(data){
								msg = $.parseJSON(data);
								$("#petani").empty();
								$("#petani").end();
								$.each(msg, function(i, v){
									$("#petani").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
								});
								$.ajax({
									type: "POST",
									url: "/kospermindo/laporan/getpetani",
									data:{
										"id_gudang" : $("#gudang").val(),
										"id_kelompok" : $("#kelompok").val(),
										"id_petani" : $("#petani").val(),
										"start" : $("input[name=daterangepicker_start]").val(),
										"end" : $("input[name=daterangepicker_end]").val(),
									},
									success: function(data){
										msg = $.parseJSON(data);
										window.location.reload(true);
									}
								});

							}
						});
					}
				});
			});

			$("#kelompok").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getpetani",
					data:{
						"id_gudang" : $("#gudang").val(),
						"id_kelompok" : $("#kelompok").val()
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#petani").empty();
						$("#petani").end();
						$.each(msg, function(i, v){
							$("#petani").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
						});
						$.ajax({
							type: "POST",
							url: "/kospermindo/laporan/getpetani",
							data:{
								"id_gudang" : $("#gudang").val(),
								"id_kelompok" : $("#kelompok").val(),
								"id_petani" : $("#petani").val(),
								"start" : $("input[name=daterangepicker_start]").val(),
								"end" : $("input[name=daterangepicker_end]").val(),
							},
							success: function(data){
								msg = $.parseJSON(data);
								window.location.reload(true);
							}
						});
					}
				});
			});
			
			$("#petani").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/laporan/getpetani",
					data:{
						"id_gudang" : $("#gudang").val(),
						"id_kelompok" : $("#kelompok").val(),
						"id_petani" : $("#petani").val(),
						"start" : $("input[name=daterangepicker_start]").val(),
						"end" : $("input[name=daterangepicker_end]").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						window.location.reload(true);
					}
				});
			});

		});
		

	', CClientScript::POS_END);
?>