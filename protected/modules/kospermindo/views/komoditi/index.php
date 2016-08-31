<?php
	Yii::app()->clientScript->registerScript('search', "
		var element = $('#main-menu li[data-nav=\"master\"]');
		element.addClass('active opened');
		element.find('ul').addClass('visible');
		element.find('ul li:nth-child(4)').addClass('active');
");
?>

<div class="headline">
	<ol class="breadcrumb bc-3">
		<li>
			<a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
		</li>
		<li class="active">
			<strong><?php echo 'Data Komoditi'; ?></strong>
		</li>
	</ol>
	<h2>Manajemen Data Komoditi</h2><br/>
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

<div class="row">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert"
								id="btn-tmbh"><i class="entypo-plus"></i>Tambah
				</button>
				<br>
				<br>
				<br>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="tblwarehouse" class="table table-bordered table-responsive table-hover">
					<thead>
					<tr>
						<th class="text-center" width="5%">No</th>
						<th class="text-center">Jenis Komoditi</th>
						<th class="text-center">Sub Komoditi</th>
						<th class="text-center" width="200px">Aksi</th>
					</tr>
					<thead>

					<tbody>
					<?php if (!empty($jenis)) { ?>
						<?php $i = !empty($_GET['page']) ? (($_GET['page'] - 1) * 10) + 1 : 1;
						foreach ($jenis as $key => $value) { ?>
							<tr>
								<td class="text-center"><?= $i++; ?></td>
								<td id="val-jenis"><?= $value['jenis'] ?></td>
								<td><?= $value['sub'] ?></td>
								<td>
									<a class="btn btn-default btn-sm btn-icon icon-left" id="sunting" data-id="<?= $value['id'] ?>"
										 data-parent-id="<?= $value['parent_id'] ?>" href="#"><i class="entypo-pencil"></i>Sunting</a>
									<a href="#" data-id="<?= $value['id'] ?>" id="hapus-komo"
										 class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i
											class="entypo-trash"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					<?php } else { ?>
						<td colspan="10" class="text-center">Tidak ada hasil ditemukan</td>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12 center">
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


<!-- Modal -->
<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Komoditi</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form action="/kospermindo/komoditi" method="POST" class="form-horizontal" id="form-komoditi">
							<div class="form-group" style="margin-bottom: 0;">

								<div class="col-md-12">
									<input type="text" placeholder="Jenis Komoditi" name="" id="jenis" class="form-control input-lg"
												 required>
									<br>

									<select name="" id="sub-komoditi" class="form-control input-lg">
										<option value="0">Bukan Sub Komoditi</option>
									</select>
								</div>

								<div class="col-md-12">
									<br>
									<div class="alert hidden"><strong></strong></div>
									<br>
									<div class="pull-right">
										<button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>Tambah
										</button>
										<a id="edit" class="btn btn-info btn-lg" data-id=""><i class="entypo-pencil"></i>Sunting</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	var baseurl;
</script>

<?php
	Yii::app()->clientScript->registerScript('close-alert', '
	setTimeout(function() {
		$("#alert-flash").addClass("hidden");
	}, 1500);

	$("#modal-insert").prependTo("#modal-view");
	
	$("#form-komoditi").submit(function(e){
		e.preventDefault();
		 
		$("#submit").html("<i class=\"entypo-plus\"></i>Proses");
		$("#submit").addClass("disabled");

		$.ajax({
			type: "POST",
			url: "/kospermindo/komoditi/create",
			data:{
				"jenis"   : $("#jenis").val(),
				"sub"	: $("#sub-komoditi").val()
			},
			success: function(data){
				msg = $.parseJSON(data);
				if(msg.message === "success"){
					window.location.reload(true);
				}else{
					window.location.reload(true);
				}
			}
		});

	});

	$.ajax({
		type: "POST",
		url: "/kospermindo/komoditi/listjenis",
		data:{
		},
		success: function(data){
			msg = $.parseJSON(data);
			$("#sub-komoditi").empty();
			$("#sub-komoditi").end();
			$("#sub-komoditi").append("<option value=\"0\">Bukan Sub Komoditi</option>");
			$.each(msg, function(i, v){
				$("#sub-komoditi").append("<option value=\""+ v.id +"\">"+ v.jenis +"</option>");
			});
		}
	});

	$("#edit").on("click", function(){
		if($("#jenis").val() === $("#sub-komoditi").val()){
			$(".alert strong").html("Jenis Komoditi dan Sub harus berbeda !");
			$(".alert").removeClass("hidden");
			$(".alert").addClass("alert-success");
		}else{
			$("#edit").html("<i class=\"entypo-pencil\"></i>Proses");
			$("#edit").addClass("disabled");
			$.ajax({
				type: "POST",
				url: "/kospermindo/komoditi/update",
				data:{
					"jenis"   : $("#jenis").val(),
					"sub"	  : $("#sub-komoditi").val(),
					"id"      : $(this).attr("data-id")
				},
				success: function(data){
					msg = $.parseJSON(data);

					if(msg.message === "success"){
						window.location.reload(true);
					}else{
						window.location.reload(true);

					}
				}
			});
		}
	});

	$("#btn-tmbh").on("click", function(){
		$("#myModalLabel").html("Tambah Komoditi");
		$("#edit").addClass("hidden");
		$("#submit").removeClass("hidden");
		$("#sub-komoditi").val("0");
		$("#jenis").val("");
	});

	$(document).on("click","#sunting", function(){
		$("#sub-komoditi").val($(this).attr("data-parent-id"));
		$("#jenis").val($(this).parent("td").parent("tr").children("#val-jenis").html());
		$("#myModalLabel").html("Ubah Komoditi");
		$("#edit").attr("data-id", $(this).attr("data-id"));
		$("#edit").removeClass("hidden");
		$("#submit").addClass("hidden");
		$("#modal-insert").modal("show");

	});

	$("#konfirm-yes").on("click", function(){
		$.ajax({
			type: "POST",
			url: "/kospermindo/komoditi/delete",
			data:{
				"id"      : $(this).attr("data-id")
			},
			success: function(data){
				msg = $.parseJSON(data);

				if(msg.message === "success"){
					window.location.reload(true);
				}else{
					window.location.reload(true);
				}
			}
		});		
	});

	$(document).on("click","#hapus-komo", function(){
		$("#konfirm-yes").attr("data-id", $(this).attr("data-id"));
		$("#konf-del-komoditi").modal("show");
	});

	', CClientScript::POS_END);
?>
