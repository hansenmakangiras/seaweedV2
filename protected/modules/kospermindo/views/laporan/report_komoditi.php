<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Laporan Komoditi'; ?></strong>
    </li>
  </ol>
  <h2>Laporan Komoditi</h2><br/>
</div>

<div class="col-md-12">
  <div class="panel minimal minimal-gray">
    <div class="panel-heading">
      <div class="panel-title">
        <h4>Komoditi Statistik</h4>
      </div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tbody>
        <tr>
          <td>
            <strong>Line Chart</strong>
            <br/>
            <div id="chart8" style="height: 300px"></div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
    <!--    </Komoditi Statistik-->
    <!--  <div class="panel panel-default">-->
    <!--    <div class="panel-heading">-->
    <!--      <div class="panel-title">-->
    <!--        <h4>-->
    <!--          Real Time Stats-->
    <!--          <br/>-->
    <!--          <small>current server uptime</small>-->
    <!--        </h4>-->
    <!--      </div>-->
    <!---->
    <!--      <div class="panel-options">-->
    <!--        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i-->
    <!--            class="entypo-cog"></i></a>-->
    <!--        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>-->
    <!--        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>-->
    <!--        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>-->
    <!--      </div>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="panel-body no-padding">-->
    <!--      <div id="rickshaw-chart-demo-2">-->
    <!--        <div id="rickshaw-legend"></div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <br/>
    <hr/>
    <?php $this->renderPartial('/widget/search-filter'); ?>

    <br>
    <br/>
    <table id="tblpetani" class="table table-hover table-responsive table-bordered" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Item</center>
        </th>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Sango-Sango Laut</center>
        </th>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Spinosom</center>
        </th>
        <th rowspan="2" style="
		vertical-align: middle">
          <center>Euchema Cotoni</center>
        </th>
        <th colspan="5">
          <center>Gracillia</center>
        </th>
      </tr>
      <tr>
        <th>
          <center>KW 3</center>
        </th>
        <th>
          <center>KW 4</center>
        </th>
        <th>
          <center>BS</center>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          <center>Total Panen</center>
        </td>
        <?php { ?>
          <td>
            <center><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[1]['total_panen']) ? $summary[1]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[2]['total_panen']) ? $summary[2]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[3]['total_panen']) ? $summary[3]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[4]['total_panen']) ? $summary[4]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
          <td>
            <center><?= !empty($summary[5]['total_panen']) ? $summary[5]['total_panen'] . " Ton" : "-"; ?></center>
          </td>
        <?php } ?>

      </tr>
      <tr>
        <td>
          <center>Kadar Air</center>
        </td>
        <td>
          <center><?= !empty($summary[0]['kadar_air']) ? $summary[0]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[1]['kadar_air']) ? $summary[1]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[2]['kadar_air']) ? $summary[2]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[3]['kadar_air']) ? $summary[3]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[4]['kadar_air']) ? $summary[4]['kadar_air'] . "%" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[5]['kadar_air']) ? $summary[5]['kadar_air'] . "%" : "-"; ?></center>
        </td>

      </tr>
      <tr>
        <td>
          <center>Jumlah Bentangan</center>
        </td>
        <td>
          <center><?= !empty($summary[0]['jumlah_bentangan']) ? $summary[0]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[1]['jumlah_bentangan']) ? $summary[1]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[2]['jumlah_bentangan']) ? $summary[2]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[3]['jumlah_bentangan']) ? $summary[3]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[4]['jumlah_bentangan']) ? $summary[4]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>
        <td>
          <center><?= !empty($summary[5]['jumlah_bentangan']) ? $summary[5]['jumlah_bentangan'] . "m" : "-"; ?></center>
        </td>

      </tr>
      <tr>
        <td>
          <center>Aksi</center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=1"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=2"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=3"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=4"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=5"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
        <td>
          <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=6"
                     class="btn btn-info btn-sm btn-icon icon-left">
              <i class="entypo-info"></i>
              Detil
            </a></center>
        </td>
      </tr>
      </tbody>
    </table>
  </div>

  <?php
    Yii::app()->clientScript->registerScript('showNotif', '
    var element = $("#main-menu li[data-nav=\'laporan\']");
    
    element.addClass("active opened");
    element.find("ul").addClass("visible").removeAttr("style");
    element.find("ul").find("li:nth-child(1)").addClass("active");

    $("#add").click(function (e) {
      toastr.error("Please Add Warehose Name First!!!", pesan);
      e.preventDefault();
    });
    
    function printData() {
      var divToPrint = document.getElementById("printTable");
      newWin = window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      //newWin.close();
    }
  
    $("#cetak").on("click", function () {
      printData();
    })
    setTimeout(function(){
      $.ajax({
        url : "/kospermindo/laporan/getData",     
        type : "JSON",
        method : "POST",
      }).done(function(respond){     
        var line_chart = $("#chart8");
        var resp = JSON.parse(respond);
        Morris.Line({
          element: line_chart,
          data: resp,
          xkey: "tipe_seaweed",
          ykeys: ["Total Panen"],
          labels: ["Total Panen"],
          //xLabels: "month",
          //events: ["2012-01-01", "2012-02-01", "2012-03-01"],
          parseTime: false,
          postUnits: " Ton",
          redraw: true,
          lineColors: ["#242d3c"]
        });
        line_chart.parent().attr("style", "");
      });
    },300);

  
  
  // Rickshaw
//    var seriesData = [ [], [] ];
//
//    var random = new Rickshaw.Fixtures.RandomData(50);
//
//    for (var i = 0; i < 90; i++)
//    {
//      random.addData(seriesData);
//    }
//    console.log(seriesData);
//    var graph = new Rickshaw.Graph( {
//      element: document.getElementById("rickshaw-chart-demo-2"),
//      height: 217,
//      renderer: \'area\',
//      stroke: false,
//      preserve: true,
//      series: [{
//        color: \'#359ade\',
//        data: seriesData[0],
//        name: \'Page Views\'
//      }, {
//        color: \'#73c8ff\',
//        data: seriesData[1],
//        name: \'Unique Users\'
//      }, {
//        color: \'#e0f2ff\',
//        data: seriesData[1],
//        name: \'Bounce Rate\'
//      }
//      ]
//    } );
//
//    graph.render();
//
//    var hoverDetail = new Rickshaw.Graph.HoverDetail( {
//      graph: graph,
//      xFormatter: function(x) {
//        return new Date(x * 1000).toString();
//      }
//    } );
//
//    var legend = new Rickshaw.Graph.Legend( {
//      graph: graph,
//      element: document.getElementById(\'rickshaw-legend\')
//    } );
//
//    var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
//      graph: graph,
//      legend: legend
//    } );
//
//    setInterval( function() {
//      random.removeData(seriesData);
//      random.addData(seriesData);
//      graph.update();
//
//    }, 2000 );
	');
  ?>
