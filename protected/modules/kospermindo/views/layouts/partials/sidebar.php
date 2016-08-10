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
	<li
		class="<?= ($active == 'petani' || $active == 'gudang' || $active == 'groups' || $active == 'warehouse' || $active == 'moderator') ? 'active opened active' : ''; ?>" data-nav="master">

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

	<li
		class="<?= ($active == 'mgudang' || $active == 'mkelompok' || $active == 'mpetani' || $active == 'mmoderator' || $active == 'mkomoditi') ? 'active opened active' : ''; ?>"
		data-nav="manage-user">

		<a href="#">
			<i class="entypo-user-add"></i>
			<span>Manajemen Pengguna</span>
		</a>
		<ul>
			<li class="<?= $active == 'mmoderator' ? 'active' : ''; ?>">
				<a href="<?= $this->baseUrl ?>/kospermindo/users/moderator">
					<span>Moderator</span>
				</a>
			</li>
		</ul>
	</li>
	<!-- Report Menu -->
	<li
		class="<?= ($active == 'rkomoditi' || $active == 'rpetani' || $active == 'rkelompok' || $active == 'rgudang') ? 'active opened active' : ''; ?>"
		data-nav="report">
		<a href="#">
			<i class="entypo-docs"></i>
			<span>Laporan</span>
		</a>
		<ul>
			<li>
				<a href="<?= $this->baseUrl ?>/kospermindo/laporan/gudang">
					<span>Laporan Gudang</span>
				</a>
			</li>
			<li class="<?= $active == 'rkelompok' ? 'active' : ''; ?>">
				<a href="<?= $this->baseUrl ?>/kospermindo/laporan/kelompok">
					<span>Laporan Kelompok</span>
				</a>
			</li>
			<li class="<?= $active == 'rkomoditi' ? 'active' : ''; ?>">
				<a href="<?= $this->baseUrl ?>/kospermindo/laporan/komoditi">
					<span>Laporan Komoditi</span>
				</a>
			</li>
			<li class="<?= $active == 'rpetani' ? 'active' : ''; ?>">
				<a href="<?= $this->baseUrl ?>/kospermindo/laporan/petani">
					<span>Laporan Petani</span>
				</a>
			</li>
			<li>
				<a href="<?= $this->baseUrl ?>/kospermindo/users/panen">
					<span>Laporan Produksi</span>
				</a>
			</li>
			<li>
				<a href="<?= $this->baseUrl ?>/kospermindo/users/gudang">
					<span>Laporan Stok Barang</span>
				</a>
			</li>
		</ul>
	</li>
</ul>


