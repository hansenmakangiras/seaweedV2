<?php
  $cs = Yii::app()->clientScript;
  $cs->coreScriptPosition = CClientScript::POS_END;
  $cs->scriptMap=array(
    'jquery.js'=>FALSE,
    'jquery.min.js'=>FALSE,
  );
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Neon Admin Panel" />
<meta name="author" content="" />

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="shortcut icon" href="<?php echo $this->baseUrl; ?>/static/admin/images/favicon-seaweed.png" type="image/x-icon" />

<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/bootstrap.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/neon-core.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/neon-theme.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/neon-forms.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/print.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/custom.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/rickshaw/rickshaw.min.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/css/skins/custom-color.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/select2/select2.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/select2/select2.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/selectboxit/jquery.selectBoxIt.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/icheck/skins/minimal/_all.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/icheck/skins/square/_all.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/icheck/skins/futurico/futurico.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/icheck/skins/polaris/polaris.css">
<link rel="stylesheet" href="<?= $this->baseUrl ?>/static/admin/js/wysihtml5/bootstrap-wysihtml5.css">

<!-- 
<style type="text/css">
	.modal-dialog {
		height: 100%;
	}
	.modal-content {
		position: absolute;
		width: 100%;
		top: 50vh;
		transform: translateY(-50%);
	}
</style> -->