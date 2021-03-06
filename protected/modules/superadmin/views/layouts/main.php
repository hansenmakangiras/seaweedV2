<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->renderPartial('/layouts/partials/meta'); ?>
</head>

<body class="page-body page-fade-only skin-blue" data-url="<?php echo SAdmin::getBaseUrl(); ?>">
<script type="text/javascript">
	var baseurl = '';
</script>
	<div class="page-container">
		<div class="sidebar-menu">
			<?php $this->renderPartial('/layouts/partials/header'); ?>
			<?php $this->renderPartial('/layouts/partials/sidebar'); ?>
		</div>
		<div class="main-content">
			<?php $this->renderPartial('/layouts/partials/navbar'); ?>
			<?php echo $content; ?>
			<?php $this->renderPartial('/layouts/partials/footer'); ?>
		</div>
	</div>
<?php $this->renderPartial('/layouts/partials/script'); ?>
<?php $this->renderPartial('/modal/modal'); ?>
	<div id="modal-view"></div>
</body>
</html>
