<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->renderPartial('/layouts/partials/meta'); ?>
</head>

<body class="page-body page-fade-only" data-url="<?php echo SAdmin::getBaseUrl(); ?>">
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

    <?php $this->renderPartial('/modal/modal'); ?>

  </div>
<?php $this->renderPartial('/layouts/partials/script'); ?>
</body>
</html>
