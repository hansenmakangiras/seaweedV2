<div class="row nav-custom">
	<!-- Profile Info and Notifications -->
	<div class="col-md-12 col-sm-8 clearfix">

		<ul class="user-info pull-right pull-none-xsm">
			<!-- Profile Info -->
			<li class="profile-info dropdown pull-right">
				<!-- add class "pull-right" if you want to place this from right -->
				<a href="#" class="dropdown-toggle user" data-toggle="dropdown">
					<img src="" data-name="<?php echo (!empty(Yii::app()->user->getName())) ? strtoupper(Yii::app()->user->getName()): "Guest" ?>" id="profile" alt="" class="img-circle profile" width="44"/>
					<strong style="color: #ffffff"><?php echo (!empty(Yii::app()->user->getName())) ? strtoupper(Yii::app()->user->getName()): "Guest" ?></strong>
				</a>

				<ul class="dropdown-menu">

					<!-- Reverse Caret -->
					<li class="caret"></li>
					<?php if(Yii::app()->user->akses == 1 || Yii::app()->user->akses == 2){ ?>
					<li> 
						<a href="/kospermindo/pengaturan/ubahakun" class="no-margin">
							<i class="entypo-key"></i>
							Pengaturan Akun
						</a>
					</li>
					<?php } ?>
					<!-- <li>
						<a href="/kospermindo/pengaturan" class="no-margin">
							<i class="entypo-cog"></i>
							Pengaturan
						</a>
					</li> -->

					<li>
						<a href="/kospermindo/users/logout" class="no-margin">
							<i class="entypo-logout"></i>
							Keluar
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<?php
	Yii::app()->clientScript->registerScript('initial', '
		$(".profile").initial({
			fontSize: 50,
			fontWeight: 700
		 }); 
	');
?>