<?php
/* @var $this ModeratorController */
/* @var $data Moderator */
?>

<div class="member-entry view">
	<div class="member-details">
		<h4>
			<a href="extra-timeline.html"><?php echo CHtml::encode($data->moderator_nama); ?></a>
		</h4>

		<!-- Details with Icons -->
    <div class="row info-list">

			<div class="col-sm-4">
				<i class="entypo-briefcase"></i>
        <?php echo CHtml::encode($data->getAttributeLabel('id_moderator')); ?>
        <?php echo CHtml::link(CHtml::encode($data->id_moderator), array('view', 'id'=>$data->id_moderator)); ?>
			</div>

			<div class="col-sm-4">
				<i class="entypo-twitter"></i>
				<a href="#"><?php echo CHtml::encode($data->id_petani); ?></a>
			</div>

			<div class="col-sm-4">
				<i class="entypo-facebook"></i>
        <?php echo CHtml::encode($data->getAttributeLabel('is_petani')); ?> :
				<a href="#"><?php echo CHtml::encode($data->is_petani); ?></a>
			</div>

			<div class="clear"></div>

			<div class="col-sm-4">
				<i class="entypo-location"></i>
				<a href="#"><?php echo CHtml::encode($data->status); ?></a>
			</div>

			<div class="col-sm-4">
				<i class="entypo-mail"></i>
				<a href="#">john@gmail.com</a>
			</div>

			<div class="col-sm-4">
				<i class="entypo-linkedin"></i>
				<a href="#">johnkennedy</a>
			</div>

		</div>
	</div>
</div>