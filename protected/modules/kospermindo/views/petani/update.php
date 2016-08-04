<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Petani</a>
    </li>
    <li class="active">
      <strong><?php echo 'Sunting'; ?></strong>
    </li>
  </ol>
  <h2>Sunting Data Petani</h2><br/>
</div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <?php echo $this->renderPartial('_form', array(
            'model_petani' => $model_petani,
            'pesan'        => $pesan,
//            'model'        => $model,
            'update'       => $update
          )); ?>
        </div>
      </div>
    </div>
  </div>
</div>