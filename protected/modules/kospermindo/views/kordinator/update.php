<div class="content-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Tambah Data Koordinator</h2>
        <div class="row">
          <?php echo $this->renderPartial('_form', array(
            'model_koordinator' => $model_koordinator,
            'pesan'             => $pesan,
            'model'             => $model,
            'update'            => $update
            // 'idgudang'          => $idgudang,
            // 'idkoordinator'     => $idkoordinator,
          )); ?>
        </div>
      </div>
    </div>
  </div>
</div>