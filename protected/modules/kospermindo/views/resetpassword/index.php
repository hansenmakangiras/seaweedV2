<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Ubah Kata Sandi'; ?></strong>
    </li>
  </ol>
  <h2>Ubah Kata Sandi</h2><br/>
</div>

<div class="col-md-12">
  <div id="pesan">
    <?php if ($error === 0) { ?>
      <div class="alert alert-success">
        <?= $pesan; ?>
      </div>
    <?php }elseif($error === 1){ ?>
      <div class="alert alert-danger">
        <?= $pesan; ?>
      </div>
    <?php }else{ ?>
      <div></div>
    <?php } ?>
  </div>

  <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'gudang-form',
    'enableAjaxValidation' => false,
    'htmlOptions'          => array(
      'class' => 'form-horizontal validate',
    ),
  )); ?>
  <div class="form-group">
    <label for="field-1" class="col-sm-3 control-label input-lg">Pengguna</label>
    <div class="col-md-5">
      <?php echo CHtml::dropDownList('Petani[id_user]','nama_petani', Petani::model()->getnamapetani(),
        array('class' => 'form-control input-lg','data-validate' => 'required')); ?>
    </div>
  </div>
<!--  <div class="form-group">-->
<!--    <label for="field-1" class="col-sm-3 control-label input-lg">Kata Sandi Lama</label>-->
<!--    <div class="col-md-5">-->
<!--      --><?php //echo $form->passwordField($model, 'oldPassword',
//        array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan kata sandi lama anda', 'data-validate' => 'required, password')); ?>
<!--    </div>-->
<!--  </div>-->
  <div class="form-group">
    <label for="field-2" class="col-sm-3 control-label input-lg">Kata sandi baru</label>
    <div class="col-md-5">
      <?php echo $form->passwordField($model, 'newPassword',
        array('class' => 'form-control input-lg', 'placeholder' => 'Masukkan kata sandi baru anda', 'data-validate' => 'required, password')); ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-5 col-md-offset-3">
      <button type="submit" class="btn btn-success btn-lg"><i class="entypo-pencil"></i> Ganti Password</button>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>



