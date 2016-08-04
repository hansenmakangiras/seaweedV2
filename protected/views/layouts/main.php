<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->renderPartial('/layouts/partials/meta');?>
</head>
<body class="bg">

<?php $this->renderPartial('/layouts/partials/header');?>

<?php echo $content; ?>

<?php $this->renderPartial('/layouts/partials/footer');?>

</body>
</html>