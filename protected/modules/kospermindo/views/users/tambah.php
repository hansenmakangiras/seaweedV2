<?php
  Yii::app()->clientScript->registerScript('search', "
    var element = $('#main-menu li[data-nav=\"petani\"]');
    element.addClass('active opened');
    element.find('ul').addClass('visible').removeAttr('style');
    element.find('ul').find('li:nth-child(2)').addClass('active');
");
?>
<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Manajemen Pengguna</a>
    </li>
    <li class="active">
      <strong><?php echo 'Tambah Komoditi'; ?></strong>
    </li>
  </ol>
  <h2>Tambah Data Komoditi</h2><br/>
</div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                <?php echo $this->renderPartial('_formkomoditi', array('komoditi'=>$komoditi,'pesan' => $pesan,'gudang'=>$gudang,'kelompok'=>$kelompok,'petani'=>$petani)); ?>
                </div>
            </div>
        </div>
    </div>
</div>