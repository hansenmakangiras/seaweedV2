<div class="headline">

  <ol class="breadcrumb bc-3">

    <li>

      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>

    </li>

    <li class="active">

      <strong><?php echo 'Data Akun'; ?></strong>

    </li>

  </ol>

  <h2>Data Akun</h2><br/>

</div>


<div id="alert" class="alert-view hidden">
	<div class="alert-custom">
		<i class="entypo-logout"></i> &nbsp;Silahkan <a href="/kospermindo/users/logout">Logout</a> &nbsp;untuk melihat perubahan
	</div>
</div>


<form id="ubahakun">
	<p class="col-md-4">
		<label>Nama Pengguna</label>
		<input type="text" class="form-control input-lg" value="" name="newusername" id="newusername" maxlength="25" placeholder="Nama Pengguna Baru" required title="Harap isi Nama Pengguna dengan alpanumerik" pattern="[a-zA-Z0-9]+">
	</p>

	<div class="clearfix"></div>
	<br>

	<p class="col-md-4">
		<label>Kata Sandi Baru</label>
		<input type="password" class="form-control input-lg" name="newpassword" id="newpassword" value="" pattern=".{6,}" placeholder="Kata Sandi Baru" required title="Sandi Minimum 6 Karakter">
	</p>

	<div class="clearfix"></div>
	<br>

	<p class="col-md-4">
		<label>Ulangi Sandi Baru</label>
		<input type="password" class="form-control input-lg" name="repeat_password" placeholder="Ulangi Kata Sandi Baru" onfocus="validatePass(document.getElementById('newpassword'), this);" oninput="validatePass(document.getElementById('newpassword'), this);">
	</p>

	<div class="clearfix"></div>
	<br>

	<p class="col-md-4">
		<button id="submit" type="submit" class="btn btn-success btn-lg"><i class="entypo-floppy"></i>&nbsp;Simpan</button>
	</p>
</form>

<?php
	Yii::app()->clientScript->registerscript('new-farmer', '
		
		$("#modal-update").prependTo("#modal-view");

		function validatePass(p1, p2) {
		    if (p1.value != p2.value || p1.value == "" || p2.value == "") {
		        p2.setCustomValidity("Kata Sandi Tidak Sama");
		    } else {
		        p2.setCustomValidity("");
		    }
		}

		$(document).ready(function(){

			setTimeout(function() {
				$("#alert-flash").addClass("hidden");
			}, 1500);


			$("#ubahakun").submit(function(e){
				e.preventDefault();
				$("#submit").html("<i class=\"entypo-floppy\"></i>Proses");
				$("#submit").addClass("disabled");
				var	formData = new FormData();

				formData.append("username", $("#newusername").val());
				formData.append("password", $("#newpassword").val());

				$.ajax({
					url: "/kospermindo/pengaturan/updatepass",
					type: "POST",
					data: formData,
					dataType: "script",
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						msg = $.parseJSON(data);
						if(msg == "success"){
						$("#alert").removeClass("hidden");
						$("#alert .alert-custom").addClass("alert-custom-success");
						$("#alert .alert-custom").html("<i class=\"entypo-logout\"></i> &nbsp;Silahkan <a href=\"/kospermindo/users/logout\">Logout</a> &nbsp;untuk melihat perubahan");
						setTimeout(function() {
								$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
								$("#submit").removeClass("disabled");
							}, 1500);
						}else if(msg == "any_user"){
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Username sudah digunakan");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").html("");
									$("#alert").addClass("hidden");
								}, 1500);
						}else{
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal merubah nama pengguna dan kata sandi");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").html("");
									$("#alert").addClass("hidden");
								}, 1500);
						}
					}
				});

			});

			$(document).ajaxError(function( event, request, settings ) {
				$("#alert").removeClass("hidden");
				$("#alert .alert-custom").addClass("alert-custom-danger");
				$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Proses gagal");
				setTimeout(function() {
						$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
						$("#submit").removeClass("disabled");
						$("#alert .alert-custom").removeClass("alert-custom-danger");
						$("#alert .alert-custom").html("");
						$("#alert").addClass("hidden");
					}, 1500);
			});

		});

	', CClientScript::POS_END);
?>
