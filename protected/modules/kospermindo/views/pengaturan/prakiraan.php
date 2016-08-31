<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"pengaturan\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(2)').addClass('active');
");
?>