<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>/warehouse">Data Gudang</a>
    </li>
    <li class="active">
      <strong><?php echo 'Tambah Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Tambah Gudang</h2><br/>
</div>
<div class="content-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-5">
        <br>
        <div class="row">
          <?php echo $this->renderPartial('_form', array(
            'model_koordinator' => $model_koordinator,
            'model'             => $model,
            'pesan'             => $pesan,
            'update'            => $update,
          )); ?>
        </div>
      </div>
    </div>
  </div>
</div>