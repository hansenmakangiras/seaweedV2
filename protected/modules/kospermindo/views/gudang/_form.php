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
  <div class="panel panel-default">
    <div class="panel-title">

    </div>
    <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'gudang-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal validate',
        ),
      )); ?>
      <div class="form-group">
        <div class="col-md-12">
          <h4><b>Informasi Dasar</b></h4>
          <hr>
        </div>

        <div class="col-md-6">
          <?php echo $form->textField($model, 'nama',
            array('class' => 'form-control input-lg', 'placeholder' => 'Nama Gudang', 'data-validate' => 'required')); ?>
          <br>
        </div>

        <div class="col-md-6">
          <?php echo $form->textField($model, 'koordinator',
            array('class' => 'form-control input-lg', 'placeholder' => 'Penanggungjawab Gudang', 'data-validate' => 'required')); ?>
          <br>
        </div>

        <div class="col-md-6">
          <?php echo $form->textField($model, 'telp',
            array('type' => 'number','class' => 'form-control input-lg', 'placeholder' => 'Telepon / HP', 'data-validate' => 'required')); ?>
          <br>
        </div>

        <div class="col-md-6">
          <div class="input-group">
            <?php echo $form->textField($model, 'luas',
              array('class' => 'form-control input-lg', 'type' => 'number','placeholder' => 'Luas Gudang', 'data-validate' => 'required')); ?>
            <span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
          </div>
          <br>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12">
          <h4><b>Lokasi Gudang</b></h4>
          <hr>
          <?php echo $form->textField($model, 'alamat',
            array('class' => 'form-control input-lg', 'placeholder' => 'Alamat Gudang', 'data-validate' => 'required')); ?>
          <br>
          <?php echo $form->dropDownList($model, 'provinsi', Provinsi::model()->getProvinsi(),
            array('class' => 'form-control input-lg','data-validate' => 'required')); ?>
          <br>
          <?php echo $form->dropDownList($model, 'kabupaten', Kotakab::model()->getKabupaten(),
            array('class' => 'form-control input-lg','data-validate' => 'required')); ?>
          <br>
          <hr/>
          <div class="form-group">
            <div class="col-sm-3 col-sm-offset-5">
              <button type="submit" class="btn btn-success btn-lg"><i class="entypo-pencil"></i> Sunting</button>
            </div>
          </div>
        </div>

        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
  <?php
    Yii::app()->clientScript->registerScript('closeAlert', '
    var alertGagal = $(".alert-danger");
    var alertSukses = $(".alert-success");
      setTimeout(function () {
          alertGagal.addClass("hide","slow");
          alertSukses.addClass("hide","slow");
      }, 5000);
      
    $("#Gudang_provinsi").on("change", function(){
      $.ajax({
          type: "POST",
          url: "/kospermindo/gudang/getkota",
          data:{
              "prov" : $("#Gudang_provinsi").val()
          },
          success: function(data){
              var msg = $.parseJSON(data);
              $("#Gudang_kabupaten").empty();
              $.each(msg, function(i, v){
                  $("#Gudang_kabupaten").append("<option value=\""+ v.kota_id +"\">"+ v.kokab_nama +"</option>");
              });
          }
      });
    });
  ', CClientScript::POS_END);
  ?>

