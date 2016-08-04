<?php
  Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"petani\"]');
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
        <strong><?php echo 'Daftar Petani'; ?></strong>
      </li>
    </ol>
    <h2>Daftar Petani</h2><br/>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div id="pesan" class="row">
        <div class="col-md-6">
          <?php if (Yii::app()->user->hasFlash('success')) { ?>
            <div class="alert alert-success">
              <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?></strong>
            </div>
          <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
            <div class="alert alert-danger">
              <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('error')); ?></strong>
            </div>
          <?php } else { ?>
            <div></div>
          <?php } ?>
        </div>
      </div>

      <a href="<?php echo $this->baseUrl; ?>/kospermindo/petani/tambah" class="btn btn-info btn-lg"
         id="<?php if ($pesan === 'gagal') {
           echo "add";
         } ?>">+ &nbsp;Tambah</a>

      <br>
      <br>

      <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
          <th>Nama Petani</th>
          <th>Jenis Komoditi</th>
          <th>Jabatan</th>
          <th width="15%">Luas Lokasi</th>
          <th width="15%">Panjang Bentangan</th>
          <th width="200px">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($data->getData())) { ?>
          <?php foreach ($data->getData() as $value) { ?>

            <tr style="cursor: pointer">
              <?php if ($value['status'] == 1) { ?>

                <td><?= $value['nama_petani']; ?></td>
                <td><?php
                    $jenisKomoditi = explode(",", $value['jenis_komoditi']);
                    for ($i = 0; $i < count($jenisKomoditi); $i++) {
                      if ($jenisKomoditi[$i] == '1') {
                        echo "Gracillaria KW 3";
                        echo "<br/>";
                      }
                      if ($jenisKomoditi[$i] == '2') {
                        echo "Gracillaria KW 4";
                        echo "<br/>";
                      }
                      if ($jenisKomoditi[$i] == '3') {
                        echo "Gracillaria BS";
                        echo "<br/>";
                      }
                      if ($jenisKomoditi[$i] == '4') {
                        echo "Sango-Sango Laut";
                        echo "<br/>";
                      }
                      if ($jenisKomoditi[$i] == '5') {
                        echo "Euchema Cotoni";
                        echo "<br/>";
                      }
                      if ($jenisKomoditi[$i] == '6') {
                        echo "Spinosom";
                        echo "<br/>";
                      }
                    }
                  ?></td>
                <td><?= TabelPetani::model()->getJabatanPetani($value['id_user']); ?></td>
                <td><?= $value['luas_lokasi']; ?></td>
                <td><?= $value['jumlah_bentangan']; ?></td>
                <td>
                  <a class="btn btn-default btn-sm btn-icon icon-left"
                     href="<?= $this->baseUrl; ?>/kospermindo/petani/ubah?id=<?= $value['id']; ?>"><i
                      class="entypo-pencil"></i>Sunting</a>&nbsp;
                  <a href="#" data-record-id="<?= $value['id']; ?>" data-record-title="Konfirmasi"
                     data-href="<?php echo $this->baseUrl; ?>/kospermindo/petani/hapus"
                     data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
                     data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus<i
                      class="entypo-cancel"></i></a>
                </td>

              <?php } ?>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <td colspan="5">Tidak ada hasil ditemukan</td>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-12">
    <?php //Helper::dd($data->totalItemCount);
      $pages = $data->pagination;
      $this->widget('CLinkPager', array(
        'pages'                => $pages,
        'maxButtonCount'       => 30,
        'pageSize'             => 10,
        'itemCount'            => (int)$data->totalItemCount,
        'htmlOptions'          => array('class' => 'pagination pagination-custom'),
        'hiddenPageCssClass'   => '',
        //'firstPageCssClass' => 'active',
        //'lastPageCssClass' => 'active',
        'selectedPageCssClass' => 'active',
        //'currentPage'       => '1',
        'header'               => '',
        'nextPageLabel'        => 'Berikutnya',
        'prevPageLabel'        => 'Sebelumnya',
        'lastPageLabel'        => 'Akhir',
        'firstPageLabel'       => 'Awal',
      ));
    ?>
  </div>
  <script>
    var baseurl;
    var pesan = '<?php $pesan ?>';
  </script>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
  setTimeout(function () {
    $("#pesan").addClass("hidden");
  }, 5000); 
   $("#add").click(function (e) {
      toastr.error("Tambahkan Data Kelompok Terlebih Dahulu !!!", pesan);
      e.preventDefault();
   });
  ', CClientScript::POS_END);
?>