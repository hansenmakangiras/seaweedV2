<?php
	$active = Helper::getActiveState(Yii::app()->request->url, "kospermindo");
?>

<ul id="main-menu" class="auto-inherit-active-class">
	<li id="search">
		<?php echo CHtml::form(Yii::app()->createUrl('/kospermindo/search'), 'get') ?>
		<?php echo CHtml::textField('q', isset($_GET['q']) ? $_GET['q'] : '',
			array('class' => 'search-input', 'placeholder' => 'Search something...', 'name' => 'q')) ?>
		<button type="submit">
			<i class="entypo-search"></i>
		</button>
		<?php echo CHtml::endForm() ?>
	</li>
	<li class="<?= $active == 'beranda' ? 'active' : ''; ?>">
		<a href="<?= Kospermindo::getBaseUrl(); ?>">
			<i class="entypo-gauge"></i>
			<span>Beranda</span>
		</a>
	</li>
	<?php if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){ ?>
		<li
			class="<?= ($active == 'petani' || $active == 'gudang' || $active == 'groups' || $active == 'warehouse') ? 'active opened active' : ''; ?>" data-nav="master">

			<a href="#">
				<i class="entypo-database"></i>
				<span>Manajemen Data</span>
			</a>
			<ul>
				<li class="<?= $active == 'warehouse' ? 'active' : ''; ?>">
					<a href="<?= $this->baseUrl ?>/kospermindo/gudang">
						<span>Data Gudang </span>
					</a>
				</li>
				<li class="<?= $active == 'groups' ? 'active' : ''; ?>">
					<a href="<?= $this->baseUrl ?>/kospermindo/kelompok">
						<span>Data Kelompok</span>
					</a>
				</li>
				<li class="<?= $active == 'petani' ? 'active' : ''; ?>">
					<a href="<?= $this->baseUrl ?>/kospermindo/petani">
						<span>Data Petani</span>
					</a>
				</li>
				<li>
					<a href="<?= $this->baseUrl ?>/kospermindo/komoditi">
						<span>Data Komoditi</span>
					</a>
				</li>
			</ul>
		</li>
	<?php } ?>
	<?php if(Yii::app()->user->akses == 1){ ?>
		<!-- <li data-nav="moderator">
			<a href="/kospermindo/moderator" class="no-margin">
				<i class=" entypo-user"></i>
				<span>Moderator</span>
			</a>
		</li> -->
	<?php } ?>
	<?php if(Yii::app()->user->akses == 3){ ?>
		<li data-nav="produksi">
			<a href="/kospermindo/produksi" class="no-margin">
				<i class="entypo-leaf"></i>
				<span>Hasil Produksi</span>
			</a>
		</li>
	<?php }else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("2", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){ ?>
		<li data-nav="produksi">
			<a href="/kospermindo/produksi/admin" class="no-margin">
				<i class="entypo-leaf"></i>
				<span>Hasil Produksi</span>
			</a>
		</li>
	<?php } ?>
	<?php if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("3", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){ ?>
		<li
			class="<?= ($active == 'rkomoditi' || $active == 'rpetani' || $active == 'rkelompok' || $active == 'rgudang') ? 'active opened active' : ''; ?>"
			data-nav="laporan">
			<a href="#">
				<i class="entypo-docs"></i>
				<span>Laporan</span>
			</a>
			<ul>
				<li>
					<a href="/kospermindo/laporan/gudang">
						<span>Laporan Gudang</span>
					</a>
				</li>
				<li class="<?= $active == 'rkelompok' ? 'active' : ''; ?>">
					<a href="/kospermindo/laporan/kelompok">
						<span>Laporan Kelompok</span>
					</a>
				</li>
				<li class="<?= $active == 'rpetani' ? 'active' : ''; ?>">
					<a href="/kospermindo/laporan/petani">
						<span>Laporan Petani</span>
					</a>
				</li>
			</ul>
		</li>
	<?php } ?>
	<?php if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("4", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){ ?>
		<li class="<?= $active == 'pesan' ? 'active' : ''; ?>">
			<a href="/kospermindo/pesan" class="no-margin">
				<i class=" entypo-mail"></i>
				<span>Pesan</span>
			</a>
		</li>
	<?php } ?>
	<?php if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("5", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){ ?>
		<li data-nav="harga">
			<a href="/kospermindo/harga" class="no-margin">
				<i class=" entypo-tag"></i>
				<span>Info Harga</span>
			</a>
		</li>
	<?php } ?>
	<?php if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("6", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){ ?>
		<li
			class="<?= ($active == 'pcallcenter' || $active == 'pmoderator' || $active == 'pprakiraan') ? 'active opened active' : ''; ?>"
			data-nav="pengaturan">
			<a href="#">
				<i class="entypo-docs"></i>
				<span>Pengaturan</span>
			</a>
			<ul>
				<li>
					<a href="/kospermindo/pengaturan">
						<span>Pusat Informasi</span>
					</a>
				</li>
<!-- 				<li class="<?= $active == 'pprakiraan' ? 'active' : ''; ?>">
	<a href="/kospermindo/pengaturan/prakiraanpendapatan">
		<span>Prakiraan Pendapatan</span>
	</a>
</li> -->
				<?php if(Yii::app()->user->akses == 1){ ?>
					<li class="<?= $active == 'pmoderator' ? 'active' : ''; ?>">
						<a href="/kospermindo/pengaturan/moderator">
							<span>Moderator</span>
						</a>
					</li>
				<?php } ?>
			</ul>
		</li>
	<?php } ?>

</ul>