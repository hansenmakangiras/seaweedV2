<div class="mail-header">
  <!-- title -->
  <div class="mail-title">
    <!--        <i class="entypo-pencil"></i>-->
    <?php echo (isset($id) && $id === 'reply') ? 'Kirim Ulang Pesan' : 'Buat Pesan Baru'; ?>
  </div>

  <!-- links -->
  <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'message-form',
    'enableAjaxValidation' => false,
    'htmlOptions'          => array(
      'role' => 'form',
    ),
    'method'               => 'POST',
  )); ?>
  <div class="mail-links">
    <a href="#" class="btn btn-sm btn-default">
      <i class="entypo-cancel"></i>
    </a>
    <a href="#" class="btn btn-sm btn-default">
      Draft
      <i class="entypo-tag"></i>
    </a>
    <button type="submit" class="btn btn-success btn-sm">
      Kirim
      <i class="entypo-mail"></i>
    </button>
  </div>
</div>
<div class="mail-compose">
  <div class="row">
    <div id="" class="col-md-4">
      <?php echo $form->dropDownList($model, 'kode_gudang', Gudang::model()->getGudang(),
        array(
          'empty' => 'Pilih Gudang',
          'class' => 'select2',
          'data-allow-clear' => true,
          'id' =>'gudang',
          'data-id' => $model->kode_gudang,
          'data-placeholder' => 'Pilih Gudang'
        )); ?>
    </div>
    <div class="col-md-4">
      <?php echo $form->dropDownList($model, 'kode_kelompok', Kelompok::model()->getListKelompok(),
        array(
          'empty' => 'Pilih Kelompok',
          'class' => 'form-control',
          'style' => 'height:40px;',
          'id' => 'kelompok',
          'data-placeholder' => 'Pilih Kelompok'
        ));
      ?>
    </div>
    <div class="col-md-4">
      <?php echo $form->dropDownList($model, 'to', Petani::model()->getnamapetani(), array(
        'empty' => 'Pilih Petani',
        'class'       => 'select2',
        'placeholder' => 'Ditujukan kepada...',
        'style' => 'height:40px;',
        'id' => 'petani',
        //'multiple'    => 'multiple',
      )); ?>
    </div>
  </div>
  <div class="compose-message-editor">
    <?php echo $form->textArea($model, 'content', array(
      'class'               => 'form-control wysihtml5',
      'placeholder'         => 'Masukkan pesan...',
      'data-stylesheet-url' => $this->baseUrl . '/static/admin/css/wysihtml5-color.css',
      'id'                  => 'sample_wysiwyg',
    )); ?>
  </div>
  <?php $this->endWidget(); ?>
</div>

<?php
  Yii::app()->clientScript->registerScript('selection', '
//	$("#gudang").on("change", function(){
//	  var postGudang = $.post("/kospermindo/message/getkelompok", { "id" : $("#gudang").val()});
//    postGudang.success(function(data){
//      msg = $.parseJSON(data);
//      $("#kelompok").empty();
//      $("#kelompok").end();
//      $("#petani").empty();
//      $("#petani").end();
//      
//      $.each(msg, function(i, v){
//        $("#kelompok").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
//      });
      
//      var postPetani = $.post("/kospermindo/message/getpetani", {
//        "id_gudang" : $("#gudang").val(),
//        "id_kelompok" : $("#kelompok").val()
//      });
//      postPetani.success(function(data){
//        msg = $.parseJSON(data);
//        $("#petani").empty();
//        $("#petani").end();
//        $.each(msg, function(i, v){
//            $("#petani").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
//        });
//      });
//      var postToPetani = $.post("/kospermindo/message/setpetani", {
//        "id_gudang" : $("#gudang").val(),
//        "id_kelompok" : $("#kelompok").val(),
//        "id_petani" : $("#petani").val(),
//      });
//      postToPetani.success(function(data){
//        msg = $.parseJSON(data);
//        //window.location.reload(true);
//      });
//    });
//  });
//  
//  $("#kelompok").on("change", function(){
//    var petani = $.post("/kospermindo/message/getpetani", {
//      "id_gudang" : $("#gudang").val(),
//      "id_kelompok" : $("#kelompok").val()
//    });
//    petani.success(function(data){
//      msg = $.parseJSON(data);
//      //console.log(msg);
//        $("#petani").empty();
//        $("#petani").end();
//        $.each(msg, function(i, v){
//          $("#petani").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
//        });
//      var postPetani = $.post("/kospermindo/message/setpetani",{
//        "id_gudang" : $("#gudang").val(),
//        "id_kelompok" : $("#kelompok").val(),
//        "id_petani" : $("#petani").val(),
//      });
//      postPetani.success(function(){
//        msg = $.parseJSON(data);
//        console.log(msg);
//        //window.location.reload(true);
//      });
//    }); 
//  });
//    
//  $("#petani").on("change", function(){
//    var getPetani = $.post("/kospermindo/message/setpetani", {
//      "id_gudang" : $("#gudang").val(),
//      "id_kelompok" : $("#kelompok").val(),
//      "id_petani" : $("#petani").val(),
//    });
//    getPetani.success(function(data){
//      msg = $.parseJSON(data);
////      window.location.reload(true);
//    });
//  });   
    
	', CClientScript::POS_END);
?>
