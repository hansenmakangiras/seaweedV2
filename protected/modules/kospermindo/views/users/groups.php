<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 2:37 PM
   */
  Yii::app()->clientScript->registerScript('search', "
    var element = $('#main-menu li[data-nav=\"manage-user\"]');
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
      <strong><?php echo 'Manajemen Ketua Kelompok'; ?></strong>
    </li>
  </ol>
  <h2>Manajemen Ketua Kelompok</h2><br/>
</div>

<div class="row">
  
    <div class="col-md-8">
    <div id="pesan" class="row">
        <div class="col-md-8">
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
        <table id="tblkelompok" class="table table-responsive table-hover table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Lokasi</th>
              <th>Nama Kelompok</th>
              <th>Ketua Kelompok</th>
              <th width="200px">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($data->getData())) { $j=1; ?>
          <?php foreach($data->getData() as $value) { ?>
            <tr>
            <?php if($value->status==1) { ?>
              
              <td class="text-center"><?= $j;?></td>
              <td><?= TabelKelompok::model()->getLokasiGudang($value->idgudang); ?></td>  
              <td><?= $value->nama_kelompok; ?></td>
              <td><?= !empty($value->ketua_kelompok) ? $value->ketua_kelompok : "Belum Ada Ketua Kelompok";?></td>
              <td>
                <a class="btn btn-default btn-sm btn-icon icon-left" href="<?= $this->baseUrl; ?>/kospermindo/users/update?id=<?= strtolower($value['id']); ?>"><i class="entypo-pencil"></i>Sunting</a>
              </td>
            <?php }$j++; ?>    
            </tr>
          <?php } ?>
          <?php } else { ?>
            <td colspan = "3">Tidak ada hasil ditemukan</td>
          <?php } ?>
          </tbody>
        </table>
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