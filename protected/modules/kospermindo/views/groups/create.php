<ol class="breadcrumb bc-3">
  <li>
    <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Teras</a>
  </li>
  <li>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/groups">Groups</a>
  </li>
  <li class="active">
    <strong><?php echo 'Create'; ?></strong>
  </li>
</ol>
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Tambah Kelompok</h2>
        <div class="row">
          <?php echo $this->renderPartial('_form',
            array('model_kelompok' => $model_kelompok, 'model' => $model, 'pesan' => $pesan, 'update' => $update));
          ?>
        </div>
      </div>
    </div>
  </div>
</div>