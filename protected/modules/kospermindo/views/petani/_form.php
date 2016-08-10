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
			
				<div class="form-group">
					<label class="col-sm-2 control-label">Lokasi Gudang</label>
					
					<div class="col-sm-4">
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
					<label class="col-sm-2 control-label">Nama Kelompok</label>
					
					<div class="col-sm-4">
						<?php //echo $form->dropDownList($model,'idkelompok',  array(),array('class'=>'form-control')); ?>
						<?php echo CHtml::dropDownList('idkelompok', '', array('prompt' => 'Pilih Kelompok Tani'),
							array('class' => 'form-control', 'data-validate' => 'required')); ?>
						
					</div>
				</div>
			
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
