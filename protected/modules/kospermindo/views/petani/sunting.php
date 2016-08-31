<div class="headline">

	<ol class="breadcrumb bc-3">

		<li>

			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>

		</li>

		<li class="active">

			<strong><?php echo 'Sunting Data Petani'; ?></strong>

		</li>

	</ol>

	<h2>Sunting Data Petani</h2><br/>

</div>

<?php if (Yii::app()->user->hasFlash('success')) { ?>
	<div id="alert-flash" class="alert-view">
		<div class="alert-custom alert-custom-success">
			<i class="entypo-check"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?>
		</div>
	</div>
<?php } else {
	if (Yii::app()->user->hasFlash('failed')) { ?>
		<div id="alert-flash" class="alert-view">
			<div class="alert-custom alert-custom-danger">
				<i class="entypo-cancel"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('failed')); ?>
			</div>
		</div>
	<?php }
} ?>
<div id="alert" class="alert-view hidden">
	<div class="alert-custom">
	</div>
</div>

<form action="" id="form-sunting">

	<div class="row">

		<div class="col-md-12">
			<h5><b>Informasi Dasar</b></h5>
			<hr>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<div class="fileinput <?php $exp = explode("/",
					$petani['url_foto']); ?><?= (end($exp) === 'profile-picture.png') ? 'fileinput-new' : 'fileinput-exist fileinput-exists'; ?>"
						 data-provides="fileinput">
					<div class="fileinput-new thumbnail dp-image" data-trigger="fileinput">
						<img src="<?= $this->baseUrl ?>/static/admin/images/profile-picture.png" alt="...">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;">
						<img src="<?= $petani['url_foto'] ?>">
					</div>
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
			</div>
		</div>

		<div class="col-md-10">

			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="nama_lengkap" id="nama_lengkap"
								 value="<?= $petani['nama_petani'] ?>" maxlength="75" data-validate="required"
								 placeholder="Nama lengkap"/>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="nomor_identitas" id="nomor_identitas"
								 value="<?= $petani['nik'] ?>" maxlength="16" data-validate="required" placeholder="Nomor Identitas"/>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">+62</span>
						<input type="text" id="no_telp"
									 value="<?= substr($petani['no_telp'], 3, (strlen($petani['no_telp'] - 1))) ?>"
									 class="form-control input-lg" name="telpon" maxlength="15" data-validate="required"
									 placeholder="Nomor Telpon"/>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="alamat" id="alamat" value="<?= $petani['alamat'] ?>"
								 data-validate="required" maxlength="100" placeholder="Alamat Lengkap"/>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<select name="" id="provinsi" class="form-control input-lg" required>
						<option value="">Pilih Provinsi</option>
						<?php foreach ($provinsi as $key => $valprov) { ?>
							<option
								value="<?= $valprov->provinsi_id ?>" <?= ($petani['provinsi'] == $valprov->provinsi_id) ? 'selected' : ''; ?>><?= $valprov->provinsi_nama ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<select name="" id="kabupaten" class="form-control input-lg" required>
						<option value="">Pilih Kabupaten/Kota</option>
						<?php foreach ($kabupaten as $key => $valkokab) { ?>
							<option
								value="<?= $valkokab->kota_id ?>" <?= ($petani['kabupaten'] == $valkokab->kota_id) ? 'selected' : ''; ?>><?= $valkokab->kokab_nama ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="tempat_lahir" id="tempat_lahir"
								 value="<?= $petani['tempat_lahir'] ?>" maxlength="100" data-validate="required"
								 placeholder="Tempat Lahir"/>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control input-lg datepicker" name="tanggal_lahir" id="tanggal_lahir"
								 data-format="dd/mm/yyyy" value="<?= date('d/m/Y', strtotime($petani['tgl_lahir'])) ?>"
								 data-validate="required" placeholder="Tanggal Lahir"/>
				</div>
			</div>
		</div>

	</div>

	<br>
	<br>

	<div class="row">

		<div class="col-md-6">

			<div class="row">

				<div class="col-md-12">
					<h5><b>Data Pertanian</b></h5>
					<hr>
				</div>

				<div class="col-md-12">
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

										<?php $arrIdJns = array();
											$arrValJns = array();
											foreach (json_decode($petani['jenis_komoditi']) as $key => $valjns) {
												$arrIdJns[] = $valjns->id;
												$arrValJns[] = $valjns->luas;
											}
											$arrCombineJns = array_combine($arrIdJns, $arrValJns);
											?>
										<?php $n = 1;
											foreach ($jenis_komoditi as $key => $value) { ?>
										<?php if ($value['hasChild'] == 1){ ?>
									<p>
									<h5><?= $value['parent']->jenis ?></h5>
									</p>
									<div class="sub-komoditi">
										<?php foreach ($value['child'] as $k => $val) { ?>
											<div class="col-md-12">
												<div id="data-lokasi-jenis">
													<div class="checkbox checkbox-replace">
														<input type="checkbox" id="chk-<?= $n; ?>" <?= (in_array($val->id_komoditi,
															$arrIdJns)) ? 'checked' : ''; ?>>
														<label data-id="<?= $val->id_komoditi ?>" id="jenis-lbl"><?= $val->jenis ?></label>
													</div>
													<div
														class="col-md-12 sub-form <?= (in_array($val->id_komoditi, $arrIdJns)) ? '' : 'hidden'; ?>"
														id="data-lokasi-<?= $n; ?>">
														<div class="row">
															<div class="col-md-12">
																<div class="input-group">
																	<input type="text" id="luas_lokasi" min="0" class="form-control"
																				 value="<?= !empty($arrCombineJns[$val->id_komoditi]) ? $arrCombineJns[$val->id_komoditi] : ''; ?>"
																				 name="luas_lokasi" id="luas_lokasi" maxlength="10" data-validate="required"
																				 placeholder="Luas Lokasi"/>
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
									<?php } else { ?>
										<div id="data-lokasi-jenis">
											<div class="checkbox checkbox-replace">
												<input type="checkbox" id="chk-<?= $n; ?>" <?= (in_array($value['parent']->id_komoditi,
													$arrIdJns)) ? 'checked' : ''; ?>>
												<label data-id="<?= $value['parent']->id_komoditi ?>"
															 id="jenis-lbl"><?= $value['parent']->jenis ?></label>
											</div>
											<div class="col-md-12 sub-form <?= (in_array($value['parent']->id_komoditi,
												$arrIdJns)) ? '' : 'hidden'; ?>" id="data-lokasi-<?= $n; ?>">
												<div class="row">
													<div class="col-md-12">
														<div class="input-group">
															<input type="text" id="luas_lokasi" min="0" class="form-control" name="luas_lokasi"
																		 id="luas_lokasi"
																		 value="<?= !empty($arrCombineJns[$value['parent']->id_komoditi]) ? $arrCombineJns[$value['parent']->id_komoditi] : ''; ?>"
																		 maxlength="10" data-validate="required" placeholder="Luas Lokasi"/>
															<span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
														</div>
													</div>
												</div>
											</div>
											<br>
										</div>
									<?php }
										$n++;
										} ?>
									</p>
								</div>
							</div>


						</div>

					</div>
				</div>

			</div>

		</div>


		<div class="col-md-6">

			<div class="row">

				<div class="col-md-12">
					<h5><b>Data Organisasi</b></h5>
					<hr>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<select name="jenis_gudang" id="jenis_gudang" class="form-control input-lg" data-validate="required">
							<option value="">Pilih Jenis Gudang</option>
							<?php foreach ($jenis_gudang as $key => $valjnsgudang) { ?>
								<option
									value="<?= $valjnsgudang->kode_jenis_gudang ?>" <?= ($petani['kode_jenis_gudang'] == $valjnsgudang->kode_jenis_gudang) ? 'selected' : ''; ?>><?= $valjnsgudang->jenis_gudang ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<select name="gudang" id="gudang" class="form-control input-lg" data-validate="required">
							<?php foreach ($gudang as $key => $valgudang) { ?>
								<option
									value="<?= $valgudang->kode_gudang ?>" <?= ($petani['kode_gudang'] == $valgudang->kode_gudang) ? 'selected' : ''; ?>><?= $valgudang->nama ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-12">
					<div class="form-group">
						<select name="kelompok" id="kelompok" class="form-control input-lg" data-validate="required">
							<?php foreach ($kelompok as $key => $valkelompok) { ?>
								<option
									value="<?= $valkelompok->kode_kelompok ?>" <?= ($petani['kode_kelompok'] == $valkelompok->kode_kelompok) ? 'selected' : ''; ?>><?= $valkelompok->nama_kelompok ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

			</div>

		</div>

	</div>

	<br>
	<br>

	<div class="row">

		<div class="col-md-6">

			<div class="row">

				<div class="col-md-12">
					<h5><b>Data Akun</b><a href="#" class="pull-right" data-toggle="modal" data-target="#modal-update"
																 id="btn-tmbh"><i class="entypo-pencil"></i>&nbsp;Sunting</a></h5>
					<hr>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<input type="text" class="form-control input-lg" disabled="true" value="<?= $petani['username'] ?>"
									 name="username" id="username" maxlength="25" data-validate="required,minlength[5]"
									 data-message-minlength="Minimal 5 karakter" placeholder="Nama Pengguna"/>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-12">
					<div class="form-group">
						<input type="password" class="form-control input-lg" disabled="true" value="******" name="password"
									 id="password" data-validate="required,minlength[6]" data-message-minlength="Minimal 6 karakter"
									 placeholder="Kata Sandi"/>
					</div>
				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="clearfix"></div>

		<div class="col-md-12">
			<hr>
			<button id="submit" type="submit" class="btn btn-success btn-lg"><i class="entypo-floppy"></i>&nbsp;Simpan
			</button>
		</div>

	</div>

</form>

<br>
<br>
<br>
<br>


<!-- Modal -->
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Sunting Akun</h4>
			</div>

			<div id="tes"></div>
			<form action="" method="POST" class="form-horizontal validate validate-custom" id="sunting-pass">
				<div class="modal-body">
					<div class="row">
						<p class="col-md-12">
							<input type="text" class="form-control input-lg" value="<?= $petani['username'] ?>" name="username"
										 id="newusername" maxlength="25" data-validate="required,minlength[5]"
										 data-message-minlength="Minimal 5 karakter" placeholder="Nama Pengguna"/>
						</p>

						<p class="col-md-12">
							<input type="password" class="form-control input-lg" name="password" id="newpassword"
										 data-validate="required,minlength[6]" data-message-minlength="Minimal 6 karakter"
										 placeholder="Masukkan Kata Sandi Baru"/>
						</p>

						<p class="col-md-12">
							<input type="password" class="form-control input-lg" name="repeat_password"
										 data-validate="required,equalTo[#newpassword]" data-message-equal-to="Kata Sandi tidak sama"
										 placeholder="Ulangi Kata Sandi Baru"/>
						</p>
					</div>
				</div>
				<div class="modal-footer">
					<button id="submit-pass" type="submit" class="btn btn-success btn-lg"><i class="entypo-floppy"></i>&nbsp;Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
	Yii::app()->clientScript->registerscript('new-farmer', '
		
		$("#modal-update").prependTo("#modal-view");

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

			$("#jenis_gudang").on("change", function(){
				$.ajax({
					type: "POST",
					url: "/kospermindo/petani/getgudang",
					data:{
						"id" : $("#jenis_gudang").val(),
					},
					success: function(data){
						msg = $.parseJSON(data);
						console.log(msg);
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

			var getUrlParameter = function getUrlParameter(sParam) {
				var sPageURL = decodeURIComponent(window.location.search.substring(1)),
					sURLVariables = sPageURL.split("&"),
					sParameterName,
					i;

				for (i = 0; i < sURLVariables.length; i++) {
					sParameterName = sURLVariables[i].split("=");

					if (sParameterName[0] === sParam) {
						return sParameterName[1] === undefined ? true : sParameterName[1];
					}
				}
			};

			$("#form-sunting").submit(function(e){
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
								$("html").animate({
										scrollTop: 0
								}, 500);
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
				formData.append("no_telp", $("#no_telp").val());
				formData.append("alamat", $("#alamat").val());
				formData.append("provinsi", $("#provinsi").val());
				formData.append("kabupaten", $("#kabupaten").val());
				formData.append("tempat_lahir", $("#tempat_lahir").val());
				formData.append("tanggal_lahir", $("#tanggal_lahir").val());
				formData.append("luas_lokasi", $("#luas_lokasi").val());
				formData.append("jumlah_bentangan", $("#jumlah_bentangan").val());
				formData.append("jenis", JSON.stringify(jenis));
				formData.append("jenis_gudang", $("#jenis_gudang").val());
				formData.append("gudang", $("#gudang").val());
				formData.append("kelompok", $("#kelompok").val());

				$.ajax({
					url: "/kospermindo/petani/update?id="+getUrlParameter("id"),
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
									$("html").animate({
											scrollTop: 0
									}, 600);
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, username telah digunakan");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").html("");
									$("#alert").addClass("hidden");
								}, 1500);
						}else if(msg == "any_ktp"){
									$("html").animate({
											scrollTop: 0
									}, 600);
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, nomor identitas telah digunakan");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-floppy\"></i>Simpan");
									$("#submit").removeClass("disabled");
									$("#alert .alert-custom").removeClass("alert-custom-danger");
									$("#alert .alert-custom").html("");
									$("#alert").addClass("hidden");
								}, 1500);
							}else{
									$("html").animate({
											scrollTop: 0
									}, 600);
							$("#alert").removeClass("hidden");
							$("#alert .alert-custom").addClass("alert-custom-danger");
							$("#alert .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru");
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


			$("#sunting-pass").submit(function(e){
				e.preventDefault();
				$("#submit-pass").html("<i class=\"entypo-floppy\"></i>Proses");
				$("#submit-pass").addClass("disabled");
				var	formData = new FormData();

				formData.append("username", $("#newusername").val());
				formData.append("password", $("#newpassword").val());

				$.ajax({
					url: "/kospermindo/petani/updatepass?id="+getUrlParameter("id"),
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
							window.location.reload(true);

						}else{
							window.location.reload(true);

						}
					}
				});

			});

			$(document).ajaxError(function( event, request, settings ) {
						$("html").animate({
								scrollTop: 0
						}, 600);
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
