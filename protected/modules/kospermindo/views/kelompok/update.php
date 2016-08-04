<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/kelompok">Gudang</a>
  </li>
    <li class="active">
      <strong><?php echo 'Update'; ?></strong>
    </li>
  </ol>
  <h2>Sunting Data Kelompok</h2><br/>
</div>

<div class="row">
  <?php echo $this->renderPartial('_form', array(
    'pesan'             => $pesan,
    'namaGudang' => isset($namaGudang) ? $namaGudang : array(),
    'model_kelompok' => isset($model_kelompok) ? $model_kelompok : array()
  )); ?>
</div>