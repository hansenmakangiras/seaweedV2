<?php if($alert == 2) { ?>
    <div class="headline">
      <ol class="breadcrumb bc-3">
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
        </li>
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Manajemen Ketua Kelompok</a>
        </li>
        <li class="active">
          <strong><?php echo 'Update'; ?></strong>
        </li>
      </ol>
      <h2>Sunting Ketua Kelompok</h2><br/>
    </div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php echo $this->renderPartial('_form', array('model_kelompok'=>$model_kelompok,'pesan' => $pesan,'alert'=>$alert)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }elseif($alert == 1 ) { ?>
    <div class="headline">
      <ol class="breadcrumb bc-3">
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
        </li>
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Manajemen Moderator</a>
        </li>
        <li class="active">
          <strong><?php echo 'Update'; ?></strong>
        </li>
      </ol>
      <h2>Sunting Moderator</h2><br/>
    </div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                    <?php echo $this->renderPartial('_form', array('alert'=>$alert)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }elseif ($alert==4) { ?>
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
          <a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Manajemen Komoditi</a>
        </li>
        <li class="active">
          <strong><?php echo 'Update'; ?></strong>
        </li>
      </ol>
      <h2>Sunting Data Komoditi</h2><br/>
    </div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                    <?php echo $this->renderPartial('_form', array('alert'=>$alert,'komoditi'=>$komoditi,'pesan'=>$pesan)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>