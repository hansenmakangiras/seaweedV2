<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/gudang">Gudang</a>
    </li>
    <li class="active">
      <strong><?php echo 'Update'; ?></strong>
    </li>
  </ol>
  <h2>Sunting Data Gudang</h2><br/>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="row">
      <?php echo $this->renderPartial('_form', array(
        'model_koordinator' => $model_koordinator,
        'pesan'             => $pesan,
        // 'model'             => $model,
        // 'update'            => $update
        // 'idgudang'          => $idgudang,
        // 'idkoordinator'     => $idkoordinator,
      )); ?>
    </div>
  </div>
</div>