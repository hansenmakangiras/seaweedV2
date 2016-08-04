<div class="mail-env">

  <!-- compose new email button -->
  <?php $this->renderPartial('link') ?>

  <!-- Mail Body -->
  <?php
    if (isset($view)) {
      $this->renderPartial($view, array('model' => $model, "totaldata" => isset($totaldata) ? $totaldata : 0, 'tags' => $tags));
    } else {
      $this->renderPartial('_content', array("model" => $model,"totaldata" => isset($totaldata) ? $totaldata : 0 ,'tags' => $tags));
    }
  ?>

  <!-- Sidebar -->
  <div class="mail-sidebar">
    <?php $this->renderPartial('_menu', array("model" => $model, 'tags' => $tags)); ?>
  </div>

</div>
<?php
  Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-mailbox.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-messages.js',CClientScript::POS_END);
?>