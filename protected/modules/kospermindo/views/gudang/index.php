<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Data Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Manajemen Data Gudang</h2><br/>
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
        <?php }else{ ?>
          <div></div>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="/kospermindo/gudang" method="POST" class="form-horizontal validate">
          <div class="form-group">
            <div class="col-md-6">
              <input id="lokasi" type="text" placeholder="Lokasi Gudang" name="lokasi" class="form-control input-lg" data-validate="required">
            </div>
            <div class="col-md-6">
              <button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-8">
        <table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
          <thead>
          <tr>
            <th class="text-center" width="5%">No</th>
            <th class="text-center">Lokasi Gudang</th>
<!--            <th class="text-center">Deskripsi</th>-->
<!--            <th class="text-center" width="15%">Jumlah Stok</th>-->
            <th class="text-center" width="200px">Aksi</th>
            <!-- <th width="20%">Action</th> -->
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($data->getdata())) { ?>
            <?php foreach ($data->getData() as $key => $value) { ?>
              <tr>
                <?php if ($value['status'] == 1) { ?>
                  <td class="text-center"><?= $value['id']; ?></td>
                  <td><?= $value['lokasi']; ?></td>
<!--                  <td>--><?//= $value['deskripsi']; ?><!--</td>-->
<!--                  <td class="text-center">--><?//= Helper::_format_number(isset($value['jumlah_stok']) ? $value['jumlah_stok']." Ton": 0,true); ?><!--</td>-->
                  <td>
                    <a class="btn btn-default btn-sm btn-icon icon-left"
                       href="<?= Yii::app()->createUrl('/kospermindo/gudang/ubah',array('id' => strtolower($value['id']))) ; ?>"><i
                        class="entypo-pencil"></i>Sunting</a>
                    <a href="#" data-record-id="<?= $value['id']; ?>" data-record-title="Konfirmasi"
                       data-href="<?php echo $this->baseUrl; ?>/kospermindo/gudang/hapus"
                       data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
                       data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
                        class="entypo-trash"></i>
                    </a>
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <td colspan="2">Tidak ada hasil ditemukan</td>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12 center">
    <?php
      $pages = $data->pagination;
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
<script>
  var baseurl;
</script>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
  setTimeout(function () {
    $("#pesan").addClass("hidden");
  }, 5000); 
   
  ', CClientScript::POS_END);
?>