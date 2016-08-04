<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Data Kelompok'; ?></strong>
    </li>
  </ol>
  <h2>Data Kelompok</h2><br/>
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
    <div class="row">
      <div class="col-md-12">
        <?php $this->renderPartial('form', array(
          'namaGudang' => isset($namaGudang) ? $namaGudang : "",
          'model_kelompok' => isset($model_kelompok) ? $model_kelompok : ""
        )); ?>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-md-12">
        <table id="tblkelompok" class="table table-responsive table-hover table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th class="text-center" width="5%">No</th>
            <th class="text-center">Lokasi Gudang</th>
            <th class="text-center">Nama Kelompok</th>
            <th class="text-center" width="200px">Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php //Helper::dd($data->getSort())?>
          <?php if (!empty($data->getData())) { ?>
            <?php foreach ($data->getData() as $value) { ?>
              <tr>
                <?php if ($value->status == 1) { ?>
                  <td><?= $value->id; ?></td>
                  <td><?= TabelKelompok::model()->getLokasiGudang($value->idgudang); ?></td>
                  <td><?= $value->nama_kelompok; ?></td>
                  <!--<td><?php echo ($value->status !== 0) ? 'Aktif' : 'Non Aktif'; ?></td> -->
                  <td>
                    <a id="btnSunting" class="btn btn-default btn-sm btn-icon icon-left"
                       href="<?php echo $this->baseUrl; ?>/kospermindo/kelompok/ubah?id=<?php echo strtolower($value['id']); ?>"><i
                        class="entypo-pencil"></i>Sunting
                    </a>
<!--                    <a id="btnSunting" class="btn btn-default btn-sm btn-icon icon-left"-->
<!--                       href="#" data-kelompok="--><?php //echo $value->nama_kelompok; ?><!--" data-href = "/kospermindo/kelompok?id=--><?php //echo $value->id ?><!--"><i class="entypo-pencil"></i>Sunting-->
<!--                    </a>-->
                    <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Konfirmasi"
                       data-href="<?php echo $this->baseUrl; ?>/kospermindo/kelompok/hapus"
                       data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
                       data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
                        class="entypo-trash"></i>
                    </a>
<!--                    <a class="btn btn-success btn-sm btn-icon icon-left"-->
<!--                       href="--><?php //= $this->baseUrl; ?><!--/kospermindo/kelompok/detail?id=--><?php //= strtolower($value['idgudang']); ?><!--"><i-->
<!--                        class="entypo-vcard"></i>Detail-->
<!--                    </a>-->
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <td colspan="3">Tidak ada hasil ditemukan</td>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php
        $pages = $data->getPagination();
        $this->widget('CLinkPager', array(
          'pages'             => $pages,
          'maxButtonCount' => 30,
          'pageSize'          => 10,
          'itemCount' => (int) $data->totalItemCount,
          'htmlOptions'       => array('class' => 'pagination pagination-custom'),
          'hiddenPageCssClass' => '',
          //'firstPageCssClass' => 'active',
          //'lastPageCssClass' => 'active',
          'selectedPageCssClass' => 'active',
          //'currentPage'       => '1',
          'header' => '',
          'nextPageLabel'     => 'Berikutnya',
          'prevPageLabel'     => 'Sebelumnya',
          'lastPageLabel'     => 'Akhir',
          'firstPageLabel'     => 'Awal',
        ));
      ?>
    </div>
  </div>
</div>
<script>
  var baseurl;
  var pesan = '<?php $pesan ?>';
  var kelompok = '<?php $data->getData(); ?>';
</script>
<?php
  Yii::app()->clientScript->registerScript('showNotif', '
     setTimeout(function () {
        $("#pesan").addClass("hidden");
     }, 5000); 

    $("#add").click(function (e) {
      toastr.error("Anda Harus Menambahkan Data Gudang Terlebih Dahulu!!!", pesan);
      e.preventDefault();
    });
   
    $("#btnSunting").click(function(){
           
    });
  ');
?>
