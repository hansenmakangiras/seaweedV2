<style>
  .control-label {
    text-align: left !important;
  }
</style>

<div class="col-md-12">
<!--  <p>Silahkan mengisi form untuk data petani</p>-->
  <div class="panel minimal minimal-gray">
    <div class="panel-heading">
      <div class="panel-title">
      </div>

    </div>
    <div class="panel-body">
      <?php if (!empty($pesan)) { ?>
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
          <?= $pesan; ?>
        </div>
      <?php } ?>
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'book-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal validate',
        ),
      )); ?>
      <?php if ($update == 'no') { ?>
        <div class="form-group">
          <?php echo $form->labelEx($model, 'Lokasi Gudang', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-4">
            <!-- <?php echo $form->dropDownList($model, 'idkoordinator', $model->getIdKoordinator(Yii::app()->user->id, 1),
              array(
                'class'    => 'form-control',
                'data-validate' => 'required',
                'ajax'     => array(
                  'type'   => 'POST',
                  'url'    => CController::createUrl('petani/listkelompok'),
                  'data'   => array('nilai' => 'js:this.value'),
                  'update' => '#idkelompok',
                ),
              )); ?> -->
            <?php echo $form->dropDownList($model_gudang, 'lokasi',
              CHtml::listData(Gudang::model()->findAllByAttributes(array('status' => 1)), 'lokasi', 'lokasi'),
              array(
                'class'    => 'form-control',
                'prompt'   => 'Pilih Lokasi Gudang',
                'data-validate' => 'required',
                'ajax'     => array(
                  'type'    => 'POST',
                  'url'     => CController::createUrl('petani/listkelompok'),
                  'data'    => array('nilai' => 'js:this.value'),
                  'update'  => '#idkelompok',
                  'success' => 'function(resp){ $("#idkelompok").html(resp); }',
                ),
              )); ?>

          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model, 'Nama Kelompok', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-4">
            <?php //echo $form->dropDownList($model,'idkelompok',  array(),array('class'=>'form-control')); ?>
            <?php echo CHtml::dropDownList('idkelompok', '', array('prompt' => 'Pilih Kelompok Tani'),
              array('class' => 'form-control', 'data-validate' => 'required')); ?>
            <?php echo $form->error($model, 'level_id'); ?>
          </div>
        </div>
      <?php } ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Petani</label>
        <div class="col-sm-4">
          <?php echo $form->textField($model_petani, 'nama_petani',
            array('class' => 'form-control', 'data-validate' => 'required')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Alamat', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model_petani, 'alamat',
            array('size' => 50, 'maxlength' => 250, 'class' => 'form-control')); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Nomor Telepon', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model_petani, 'no_telp',
            array('class' => 'form-control', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Nomor Identitas', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model_petani, 'nmr_identitas',
            array('class' => 'form-control', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Tempat Lahir', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model_petani, 'tempat_lahir',
            array('class' => 'form-control', 'data-validate' => 'required')); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Tanggal Lahir', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
          <?php echo $form->textField($model_petani, 'tanggal_lahir',
            array('class' => 'form-control','data-mask' => "date", 'data-validate' => 'required')); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Jenis Rumput Laut', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-9">
          <label class="checkbox-inline"><input type="checkbox" value="1" name="jenisRumputLaut[]">Gracillaria KW 3</label>
          <label class="checkbox-inline"><input type="checkbox" value="2" name="jenisRumputLaut[]">Gracillaria KW 4</label>
          <label class="checkbox-inline"><input type="checkbox" value="3" name="jenisRumputLaut[]">Gracillaria BS</label>
          <label class="checkbox-inline"><input type="checkbox" value="4" name="jenisRumputLaut[]">Sango-Sango Laut</label>
          <label class="checkbox-inline"><input type="checkbox" value="5" name="jenisRumputLaut[]">Euchema Cotoni</label>
          <label class="checkbox-inline"><input type="checkbox" value="6" name="jenisRumputLaut[]">Spinosom</label>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Luas Lokasi', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-2">
          <?php echo $form->textField($model_petani, 'luas_lokasi',
            array('class' => 'form-control', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model_petani, 'Panjang Bentangan', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-2">
          <?php echo $form->textField($model_petani, 'jumlah_bentangan',
            array('class' => 'form-control', 'data-mask' => 'decimal', 'data-validate' => 'required')); ?>
        </div>
      </div>
      <?php if ($update == 'no') { ?>
        <div class="form-group">
          <?php echo $form->labelEx($model_petani, 'Jabatan', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-5">
            <label class="checkbox-inline"><input type="checkbox" value="1" name="ketua">Ketua Kelompok</label>
            <label class="checkbox-inline"><input type="checkbox" value="2" name="moderator">Moderator</label>
          </div>
        </div>
        <hr>

        <div class="form-group">
          <?php echo $form->labelEx($model, 'Pengguna', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-4">
            <?php echo $form->textField($model, 'username',
              array('class' => 'form-control', 'data-validate' => 'required')); ?>
            <?php echo $form->error($model, 'username'); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model, 'Sandi', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-4">
            <?php echo $form->passwordField($model, 'password',
              array('size' => 60, 'minlength' => 8, 'class' => 'form-control', 'data-validate' => 'required')); ?>
            <?php echo $form->error($model, 'password'); ?>
          </div>
        </div>
      <?php } ?>

      <div class="hr-dashed"></div>
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <?php echo CHtml::submitButton('S I M P A N', array("class" => "btn btn-success")); ?>
        </div>
      </div>

      <br>
      <br>
      <?php $this->endWidget(); ?>
    </div>
  </div>

</div>
<?php
  Yii::app()->clientScript->registerscript('new-farmer', '
		$(document).ready(function(){

			$(".fileinput .btn:nth-child(2)").hide();
			$(".fileinput input").change(function () {
				$(".fileinput .btn:nth-child(2)").show();
			});
			
			$(".fileinput .btn:nth-child(2)").click(function () {
				var x = $(".fileinput-preview img").length;
				if (x === 0) {
					$(".fileinput .btn:nth-child(2)").hide();
				}
			});

			$("#judul").change(function(){
				var d = new Date(),
					link = window.location.protocol + "//" + window.location.hostname + "/post/"+ d.getFullYear() + "/" + d.getMonth() + "/" + encodeURI($("#judul").val().toLowerCase().replace(/\s/g,"+"));
				$.ajax({
					type: "POST",
					url: "/dtcms/post/getlink",
					data:{
						"link"   : link,
					},
					success: function(data){
						msg = $.parseJSON(data);

						if(msg.message === "success"){
							$("#permalink b").html("Permalink :");
							$("#permalink a").attr("href", msg.url);
							$("#permalink a").html(msg.url);
						}else{
							$("#permalink b").html("Permalink :");
							$("#permalink a").html("-");
						}
					}
				});

			});

			$("#save-draft").on("click", function(){
				var formData = new FormData(),
					input_img = $("#input_img").prop("files")[0],
					kat = "",
					getKat = "";

				formData.append("input_img", input_img);
				formData.append("judul", $("#judul").val());
				formData.append("konten", CKEDITOR.instances.editor.document.getBody().getText());
				formData.append("konten_html", CKEDITOR.instances.editor.getData());
				
				if($("#chk-komentar").is(":checked")){
					formData.append("komentar", "open");
				}else{
					formData.append("komentar", "closed");
				}

				$("div.checkbox-replace.checked").each(function(index, value){
					var getKat = $(this).children("#kategori-lbl").html();
					if(getKat !== undefined){
						kat = kat + getKat + ",";
					}
				});

				formData.append("kategori", kat);
				formData.append("keyword", $("#keyword").val());
				formData.append("status", "draft");
				formData.append("type", "post");
				formData.append("url", $("#permalink a").html());
				$("#save-draft").addClass("disabled");
				$("#save-draft").html("Proses...");
				$.ajax({
				    url: "/dtcms/post/createpost",
				    type: "POST",
				    data: formData,
				    dataType: "script",
				    cache: false,
				    contentType: false,
				    processData: false,
				    success: function(data) {
				    	msg = $.parseJSON(data);

				    	if(msg == "success"){
							$("#modal-message-body p").html("Berita Baru Telah Berhasil Ditambahkan");
							jQuery("#message").modal("show");
						}else{
							$("#modal-message-body p").html("Berita Baru Gagal Ditambahkan, Coba Ulangi!");
							jQuery("#message").modal("show");
				    	}
				    }
				});
			
			});			

			$("#done").on("click", function(){
				window.location.reload(true);
			});

			$("#publish-pos").on("click", function(){
				var formData = new FormData(),
					input_img = $("#input_img").prop("files")[0],
					kat = "",
					getKat = "";

				formData.append("input_img", input_img);
				formData.append("judul", $("#judul").val());
				formData.append("konten", CKEDITOR.instances.editor.document.getBody().getText());
				formData.append("konten_html", CKEDITOR.instances.editor.getData());
				formData.append("url", $("#permalink a").html());
				
				if($("#chk-komentar").is(":checked")){
					formData.append("komentar", "open");
				}else{
					formData.append("komentar", "closed");
				}

				$("div.checkbox-replace.checked").each(function(index, value){
					var getKat = $(this).children("#kategori-lbl").html();
					if(getKat !== undefined){
						kat = kat + getKat + ",";
					}
				});

				formData.append("kategori", kat);
				formData.append("keyword", $("#keyword").val());
				formData.append("status", "publish");
				formData.append("type", "post");
				
				$("#publish-pos").addClass("disabled");
				$("#publish-pos").html("Proses...");
				$.ajax({
				    url: "/dtcms/post/createpost",
				    type: "POST",
				    data: formData,
				    dataType: "script",
				    cache: false,
				    contentType: false,
				    processData: false,
				    success: function(data) {
				    	msg = $.parseJSON(data);

				    	if(msg == "success"){
							$("#modal-message-body p").html("Berita Baru Telah Berhasil Ditambahkan");
							jQuery("#message").modal("show");
						}else{
							$("#modal-message-body p").html("Berita Baru Gagal Ditambahkan, Coba Ulangi!");
							jQuery("#message").modal("show");
				    	}
				    }
				});
			
			});

		});

	', CClientScript::POS_END);
?>