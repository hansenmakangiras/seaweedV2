<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 2:37 PM
   */
  Yii::app()->clientScript->registerScript('search', "
    var element = $('#main-menu li[data-nav=\"report\"]');
    element.addClass('active opened');
    element.find('ul').addClass('visible').removeAttr('style');
    element.find('ul').find('li:nth-child(2)').addClass('active');
");
?>
<div class="profile-env">

  <header class="row">

    <div class="col-sm-2">

      <a href="#" class="profile-picture">
        <img src="<?= $this->baseUrl?>/static/admin/images/profile-picture.png" class="img-responsive img-circle" />
      </a>

    </div>

    <div class="col-sm-9">

      <ul class="profile-info-sections">
        <li>
          <div class="profile-name">
            <strong>
              <a href="#"><?= $isFarmer['nama_petani']; ?></a>
              <a href="#" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
              <!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->						</strong>
            <span><a href="#">Petani Rumput Laut</a></span>
          </div>
        </li>

        <!-- <li>
          <div class="profile-stat">
            <h3><?= !empty($total[0]['kadar_air']) ? $total[0]['kadar_air'].' %' : '0'; ?></h3>
            <span><a href="#">Kadar Air</a></span>
          </div>
        </li> -->

        <li>
          <div class="profile-stat">
            <h3><?= !empty($isFarmer['jumlah_bentangan']) ?  $isFarmer['jumlah_bentangan'].' m' : '0'; ?></h3>
            <span><a href="#">Jumlah Bentangan</a></span>
          </div>
        </li>
        <li>
          <div class="profile-stat">
            <h3><?= !empty($total[0]['total_panen']) ? $total[0]['total_panen'].' Ton' : '0'; ?></h3>
            <span><a href="#">Total Panen</a></span>
          </div>
        </li>
        <li>
          <div class="profile-stat">
            <h3><?= !empty($isFarmer['luas_lokasi']) ? $isFarmer['luas_lokasi'].' m' : '0'; ?></h3>
            <span><a href="#">Luas Lokasi</a></span>
          </div>
        </li>
      </ul>

    </div>
    <br/>

    <!-- <div class="col-sm-3">

      <div class="profile-buttons">
        <a href="#" class="btn btn-default">
          <i class="entypo-user-add"></i>
          Follow
        </a>

        <a href="#" class="btn btn-default">
          <i class="entypo-mail"></i>
        </a>
      </div>
    </div> -->

  </header>

  <section class="profile-info-tabs">

    <div class="row">

      <div class="col-sm-offset-2 col-sm-10">

        <ul class="user-details">

          <li>
            <a href="#">
              <i class="entypo-vcard"></i>
              <?= $isFarmer['nmr_identitas']; ?>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="entypo-calendar"></i>
              <?= $isFarmer['tempat_lahir']; ?> , <?= Helper::DateToIndo($isFarmer['tanggal_lahir']); ?>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="entypo-phone"></i>
              <?= $isFarmer['no_telp']; ?>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="entypo-location"></i>
              <?= $isFarmer['alamat']; ?>
            </a>
          </li>

        </ul>

      </div>

    </div>

  </section>
</div>
<a type="button" class="btn btn-primary btn-icon" href="<?= $this->baseUrl; ?>/kospermindo/report/cetak_komoditi?id=<?= strtolower($isFarmer->id); ?>" target="_blank">
            Cetak
            <i class="entypo-print"></i>
          </a>
          <br/>
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
<br/>
<br/>