<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->renderPartial('/layouts/partials/header-singlepage'); ?>
</head>

<body class="page-body login-page login-form-fall" data-url="<?= Kospermindo::getBaseUrl(); ?>">
<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
  var baseurl = '';
</script>
<div class="login-container">
  <?php echo $content; ?>
</div>
<?php $this->renderPartial('/layouts/partials/footer-singlepage');?>
</body>
</html>
