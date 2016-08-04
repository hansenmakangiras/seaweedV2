<h3 align="center">Laporan Hasil Panen Semua Komoditi</h3>
<table id="tblpetani" border="1" width="100%" height = "50%">
          <thead>
          <tr>
            <th rowspan="2" style="
    vertical-align: middle"><center>Item</center></th>
            <th rowspan="2" style="
    vertical-align: middle"><center>Sango-Sango Laut</center></th>
            <th rowspan="2" style="
    vertical-align: middle"><center>Spinosom</center></th>
            <th rowspan="2" style="
    vertical-align: middle"><center>Euchema Cotoni</center></th>
            <th colspan="5"><center>Gracillia</center></th>
          </tr>
          <tr>
            <th><center>KW 3</center></th>
            <th><center>KW 4</center></th>
            <th><center>BS</center></th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td><center>Total Panen</center></td>
              <?php  { ?>
                <td><center><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen']." Ton" : "-" ;?></center></td>
                <td><center><?= !empty($summary[1]['total_panen']) ? $summary[1]['total_panen']." Ton" : "-" ;?></center></td>
                <td><center><?= !empty($summary[2]['total_panen']) ? $summary[2]['total_panen']." Ton": "-" ;?></center></td>
                <td><center><?= !empty($summary[3]['total_panen']) ? $summary[3]['total_panen']." Ton": "-" ;?></center></td>
                <td><center><?= !empty($summary[4]['total_panen']) ? $summary[4]['total_panen']." Ton": "-" ;?></center></td>
                <td><center><?= !empty($summary[5]['total_panen']) ? $summary[5]['total_panen']." Ton": "-" ;?></center></td>  
              <?php } ?>

            </tr>
            <tr>
              <td><center>Kadar Air</center></td>
              <td><center><?= !empty($summary[0]['kadar_air']) ? $summary[0]['kadar_air']."%" : "-" ;?></center></td>
              <td><center><?= !empty($summary[1]['kadar_air']) ? $summary[1]['kadar_air']."%" : "-" ;?></center></td>
              <td><center><?= !empty($summary[2]['kadar_air']) ? $summary[2]['kadar_air']."%" : "-" ;?></center></td>
              <td><center><?= !empty($summary[3]['kadar_air']) ? $summary[3]['kadar_air']."%" : "-" ;?></center></td>
              <td><center><?= !empty($summary[4]['kadar_air']) ? $summary[4]['kadar_air']."%" : "-" ;?></center></td>
              <td><center><?= !empty($summary[5]['kadar_air']) ? $summary[5]['kadar_air']."%" : "-" ;?></center></td>  

            </tr>
            <tr>
              <td><center>Jumlah Bentangan</center></td>
              <td><center><?= !empty($summary[0]['jumlah_bentangan']) ? $summary[0]['jumlah_bentangan']."m" : "-" ;?></center></td>
              <td><center><?= !empty($summary[1]['jumlah_bentangan']) ? $summary[1]['jumlah_bentangan']."m" : "-" ;?></center></td>
              <td><center><?= !empty($summary[2]['jumlah_bentangan']) ? $summary[2]['jumlah_bentangan']."m" : "-" ;?></center></td>
              <td><center><?= !empty($summary[3]['jumlah_bentangan']) ? $summary[3]['jumlah_bentangan']."m" : "-" ;?></center></td>
              <td><center><?= !empty($summary[4]['jumlah_bentangan']) ? $summary[4]['jumlah_bentangan']."m" : "-" ;?></center></td>
              <td><center><?= !empty($summary[5]['jumlah_bentangan']) ? $summary[5]['jumlah_bentangan']."m" : "-" ;?></center></td>  

            </tr>
            <!-- <tr>
              <td><center>Aksi</center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=1" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=2" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=3" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=4" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=5" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=6" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center></td>
            </tr> -->
          </tbody>
        </table>