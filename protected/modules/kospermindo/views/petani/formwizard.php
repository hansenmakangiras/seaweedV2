<?php if (Yii::app()->user->hasFlash('success')) { ?>
	<div id="alert-flash" class="alert-view">
		<div class="alert-custom alert-custom-success">
			<i class="entypo-check"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?>			
		</div>
	</div>
<?php } ?>
<div id="alert" class="alert-view hidden">
	<div class="alert-custom">
	</div>
</div>

<h4>Tambah Data Petani
	<small>- Silahkan masukkan data petani anda dibawah ini</small>
</h4>
<hr/>

<form id="rootwizard-2" method="post" action="" class="form-wizard validate validate-custom">

	<div class="steps-progress">
		<div class="progress-indicator"></div>
	</div>

	<ul>
		<li class="active">
			<a href="#tab2-1" data-toggle="tab"><span>1</span>Data Pribadi</a>
		</li>
		<li>
			<a href="#tab2-2" data-toggle="tab"><span>2</span>Data Pertanian</a>
		</li>
		<li>
			<a href="#tab2-3" data-toggle="tab"><span>3</span>Data Akun</a>
		</li>
		<li>
			<a href="#tab2-4" data-toggle="tab"><span>4</span>Data Organisasi</a>
		</li>
	</ul>

	<br>
	<br>

	<div class="tab-content" style="margin: 0 15px">
		<div class="tab-pane active" id="tab2-1">

			<div class="row">

				<div class="col-md-12">	
					<div class="form-group">
						<center>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail dp-image" data-trigger="fileinput">
									<img src="<?= $this->baseUrl?>/static/admin/images/profile-picture.png" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Pilih Foto Profil</span>
										<span class="fileinput-exists">Ganti</span>
										<input id="foto" type="file" name="..." accept="image/*" data-max-size="2048">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Hapus</a>
								</div>
							</div>
							<br>
							<i>Maksimal 100 Kb</i>
							<br>
							<br>
						</center>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control input-lg" name="nama_lengkap" id="nama_lengkap" maxlength="75" data-validate="required" placeholder="Nama lengkap"/>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control input-lg" name="nomor_identitas" id="nomor_identitas" maxlength="16" data-validate="required" placeholder="Nomor Identitas"/>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">+62</span>
							<input type="text" id="telpon" class="form-control input-lg" name="telpon" maxlength="15" data-validate="required" placeholder="Nomor Telpon"/>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control input-lg" name="alamat" id="alamat" data-validate="required" maxlength="100" placeholder="Alamat Lengkap"/>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<select name="" id="provinsi" class="form-control input-lg" required>
							<option value="">Pilih Provinsi</option>
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<select name="" id="kabupaten" class="form-control input-lg" required>
							<option value="">Pilih Kabupaten/Kota</option>
						</select>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control input-lg" name="tempat_lahir" id="tempat_lahir" maxlength="100" data-validate="required" placeholder="Tempat Lahir"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control input-lg datepicker" name="tanggal_lahir" data-format="dd/mm/yyyy" id="tanggal_lahir" data-validate="required" placeholder="Tanggal Lahir"/>
					</div>
				</div>

			</div>

		</div>

		<div class="tab-pane" id="tab2-2">

			<div class="row">

				<div class="col-md-offset-3 col-md-6">
					<div class="panel panel-primary" data-collapsed="0">
		
						<!-- panel head -->
						<div class="panel-heading">
							<div class="panel-title">Jenis Komoditi</div>
						</div>
						
						<!-- panel body -->
						<div class="panel-body" style="display: block;">

							<div class="row">
								<div class="col-md-6">
									<p>
										<?php $n=1; foreach ($jenis_komoditi as $key => $value) { ?>
											<?php if($value['hasChild'] == 1){ ?>
												<p>
													<h5><?= $value['parent']->jenis ?></h5>
												</p>
												<div class="sub-komoditi">
														<?php foreach ($value['child'] as $key => $val) { ?>
															<div class="col-md-12">
																<div id="data-lokasi-jenis">
																	<div class="checkbox checkbox-replace">
																		<input type="checkbox" id="chk-<?= $n; ?>">
																		<label data-id="<?= $val->id_komoditi ?>" id="jenis-lbl"><?= $val->jenis ?></label>
																	</div>
																	<div class="col-md-12 sub-form hidden" id="data-lokasi-<?= $n; ?>">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="input-group">
																					<input type="text" id="luas_lokasi" min="0" class="form-control" name="luas_lokasi" id="luas_lokasi" maxlength="10" data-validate="required" placeholder="Luas Lokasi"/>
																					<span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
																				</div>
																			</div>

																			<!-- <div class="col-md-12">
																				<input type="text" id="jumlah_bentangan" min="0" class="form-control" disabled="true" name="jumlah_bentangan" id="jumlah_bentangan" maxlength="10" data-validate="required" placeholder="Jumlah Bentangan"/>
																			</div> -->
																		</div>
																	</div>
																</div>
															</div>
														<?php } ?>
													</div>
													<br>
											<?php }else{ ?>
											<div id="data-lokasi-jenis">												
												<div class="checkbox checkbox-replace">
													<input type="checkbox" id="chk-<?= $n; ?>">
													<label data-id="<?= $value['parent']->id_komoditi ?>" id="jenis-lbl"><?= $value['parent']->jenis ?></label>
												</div>
												<div class="col-md-12 sub-form hidden" id="data-lokasi-<?= $n; ?>">
													<div class="row">
														<div class="col-md-12">
															<div class="input-group">
																<input type="text" id="luas_lokasi" min="0" class="form-control" name="luas_lokasi" id="luas_lokasi" maxlength="10" data-validate="required" placeholder="Luas Lokasi"/>
																<span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
															</div>
														</div>
													</div>
												</div>
												<br>
											</div>
										<?php } $n++; }  ?>
									</p>
								</div>
							</div>
							
							
						</div>
						
					</div>
				</div>


			</div>

		</div>

		<div class="tab-pane" id="tab2-3">

			<div class="row">

				<div class="col-md-offset-3 col-md-6">
					<div class="form-group">
						<input type="text" class="form-control input-lg" name="username" id="username" maxlength="25" data-validate="required,minlength[5],alphanumeric" data-message-minlength="Minimal 5 karakter" placeholder="Nama Pengguna"/>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="form-group">
						<input type="password" class="form-control input-lg" name="password" id="password" data-validate="required,minlength[6]" data-message-minlength="Minimal 6 karakter" placeholder="Kata Sandi"/>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="form-group">
						<input type="password" class="form-control input-lg" name="repeat_password" data-validate="required,equalTo[#password]" data-message-equal-to="Kata Sandi tidak sama" placeholder="Ulangi Kata Sandi"/>
					</div>
				</div>
			</div>

		</div>

		<div class="tab-pane" id="tab2-4">

			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="form-group">
						<select name="jenis_gudang" id="jenis_gudang" class="form-control input-lg" data-validate="required">
							<option value="">Pilih Jenis Gudang</option>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="form-group">
						<select name="gudang" id="gudang" class="form-control input-lg" data-validate="required">
							<option value="">Pilih Gudang</option>
						</select>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-md-offset-3 col-md-6">
					<div class="form-group">
						<select name="kelompok" id="kelompok" class="form-control input-lg" data-validate="required">
							<option value="">Pilih Kelompok</option>
						</select>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-12 text-center">
					<hr>
					<button id="submit" type="submit" class="btn btn-success btn-lg"><i class="entypo-floppy"></i>Simpan</button>
				</div>
				
			</div>

		</div>

		<ul class="pager wizard">
			<li class="previous">
				<a href="#"><i class="entypo-left-open"></i> Sebelumnya</a>
			</li>

			<li class="next">
				<a href="#" id="next">Selanjutnya <i class="entypo-right-open"></i></a>
			</li>
		</ul>

	</div>

	<br>
	<br>

</form>
<!-- Footer -->
<?php
	Yii::app()->clientScript->registerscript('new-farmer', '
		$(document).ready(function(){
			setTimeout(function() {
				$("#alert-flash").addClass("hidden");
			}, 1500);

			$("#telpon").keypress(function (e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});
			
			$("#username").keypress(function (e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 97 || e.which > 122) && (e.which < 65 || e.which > 90)) {
					return false;
				}
			});

			$("#nomor_identitas").keypress(function (e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});

			$("#luas_lokasi").keypress(function (e) {
				if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});

			$("#jumlah_bentangan").keypress(function (e) {
				if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});
			
			$.ajax({
				type: "POST",
				url: "/kospermindo/petani/getprov",
				data:{
				},
				success: function(data){
					msg = $.parseJSON(data);
					$.each(msg, function(i, v){
						$("#provinsi").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
					});
				}
			});

			$("#provinsi").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getkota",
					data:{
						"prov" : $("#provinsi").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#kabupaten").empty();
						$("#kabupaten").end();
						$.each(msg, function(i, v){
							$("#kabupaten").append("<option value=\""+ v.id +"\">"+ v.nama +"</option>");
						});
					}
				});
			});

			$.ajax({
				type: "POST",
				url: "/kospermindo/petani/getjenisgudang",
				data:{
				},
				success: function(data){
					msg = $.parseJSON(data);
					$.each(msg, function(i, v){
						$("#jenis_gudang").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
					});
				}
			});


			$.ajax({
				type: "POST",
				url: "/kospermindo/petani/getgudang",
				data:{
				},
				success: function(data){
					msg = $.parseJSON(data);
					$.each(msg, function(i, v){
						$("#gudang").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
					});
				}
			});

			$("#jenis_gudang").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getgudang",
					data:{
						"id" : $("#jenis_gudang").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#gudang").empty();
						$("#gudang").end();
						$.each(msg, function(i, v){
							$("#gudang").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
						});
						$.ajax({
							type: "POST",
							url: "/kospermindo/petani/getkelompok",
							data:{
								"id" : $("#gudang").val(),
							},
							success: function(data){
								msg = $.parseJSON(data);
								$("#kelompok").empty();
								$("#kelompok").end();
								$.each(msg, function(i, v){
									$("#kelompok").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
								});
							}
						});
					}
				});
			});

			$("#gudang").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getkelompok",
					data:{
						"id" : $("#gudang").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#kelompok").empty();
						$("#kelompok").end();
						$.each(msg, function(i, v){
							$("#kelompok").append("<option value=\""+ v.id +"\">"+ v.value +"</option>");
						});
					}
				});
			});

			$("#rootwizard-2").submit(function(e){
				e.preventDefault();
				$("#submit").html("<i class=\"entypo-floppy\"></i>Proses");
				$("#submit").addClass("disabled");
				var fileInput = $("#foto"),
			    	maxSize = 100000,
					jenis=[],
					luas,
					bentangan,
					formData = new FormData(),
					input_img = fileInput.prop("files")[0];

				if(fileInput.get(0).files.length){
					var fileSize = fileInput.get(0).files[0].size;
					if(fileSize > maxSize){

						$("#alert").removeClass("hidden");
						$("#alert .alert-custom").addClass("alert-custom-danger");
						$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, file foto melebihi kapasitas");
						setTimeout(function() {
								$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
								$("#submit").removeClass("disabled");
								$("#alert .alert-custom").removeClass("alert-custom-danger");
								$("#alert .alert-custom").html("");
								$("#alert").addClass("hidden");
							}, 1500);
						return false;
					}
				}

				$("div.checkbox-replace.checked").each(function(index, value){
					var getJenis = $(this).children("#jenis-lbl").attr("data-id");
					luas = $(this).parent("#data-lokasi-jenis").children(".sub-form").children(".row").children(".col-md-12").children(".input-group").children("#luas_lokasi").val();
					bentangan = $(this).parent("#data-lokasi-jenis").children(".sub-form").children(".row").children(".col-md-12").children(".input-group").children("#jumlah_bentangan").val();
					
					if(getJenis !== undefined){
						arrJenis ={
							"id" : getJenis,
							"luas" : luas,
							"bentangan" : parseFloat((luas/25)).toFixed(2)
						}
						jenis.push(arrJenis);
					}
				});

				formData.append("foto", input_img);
				formData.append("nama_lengkap", $("#nama_lengkap").val());
				formData.append("nomor_identitas", $("#nomor_identitas").val());
				formData.append("no_telp", $("#telpon").val());
				formData.append("alamat", $("#alamat").val());
				formData.append("provinsi", $("#provinsi").val());
				formData.append("kabupaten", $("#kabupaten").val());
				formData.append("tempat_lahir", $("#tempat_lahir").val());
				formData.append("tanggal_lahir", $("#tanggal_lahir").val());
				formData.append("jenis", JSON.stringify(jenis));
				formData.append("username", $("#username").val());
				formData.append("password", $("#password").val());
				formData.append("jenis_gudang", $("#jenis_gudang").val());
				formData.append("gudang", $("#gudang").val());
				formData.append("kelompok", $("#kelompok").val());

				$.ajax({
				    url: "/kospermindo/petani/create",
				    type: "POST",
				    data: formData,
				    dataType: "script",
				    cache: false,
				    contentType: false,
				    processData: false,
				    success: function(data) {
				    	msg = $.parseJSON(data);

				    	if(msg == "success"){
							window.location.reload(true);
						}else if(msg == "any_user"){
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, username telah digunakan");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").addClass("hidden");
									$("#alert .alert-custom").html("");
									$("#alert").removeClass("hidden");
								}, 1500);
						}else if(msg == "any_ktp"){
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, Nomor Identitas telah digunakan");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").addClass("hidden");
									$("#alert .alert-custom").html("");
									$("#alert").removeClass("hidden");
								}, 1500);
				    	}else{
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").addClass("hidden");
									$("#alert .alert-custom").html("");
									$("#alert").removeClass("hidden");
								}, 1000);
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

			$(document).on("click", "div.checkbox-replace", function(){
				if($(this).hasClass("checked")){
					$(this).parent("#data-lokasi-jenis").find(".sub-form").removeClass("hidden");
				}else{
					$(this).parent("#data-lokasi-jenis").find(".sub-form").addClass("hidden");
				}
			});

		});


	', CClientScript::POS_END);
?>
