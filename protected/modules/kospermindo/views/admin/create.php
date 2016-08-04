<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Tambah Admin Pengguna</h2>
        <div class="row">
          <?php echo $this->renderPartial('_form',
            array('userModel' => $model, 'pesan' => $pesan,'profileModel'=>$profile));
          ?>
        </div>
      </div>
    </div>
  </div>
</div>