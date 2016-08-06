<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/gudang">Data Gudang</a>
    </li>
    <li class="active">
      <strong><?php echo 'Tambah Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Tambah Gudang</h2><br/>
</div>
<div class="row">
  <?php echo $this->renderPartial('_form', array(
    'model'             => $model,
    'provinsi'             => $provinsi,
    'kabupaten'             => $kabupaten,
  )); ?>
</div>
