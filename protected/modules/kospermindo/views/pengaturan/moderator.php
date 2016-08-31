<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"pengaturan\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(2)').addClass('active');
");
?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<b>Pengaturan Moderator</b>
		</li>
	</ol>
	<h2>Pengaturan Moderator</h2><br/>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<button id="btn-tmbh" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert"><i class="entypo-plus"></i>&nbsp;Tambah</button>
				<br>
				<br>
				<?php if (Yii::app()->user->hasFlash('success')) { ?>
					<div id="alert-flash" class="alert-view">
						<div class="alert-custom alert-custom-success">
							<i class="entypo-check"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?>
						</div>
					</div>
				<?php }else if(Yii::app()->user->hasFlash('failed')){ ?>
					<div id="alert-flash" class="alert-view">
						<div class="alert-custom alert-custom-danger">
							<i class="entypo-cancel"></i> &nbsp;<?php echo CHtml::encode(Yii::app()->user->getFlash('failed')); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th>Nama Pengguna</th>
							<th>Email</th>
							<th>No. Hp</th>
							<th>Hak Akses</th>
							<th class="text-center" width="200px">Aksi</th>
						</tr>
					<thead>
					<tbody>
					<?php if(!empty($users)){ ?>
						<?php $i = !empty($_GET['page']) ? (($_GET['page'] - 1) * 10) + 1 : 1; foreach ($users as $key => $vuser) { ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $vuser->username ?></td>
								<td><?= $vuser->email ?></td>
								<td><?= $vuser->no_handphone ?></td>
								<td>
									<?php foreach (json_decode($vuser->mod_akses) as $key => $vm) { ?>
										<i class="entypo-check"></i> &nbsp;<?= Users::model()->getMenu($vm); ?><br>
									<?php } ?>
								</td>
								<td>
									<a class="btn btn-default btn-sm btn-icon icon-left" href="#" class='modal-edit' id="sunting" data-id="<?= $vuser->id ?>"><i class="entypo-pencil"></i>Sunting</a>
									<a href="#" data-record-id="<?= $vuser->id ?>" data-record-title="Konfirmasi"
										 data-href="<?php echo $this->baseUrl; ?>/kospermindo/pengaturan/moderatordelete"
										 data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"
										 data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
											class="entypo-trash"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					<?php } else { ?>
						<td colspan="7" class="text-center">Tidak ada hasil ditemukan</td>
					<?php } ?>
					</tbody>
				</table>
				<div class="col-md-12">
					<?php
						$pages = $data->pagination;
						$this->widget('CLinkPager', array(
							'pages'             => $pages,
							'maxButtonCount'=> 30,
							'pageSize'          => 10,
							'itemCount'         => (int) $data->totalItemCount,
							'htmlOptions'       => array('class' => 'pagination pagination-custom'),
							'hiddenPageCssClass' => '',
							'selectedPageCssClass' => 'active',
							'header' => '',
							'nextPageLabel'     => 'Berikutnya',
							'prevPageLabel'     => 'Sebelumnya',
							'lastPageLabel'     => 'Akhir',
							'firstPageLabel'     => 'Awal',
						));
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->

<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Tambah Moderator</h4>
						</div>
						<form action="" method="POST" class="form-horizontal" id="form-moderator">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<div id="alert-modal" class="alert-view hidden">
											<div class="alert-custom">
											</div>
										</div>
										<br>
										<div class="col-md-12">
											<div class="col-md-12">
												<div id="chk-username" class="checkbox checkbox-replace">
													<input type="checkbox">
													<label >Sunting Nama Pengguna dan Kata Sandi</label>
												</div>
												<br>
											</div>

											<div class="col-md-12">
												<input id="username" type="text" placeholder="Nama Pengguna" name="username" class="form-control input-lg" maxlength="100" required title="Harap isi Nama Pengguna dengan alpanumerik" pattern="[a-zA-Z0-9]+">
												<br>
											</div>

											<div class="col-md-12">
												<input type="password" class="form-control input-lg" name="password" id="password" placeholder="Kata Sandi" pattern=".{6,}" required title="Sandi Minimum 6 Karakter" />
												<br>
											</div>

											<div class="col-md-12">
												<input type="password" class="form-control input-lg" name="repeat_password" id="repeat_password" placeholder="Ulangi Kata Sandi" onfocus="validatePass(document.getElementById('password'), this);" oninput="validatePass(document.getElementById('password'), this);"/>
												<br>
											</div>

											<div class="col-md-12">
												<input id="email" type="email" placeholder="Email" name="email" class="form-control input-lg" maxlength="100" required title="Masukkan Email yang valid">
												<br>
											</div>

											<div class="col-md-12">
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon1">+62</span>
													<input type="text" id="telpon" class="form-control input-lg" name="telpon" maxlength="15" data-validate="required" placeholder="Nomor Telpon"/>
												</div>
												<br>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<div class="panel panel-primary" style="padding: 0;">
														<!-- panel head -->
														<div class="panel-heading">
															<div class="panel-title">Hak Akses</div>
														</div>
														<!-- panel body -->
														<div class="panel-body" style="display: block;">
														<?php foreach ($menu as $key => $vmenu) { ?>
															<div class="col-md-12">
																<div id="chk-<?= $vmenu->id ?>" class="checkbox checkbox-replace">
																	<input type="checkbox">
																	<label data-id="<?= $vmenu->id ?>" id="menu-lbl"><?= $vmenu->menu ?></label>
																</div>
															</div>
														<?php } ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>
								<a id="edit" class="btn btn-info btn-lg" data-id=""><i class="entypo-pencil"></i>Sunting</a>
							</div>
						</form>
				</div>
		</div>
</div>

<?php
	Yii::app()->clientScript->registerScript('close-alert', '
		
		$("#modal-insert").prependTo("#modal-view");

		function validatePass(p1, p2) {
		    if (p1.value != p2.value || p1.value == "" || p2.value == "") {
		        p2.setCustomValidity("Kata Sandi Tidak Sama");
		    } else {
		        p2.setCustomValidity("");
		    }
		}

		setTimeout(function() {
			$("#alert-flash").addClass("hidden");
		}, 5000);

		$(document).ready(function(){

			$("#telpon").keypress(function (e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});

			$("#username").keypress(function (e) {
				if (e.which == 32) {
					return false;
				}
			});

			$("#btn-tmbh").on("click", function(){
				$("#myModalLabel").text("Tambah Moderator");
				$("#edit").addClass("hidden");
				$("#submit").removeClass("hidden");
				$("#modal-insert").modal("show");
				$("div.checkbox#chk-username").addClass("hidden");
				$("#username").removeClass("hidden");
				$("#password").removeClass("hidden");
				$("#repeat_password").removeClass("hidden");
				$("#username").attr("placeholder", "Nama Pengguna");
				$("#password").attr("placeholder", "Kata Sandi");
				$("#repeat_password").attr("placeholder", "Ulangi Kata Sandi");
				$("#username").val("");
				$("#password").val("");
				$("#repeat_password").val("");
				$("#email").val("");
				$("#telpon").val("");
				$("#username").parent().children("br").removeClass("hidden");
				$("#password").parent().children("br").removeClass("hidden");
				$("#repeat_password").parent().children("br").removeClass("hidden");
				$("div.checkbox-replace").removeClass("checked");
			});

			$("#form-moderator").submit(function(e){
				var menu = [];
				e.preventDefault();

				$("#submit").html("<i class=\"entypo-plus\"></i>Proses");
				$("#submit").addClass("disabled");
				
				$("div.checkbox-replace.checked").each(function(index, value){
					var getMenu = $(this).children("#menu-lbl").attr("data-id");
					
					if(getMenu !== undefined){
						menu.push(getMenu);
					}
				});

				$.ajax({
					type: "POST",
					url: "/kospermindo/pengaturan/createmoderatorusers",
					data:{
						"username"  	: $("#username").val(),
						"password"   	: $("#password").val(),
						"email"			: $("#email").val(),
						"telp"			: $("#telpon").val(),
						"menu"			: JSON.stringify(menu)
					},
					success: function(data){
						msg = $.parseJSON(data);
						if(msg.message === "success"){
							window.location.reload(true);    
						}else if(msg.message === "failed"){
							$("#alert-modal").removeClass("hidden");
							$("#alert-modal .alert-custom").addClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-plus\"></i>Tambah");
									$("#submit").removeClass("disabled");
									$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
									$("#alert-modal .alert-custom").html("");
									$("#alert-modal").addClass("hidden");
								}, 1500);
						}else if(msg.message === "any_user"){
							$("#alert-modal").removeClass("hidden");
							$("#alert-modal .alert-custom").addClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal menambahkan data baru, Nama Pengguna Sudah Digunakan !");
							setTimeout(function() {
									$("#submit").html("<i class=\"entypo-plus\"></i>Tambah");
									$("#submit").removeClass("disabled");
									$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
									$("#alert-modal .alert-custom").html("");
									$("#alert-modal").addClass("hidden");
								}, 1500);
						}
					}
				});
			});

			$(document).on("click","#sunting", function(){
				$("#username").val("");
				$("#password").val("");
				$("#repeat_password").val("");
				$("#email").val("");
				$("#telpon").val("");
				$("#myModalLabel").text("Sunting Moderator");
				$("div.checkbox-replace").removeClass("checked");
				$.ajax({
					type: "POST",
					url: "/kospermindo/moderator/getmoderatorusers",
					data:{
						"id_users"   : $(this).attr("data-id"),
					},
					success: function(data){
						msg = $.parseJSON(data);
						$("#edit").attr("data-id",msg.id_users);
						$("#telpon").val(msg.telp);
						$("#email").val(msg.email);
						$("#edit").removeClass("hidden");
						$("#submit").addClass("hidden");
						$("div.checkbox#chk-username").removeClass("hidden");
						$("#username").addClass("hidden");
						$("#password").addClass("hidden");
						$("#repeat_password").addClass("hidden");
						$("#username").parent().children("br").addClass("hidden");
						$("#password").parent().children("br").addClass("hidden");
						$("#repeat_password").parent().children("br").addClass("hidden");
						$("#username").attr("placeholder", "Nama Pengguna Baru");
						$("#password").attr("placeholder", "Kata Sandi Baru");
						$("#repeat_password").attr("placeholder", "Ulangi Kata Sandi Baru");

						$.each($.parseJSON(msg.menu),function(index, value){
							$("#chk-"+value).addClass("checked");
						});
						
						$("#modal-insert").modal("show");

					}
				});
			});

			$(document).on("click", "div.checkbox-replace#chk-username", function(){
				if($(this).hasClass("checked")){
					$("#username").removeClass("hidden");
					$("#password").removeClass("hidden");
					$("#repeat_password").removeClass("hidden");
					$("#username").parent().children("br").removeClass("hidden");
					$("#password").parent().children("br").removeClass("hidden");
					$("#repeat_password").parent().children("br").removeClass("hidden");
				}else{
					$("#username").addClass("hidden");
					$("#password").addClass("hidden");
					$("#repeat_password").addClass("hidden");
					$("#username").parent().children("br").addClass("hidden");
					$("#password").parent().children("br").addClass("hidden");
					$("#repeat_password").parent().children("br").addClass("hidden");
				}
			});

			$("#edit").on("click", function(){
				var menu = [];
				$("#edit").html("<i class=\"entypo-floppy\"></i>Proses");
				$("#edit").addClass("disabled");
				$("div.checkbox-replace.checked").each(function(index, value){
					var getMenu = $(this).children("#menu-lbl").attr("data-id");
					
					if(getMenu !== undefined){
						menu.push(getMenu);
					}
				});
				$.ajax({
					type: "POST",
					url: "/kospermindo/pengaturan/updatemoderatorusers",
					data:{
						"id"			: $(this).attr("data-id"),
						"username"  	: $("#username").val(),
						"password"   	: $("#password").val(),
						"email"			: $("#email").val(),
						"telp"			: $("#telpon").val(),
						"menu"			: JSON.stringify(menu)
					},
					success: function(data){
						msg = $.parseJSON(data);

						if(msg.message === "success"){
							window.location.reload(true);    
						}else if(msg.message === "failed"){
							$("#alert-modal").removeClass("hidden");
							$("#alert-modal .alert-custom").addClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data pengguna");
							setTimeout(function() {
									$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
									$("#edit").removeClass("disabled");
									$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
									$("#alert-modal .alert-custom").html("");
									$("#alert-modal").addClass("hidden");
								}, 1500);
						}else if(msg.message === "any_user"){
							$("#alert-modal").removeClass("hidden");
							$("#alert-modal .alert-custom").addClass("alert-custom-danger");
							$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Gagal mengubah data pengguna, nama pengguna sudah digunakan !");
							setTimeout(function() {
									$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
									$("#edit").removeClass("disabled");
									$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
									$("#alert-modal .alert-custom").html("");
									$("#alert-modal").addClass("hidden");
								}, 1500);
						}
					}
				});
			});

			$(document).ajaxError(function( event, request, settings ) {
				$("#alert-modal").removeClass("hidden");
				$("#alert-modal .alert-custom").addClass("alert-custom-danger");
				$("#alert-modal .alert-custom").html("<i class=\"entypo-cancel\"></i> &nbsp;Proses gagal !");
				setTimeout(function() {
						$("#submit").html("<i class=\"entypo-plus\"></i>Tambah");
						$("#submit").removeClass("disabled");
						$("#edit").html("<i class=\"entypo-floppy\"></i>Sunting");
						$("#edit").removeClass("disabled");
						$("#alert-modal .alert-custom").removeClass("alert-custom-danger");
						$("#alert-modal .alert-custom").html("");
						$("#alert-modal").addClass("hidden");
					}, 1500);
			});

		});
		
	', CClientScript::POS_END);
?>




