<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <?php $this->renderPartial('/layouts/partials/meta'); ?>
</head>

<body class="page-body login-page login-form-fall" data-url="<?= $this->baseUrl; ?>">
<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
  var baseurl = '';
</script>
<div class="login-container">
  <?php echo $content; ?>
</div>
<?php $this->renderPartial('/layouts/partials/footer-singlepage');?>
<?php //$this->renderPartial('/layouts/partials/script');?>
</body>
</html>
