<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"pengaturan\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible').removeAttr('style');
		element.find('ul').find('li:nth-child(1)').addClass('active');
");
?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<b>Pengaturan Pusat Informasi</b>
		</li>
	</ol>
	<h2>Pengaturan Pusat Informasi</h2><br/>
</div>

<div class="row">
	<div class="col-md-12">
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

<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="#" id="form-pengaturan">

	<div class="row">
		<div class="col-md-8">

			
			<div class="form-group">
				<div class="col-md-12">
					<label>Nomor Telpon 1</label>
				</div>
				<div class="col-md-6">
						<input type="text" id="cc1" value="<?= $users['username'] ?>" class="form-control input-lg" name="cc1" maxlength="15" data-validate="required" placeholder="Masukkan Nama" disabled/>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">+62</span>
						<input type="text" id="telpon" value="<?= substr($users['no_handphone'], 3, strlen($users['no_handphone'])) ?>" class="form-control input-lg" name="telpon" maxlength="15" data-validate="required" placeholder="Nomor Telpon"/>
					</div>
				</div>
			</div>
			<?php if(!empty($allKontak)) { ?>
				<?php $i=2; foreach ($allKontak as $key => $value) { ?>
					<div class="form-group">
						<div class="col-md-12">
							<label>Nomor Telpon <?= $i;?></label>
						</div>
						<div class="col-md-6">
							<input type="text" id="cc<?= $i;?>" value="<?= $value['kontak'];?>" class="form-control input-lg" name="cc2" data-name="cc<?= $i;?>" maxlength="15" data-validate="required" placeholder="Masukkan Nama"/>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">+62</span>
								<input type="text" id="telpon<?= $i;?>" value="<?= substr($value['telp'], 3, strlen($value['telp']))?>" class="form-control input-lg" name="telpon2" maxlength="15" data-validate="required" placeholder="Nomor Telpon" />
							</div>
						</div>
					</div>	
				<?php $i++; } ?>
			<?php }else{ ?>
			<div class="form-group">
				<div class="col-md-12">
					<label>Nomor Telpon 2</label>
				</div>
				<div class="col-md-6">
					<input type="text" id="cc2" class="form-control input-lg" name="cc2" data-name="" maxlength="15" placeholder="Masukkan Nama"/>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">+62</span>
						<input type="text" id="telpon2" class="form-control input-lg" name="telpon2" maxlength="15"  placeholder="Nomor Telpon" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<label>Nomor Telpon 3</label>
				</div>
				<div class="col-md-6">
					<input type="text" id="cc3" class="form-control input-lg" name="cc3" maxlength="15"  placeholder="Masukkan Nama" data-name2=""/>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">+62</span>
						<input type="text" id="telpon3" class="form-control input-lg" name="telpon3" maxlength="15"  placeholder="Nomor Telpon"/>
					</div>
				</div>
			</div>
			<?php }?>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12">
			<br>

			<div class="form-group" style="margin-bottom: 50px;">
				<div class="col-md-12">
					<button type="submit" class="btn btn-success btn-lg"><i class="entypo-check"></i> Simpan</button>
				</div>
			</div>

		</div>

		<br>

	</div>

</form>


<script>
	var baseurl;
</script>
<?php
	Yii::app()->clientScript->registerScript('close-alert', '
	setTimeout(function() {
		$("#alert-flash").addClass("hidden");
	}, 5000);

	$("#modal-insert").prependTo("#modal-view");
	 
	$("#form-pengaturan").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "/kospermindo/pengaturan/update",
			data:{
				"telp"  	: $("#telpon").val(),
				"telp2"		: $("#telpon2").val(),
				"telp3"		: $("#telpon3").val(),
				"cc2"		: $("#cc2").val(),
				"cc3"		: $("#cc3").val(),
				"cc2name"	: $(this).attr("data-name"),
				"cc3name"	: $(this).attr("data-name2"),
			},
			success: function(data){
				msg = $.parseJSON(data);
				window.location.reload(true);
			}
		});
	});

	

	', CClientScript::POS_END);
?>
