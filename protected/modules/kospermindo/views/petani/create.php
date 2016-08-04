<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/petani">Petani</a>
    </li>
    <li class="active">
      <strong><?php echo 'Tambah Petani'; ?></strong>
    </li>
  </ol>

  <h2>Tambah Petani</h2><br/>
</div>
<div class="content-wrapper">
  <?php echo $this->renderPartial('_form', array(
    'model_petani' => $model_petani,
    'model'        => $model,
    'pesan'        => $pesan,
    'model_gudang' => $model_gudang,
    'update'       => $update,
  )); ?>
