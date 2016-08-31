<div class="login-header login-caret">

	<div class="login-content">

		<a href="<?= Kospermindo::getBaseUrl(); ?>" class="logo">
			<img src="/static/admin/images/logo-white.png" width="200" alt="Logo Panrita" />
		</a>

		<p class="description">Lupa kata sandi ? Masukkan email Anda, kami akan mengirimkan pesan email beserta link untuk pembaharuan kata sandi Anda.</p>

		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span>Sedang memproses...</span>
		</div>
	</div>

</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	<div class="login-content">
		<?php if (Yii::app()->user->hasFlash('success')) { ?>
		<div id="error" class="form-login-error form-login-error-custom" style="display: block;background:#00a651 !important;">
			<h3 style="color: #bdedbc; background: #00a65f; margin-top: 0;"><?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?></h3>
			<p id="pesan" class="no-padding"></p>
		</div>
		<?php }else if(Yii::app()->user->hasFlash('failed')){ ?>
		<div id="error" class="form-login-error form-login-error-custom" style="display: block;">
			<h3 style="color: #ff7c7c; margin-top: 0;"><?php echo CHtml::encode(Yii::app()->user->getFlash('failed')); ?></h3>
			<p id="pesan" class="no-padding"></p>
		</div>
		<?php } ?>
		<form method="post" action="#" role="form" id="form_lupa_password">

			<div class="form-forgotpassword-success">
				<i class="entypo-check" style="background:rgb(216, 39, 39) !important"></i>
				<h3>Email reset telah terkirim</h3>
				<p>Silahkan cek email anda,  kunci akan kadaluarsa dalam 24 jam.</p>
			</div>

			<div class="form-steps">

				<div class="step current" id="step-1">

					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-mail"></i>
							</div>

							<input type="email" class="form-control" name="email" id="email_reset" placeholder="Email" data-mask="email" autocomplete="off" required />
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-info btn-block btn-login">
							<i class="entypo-login"></i>
							Kirim Email
						</button>
					</div>

				</div>

			</div>

		</form>

		<div class="login-bottom-links">
			<a href="/kospermindo/login" class="link">
					<i class="entypo-lock"></i>
					Kembali ke halaman login
			</a>
			<br />
			&copy; 2016 Panrita. by 
			<a href="https://www.docotel.com" target="_blank">Docotel Teknologi Celebes</a>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-sukses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Berhasil. Cek email untuk reset sandi	</h4>
			</div>
		</div>
	</div>
</div>

<?php
	Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-forgotpassword.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScript('forgot','
		setTimeout(function() {
			$("#alert-flash").addClass("hidden");
		}, 1500);
		setTimeout(function() {
			$("#error").addClass("hidden");
		}, 3500);
		$(document).ready(function(){
			$("#form_lupa_password").submit(function(e){
				e.preventDefault();
				$.ajax({
					type	: "POST",
					url 	: "/kospermindo/lupasandi/send",
					data 	: {
						"email" : $("#email_reset").val(),
					},
					success : function(data){
						msg = $.parseJSON(data);
						console.log(msg);
						if(msg.message=="success"){
							window.location.reload(true);
						}else{
							window.location.reload(true);
						}
					}
				});

			});
		});
	',CClientScript::POS_END);

?>
