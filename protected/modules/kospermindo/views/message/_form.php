<div class="mail-header">
  <!-- title -->
  <div class="mail-title">
    <!--        <i class="entypo-pencil"></i>-->
    Buat Pesan Baru
  </div>

  <!-- links -->
  <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'message-form',
    'enableAjaxValidation' => false,
    'htmlOptions'          => array(
      'role' => 'form',
    ),
    'method' => 'POST',
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
  <div class="form-group">
    <label for="to">Kepada:</label>
    <input type="text" name="Messages[to]" class="form-control" id="to" tabindex="1"/>
  </div>
  <div class="compose-message-editor">
    <!--    <textarea class="form-control wysihtml5" data-stylesheet-url="-->
    <?php //$this->baseUrl;?><!--/static/admin/css/wysihtml5-color.css" name="Messages[content]" id="sample_wysiwyg"></textarea>-->
    <textarea placeholder="Masukkan pesan.." class="form-control" name="Messages[content]"></textarea>
  </div>
  <?php $this->endWidget(); ?>
</div>

<?php
  Yii::app()->clientScript->registerScript('autoComplete','
    
  ', CClientScript::POS_END);
?>
