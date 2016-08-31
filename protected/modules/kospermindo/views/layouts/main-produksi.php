<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<?php
		$this->renderPartial('/layouts/partials/meta');
	?>
</head>
<body>

	<!-- header -->
	<?php
	$this->renderPartial('/layouts/partials/header-singlepage');
	?>
	<!-- /header -->

	<!-- section -->
	<?php
	// $this->renderPartial('/layouts/partials/section');
	echo $content;
	?>
	<!-- /section -->

	<!-- required js -->
		
	<?php
	$this->renderPartial('/layouts/partials/footer-singlepage');
	?>
</body>
</html>