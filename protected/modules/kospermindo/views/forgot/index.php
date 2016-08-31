<div class="login-header login-caret">

	<div class="login-content">

		<a href="<?= Kospermindo::getBaseUrl(); ?>" class="logo">
			<img src="/static/admin/images/logo-white.png" width="200" alt="Logo Panrita" />
		</a>

		<p class="description">Lupa Sandi? Silahkan isi alamat email anda untuk kemudian dikirimkan kembali.</p>

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
		<form method="post" role="form" id="form_forgot_password">

			<div class="form-forgotpassword-success">
				<i class="entypo-check"></i>
				<h3>Email reset telah terkirim</h3>
				<p>Silahkan cek email anda, link reset kata kunci akan kadaluarsa dalam 24 jam.</p>
			</div>

			<div class="form-steps">

				<div class="step current" id="step-1">

					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-mail"></i>
							</div>

							<input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off" />
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
<?php
	Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-forgotpassword.js',CClientScript::POS_END);
?>
