<?php
  $controllerid = $this->id;
  $actionid = $this->action->id;
?>
  <div class="headline">
    <ol class="breadcrumb bc-3">
      <li>
        <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
      </li>
      <?php  if($controllerid === 'message' && $actionid === 'index'){ ?>
        <li class="active">
          <strong><?php echo 'Pesan'; ?></strong>
        </li>
      <?php } elseif ($controllerid === 'message' && $actionid === 'create'){ ?>
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>/message">Pesan</a>
        </li>
        <li class="active">
          <strong><?php echo 'Buat Pesan'; ?></strong>
        </li>
      <?php } elseif ($controllerid === 'message' && $actionid === 'sent'){ ?>
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>/message">Pesan</a>
        </li>
        <li class="active">
          <strong><?php echo 'Pesan Terkirim'; ?></strong>
        </li>
      <?php } elseif ($controllerid === 'message' && $actionid === 'draft'){ ?>
        <li>
          <a href="<?= Kospermindo::getBaseUrl(); ?>/message">Pesan</a>
        </li>
        <li class="active">
          <strong><?php echo 'Pesan Tersimpan'; ?></strong>
        </li>
      <?php } ?>

    </ol>
    <?php  if($controllerid === 'message' && $actionid === 'index'){ ?>
      <h2>Pesan</h2><br/>
    <?php } elseif ($controllerid === 'message' && $actionid === 'create'){ ?>
      <h2>Kirim Pesan</h2><br/>
    <?php } elseif ($controllerid === 'message' && $actionid === 'sent'){ ?>
      <h2>Pesan Terkirim</h2><br/>
    <?php } elseif ($controllerid === 'message' && $actionid === 'draft'){ ?>
      <h2>Pesan Tersimpan</h2><br/>
    <?php } ?>
  </div><hr />

  <div class="mail-env">

    <!-- compose new email button -->
    <?php $this->renderPartial('link') ?>

    <!-- Mail Body -->
    <?php
      if (isset($view)) {
        $this->renderPartial($view, array('model' => $model, "totaldata" => isset($totaldata) ? $totaldata : 0));
      } else {
        $this->renderPartial('_content', array("model" => $model,"totaldata" => isset($totaldata) ? $totaldata : 0));
      }
    ?>

    <!-- Sidebar -->
    <div class="mail-sidebar">
      <?php $this->renderPartial('_menu', array("model" => $model)); ?>
    </div>

  </div>

<?php
  Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-mailbox.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-messages.js',CClientScript::POS_END);
?>