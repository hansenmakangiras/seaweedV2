<div class="content-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Add Seaweed</h2>
        <div class="row">
          <?php echo $this->renderPartial('_form', array(
            'model'=>$model_komoditi,
            'model_komoditi_tipe' => $model_komoditi_tipe,
            'idKomoditi' => $idkomoditi,
            'pesan' => $pesan,
            'modelSubType' => $modelSubType
          ));
          ?>
        </div>
      </div>
    </div>
  </div>
</div>