<?php

	class LaporanController extends KController
	{
		public function actionIndex()
		{

			$this->render('index', array(

			));
		}

		public function ActionDetil($id)
		{
			$isFarmer = TabelPetani::model()->findByAttributes(array('id' => $id));
			$isFarmerKomoditi = Komoditi::model()->findAllByAttributes(array('id_user' => $isFarmer->id_user));
			$this->render('detil', array(
				'isFarmer'         => $isFarmer,
				'isFarmerKomoditi' => $isFarmerKomoditi,
			));
		}

		public function actionGetData()
		{
			$data = array(
				array("tipe_seaweed"=> "KW3", "Total Panen" => 100),
				array("tipe_seaweed"=> "KW4", "Total Panen" => 50),
				array("tipe_seaweed"=> "BS", "Total Panen" => 68),
				array("tipe_seaweed"=> "Sango-Sango Laut", "Total Panen" => 85),
				array("tipe_seaweed"=> "Euchema Cotoni", "Total Panen" => 95),
				array("tipe_seaweed"=> "Spinosom", "Total Panen" => 40),
			);
			 echo CJSON::encode($data);
		}

		public function actionProduksi(){
			$this->render('report_produksi');
		}

		public function actionKomoditi()
		{
			$isGroupAll = array();
			$isfarmergroup = array();
			$totalpanenpetani = array();

			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}
			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSumPanen();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));

			$groups = TabelKelompok::model()->findAllByAttributes(array('status' => 1));
			$cek = VKomoditibygroup::model()->findAll();
			$romi = array();
			foreach ($groups as $key => $valuee) {
				foreach ($cek as $key => $value) {
					if ($value->idkelompok == $valuee->id_user) {
						array_push($romi, $value->total);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$apa = array();
			$aku = array();
			$kamu = array();
			$allkelompok = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			foreach ($allkelompok as $value) {
				$isPetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
				// $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
				$apa[] = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
			}
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));
			$cek = VKomoditibygroup::model()->findAll();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
			foreach ($isCoordinator as $key => $value) {
				$isGroupAll[] = Gudang::model()->countByAttributes(array('lokasi' => $value->lokasi));
			}

			$tes = VKomoditibygroup::model()->getTotalPanen();
			$totalpanengroup = array();
			foreach ($isCoordinator as $key => $valuee) {
				foreach ($tes as $key => $value) {
					if ($value['lokasi'] == $valuee['lokasi']) {
						array_push($totalpanengroup, $value['total']);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$isfarmer = TabelPetani::model()->findAllByAttributes(array('status' => 1));
			foreach ($isfarmer as $key => $value) {
				$isfarmergroup[] = Pengguna::model()->getgroup($value->idkelompok);
				$totalpanenpetani[] = Komoditi::model()->getPanenFarmer($value->id_user);
			}
			$this->render('report_komoditi', array(
				'allFarmers'       => $allFarmers,
				'allGroups'        => $allGroups,
				'allWarehouses'    => $allWarehouses,
				'summary'          => $summary,
				'warehouse'        => $isCoordinator,
				'groups'           => $groups,
				'farmers'          => $farmers,
				'allkelompok'      => $apa,
				'totalpanen'       => $romi,
				'total_panen'      => $totalpanengroup,
				'total_group'      => $isGroupAll,
				'allfarmerMenu'    => $isfarmer,
				'farmergroup'      => $isfarmergroup,
				'totalpanenpetani' => $totalpanenpetani,
			));
		}

		public function actionPetani()
		{
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("3", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

				$gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

				$arrJnsKomoditi = array();
				$jenis_komoditi = array();
				$petani = array();
				$id = '';
				$range = '';

				if (Yii::app()->user->hasFlash('id_petani') && Yii::app()->user->hasFlash('id_kelompok') && Yii::app()->user->hasFlash('id_gudang') && Yii::app()->user->hasFlash('start') && Yii::app()->user->hasFlash('end')) {
					$id_gudang = CHtml::encode(Yii::app()->user->getFlash('id_gudang'));
					$id_klpk = CHtml::encode(Yii::app()->user->getFlash('id_kelompok'));
					$id_petani = CHtml::encode(Yii::app()->user->getFlash('id_petani'));
					$startFlash = CHtml::encode(Yii::app()->user->getFlash('start'));
					$endFlash = CHtml::encode(Yii::app()->user->getFlash('end'));
					$start = date("Y-m-d", strtotime(str_replace('/', '-', $startFlash)));
					$end = date("Y-m-d", strtotime(str_replace('/', '-', $endFlash)));
					$range = $startFlash.' - '.$endFlash;
					$get_gudang = Gudang::model()->findAllByAttributes(array('id_gudang'=>$id_gudang, 'status'=>0));
					$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
					$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang, 'status'=>0));				
					$get_kelompok = Kelompok::model()->findAllByAttributes(array('id_kelompok'=>$id_klpk, 'status'=>0));				
					$kode_kelompok = !empty($get_kelompok) ? $get_kelompok[0]['kode_kelompok'] : '0';
					$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'kode_kelompok'=>$kode_kelompok,'status_hapus'=>0));
					
					$id_jenis = '';
					foreach ($petani as $key => $valjenis) {
						foreach (json_decode($valjenis->jenis_komoditi) as $key => $validjns) {
							$id_jenis = $id_jenis.','.$validjns->id;
						}
					}

					$id_jenis_komo = array_unique(explode(",", $id_jenis));
					
					$arrJnsKomoditi = array_filter($id_jenis_komo, create_function('$value', 'return $value !== "";'));

					foreach ($arrJnsKomoditi as $key => $valjk) {
						$seaweed = array('id'=>$valjk, 'jumlah'=>Seaweed::model()->getJenisperdate($valjk, $start, $end));
						array_push($jenis_komoditi, $seaweed);
					}

				}else{

					$start = date("Y-m-01");
					$end = date("Y-m-t");

					$range = date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($end));
					$get_gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

					$id_gudang = !empty($get_gudang) ? $get_gudang[0]['id_gudang'] : '0';
					$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
					$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang));
					$id_klpk = !empty($kelompok) ? $kelompok[0]['id_kelompok'] : '0';
					$kode_kelompok = !empty($kelompok) ? $kelompok[0]['kode_kelompok'] : '0';

					$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'kode_kelompok'=>$kode_kelompok,'status_hapus'=>0));
					$id_petani = !empty($petani) ? $petani[0]['id_petani'] : '0';
					$id_jenis = '';
					foreach ($petani as $key => $valjenis) {
						foreach (json_decode($valjenis->jenis_komoditi) as $key => $validjns) {
							$id_jenis = $id_jenis.','.$validjns->id;
						}
					}

					$id_jenis_komo = array_unique(explode(",", $id_jenis));
					
					$arrJnsKomoditi = array_filter($id_jenis_komo, create_function('$value', 'return $value !== "";'));

					foreach ($arrJnsKomoditi as $key => $valjk) {
						$seaweed = array('id'=>$valjk, 'jumlah'=>Seaweed::model()->getJenisperdate($valjk, $start, $end));
						array_push($jenis_komoditi, $seaweed);
					}
				}

				$this->render('report_petani', array(
					'gudang' => $gudang,
					'kelompok'=>$kelompok,
					'petani' => $petani,
					'jenis_komoditi'=>$jenis_komoditi,
					'petani' => $petani,
					'id_gudang' => $id_gudang,
					'id_klpk' => $id_klpk,
					'id_tani' => $id_petani,
					'range' => $range
				));
			}else{
				$this->redirect('/kospermindo');

			}
		}

		public function actionChartpetani(){
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
			$idKelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';
			$idPetani = !empty($_POST['id_petani']) ? $_POST['id_petani'] : '';
			$start = !empty($_POST['start']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['start']))) : '';
			$end = !empty($_POST['end']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['end']))) : '';

			$chart = array();
			$chartinarr = array();
			$getchart = Seaweed::model()->getAllJenisPetani($start, $end, $id_gudang, $idKelompok, $idPetani);

			$chartJenis = array();
			$chartLabel = array();
			$chartLabelJenis = array();
			$chartyKeys = array();
			$total_panen = 0;

			$getDate = Seaweed::model()->getDatePetani($start, $end, $id_gudang, $idKelompok, $idPetani);
			foreach ($getDate as $key => $valdate) {
				$keys = array();
				$arrval = array();
				$keys[] = "y";
				$arrval[] = date('Y-m-d', strtotime($valdate['created_date']));
				foreach ($getchart as $key => $valChart) {
					$valGetDate = Seaweed::model()->getDayPetani(date('Y-m-d', strtotime($valdate['created_date'])),$valChart['id_seaweed'], $idKelompok,$idPetani);
					$keys[] = $valChart['id_seaweed'];
					$arrval[] = (!empty($valGetDate[0]['count'])) ? (float)$valGetDate[0]['count']/1000 : '0';
					array_push($chartLabel, $valChart['id_seaweed']);
				}
				$chartin = array_combine($keys, $arrval);
				array_push($chart, $chartin);
			}

			$countJenis = array();
			foreach (array_unique($chartLabel) as $key => $vl) {
				$komoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$vl, 'status'=>0));
				if(!empty($komoditi)){
					$getcount = Seaweed::model()->getCountPetani($start,$end,$id_gudang, $idKelompok, $idPetani, $komoditi['id_komoditi']);
					$total_panen = $total_panen + number_format((float)$getcount[0]['count']/1000, 2, '.', '');
					$countJenis[] = array($komoditi['id_komoditi'] => number_format((float)$getcount[0]['count']/1000, 2, '.', ''));
					array_push($chartyKeys, $komoditi['id_komoditi']);
					array_push($chartLabelJenis, $komoditi['jenis']);
				}
			}


			$arr = array('data'=>$chart, 
				'label'=>$chartLabelJenis,
				'ykeys' => $chartyKeys, 
				'hasil_panen'=>number_format((float)$total_panen, 2, '.', ''),
				'count_jenis'=>$countJenis,

			);
			array_push($chartJenis, $arr);

			echo json_encode($chartJenis);
		}

		public function actionGetpetani(){
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
			$idKelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';
			$idPetani = !empty($_POST['id_petani']) ? $_POST['id_petani'] : '';
			$start = !empty($_POST['start']) ? $_POST['start'] : '';
			$end = !empty($_POST['end']) ? $_POST['end'] : '';

			Yii::app()->user->setFlash('id_kelompok',$idKelompok);
			Yii::app()->user->setFlash('id_petani',$idPetani);
			Yii::app()->user->setFlash('id_gudang',$id_gudang);
			Yii::app()->user->setFlash('start',$start);
			Yii::app()->user->setFlash('end',$end);

			$pesan = array('message'=>'success');

			echo json_encode($pesan);
		}

		public function actionKelompok()
		{
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("3", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

				$gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

				$arrJnsKomoditi = array();
				$jenis_komoditi = array();
				$petani = array();
				$id = '';
				$range = '';

				if (Yii::app()->user->hasFlash('id_kelompok') && Yii::app()->user->hasFlash('id_gudang') && Yii::app()->user->hasFlash('start') && Yii::app()->user->hasFlash('end')) {
					$id_gudang = CHtml::encode(Yii::app()->user->getFlash('id_gudang'));
					$id_klpk = CHtml::encode(Yii::app()->user->getFlash('id_kelompok'));
					$startFlash = CHtml::encode(Yii::app()->user->getFlash('start'));
					$endFlash = CHtml::encode(Yii::app()->user->getFlash('end'));
					$start = date("Y-m-d", strtotime(str_replace('/', '-', $startFlash)));
					$end = date("Y-m-d", strtotime(str_replace('/', '-', $endFlash)));
					$range = $startFlash.' - '.$endFlash;

					$get_gudang = Gudang::model()->findAllByAttributes(array('id_gudang'=>$id_gudang, 'status'=>0));
					$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
					$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang, 'status'=>0));				
					$get_kelompok = Kelompok::model()->findAllByAttributes(array('id_kelompok'=>$id_klpk, 'status'=>0));				
					$kode_kelompok = !empty($get_kelompok) ? $get_kelompok[0]['kode_kelompok'] : '0';
					$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang, 'kode_kelompok'=>$kode_kelompok, 'status_hapus'=>0));
					
					$id_jenis = '';
					foreach ($petani as $key => $valjenis) {
						foreach (json_decode($valjenis->jenis_komoditi) as $key => $validjns) {
							$id_jenis = $id_jenis.','.$validjns->id;
						}
					}

					$id_jenis_komo = array_unique(explode(",", $id_jenis));
					
					$arrJnsKomoditi = array_filter($id_jenis_komo, create_function('$value', 'return $value !== "";'));

					foreach ($arrJnsKomoditi as $key => $valjk) {
						$seaweed = array('id'=>$valjk, 'jumlah'=>Seaweed::model()->getJenisperdate($valjk, $start, $end));
						array_push($jenis_komoditi, $seaweed);
					}

				}else{

					$start = date("Y-m-01");
					$end = date("Y-m-t");

					$range = date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($end));
					$get_gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));
					$id_gudang = !empty($get_gudang) ? $get_gudang[0]['id_gudang'] : '0';
					$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
					$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang));
					$id_klpk = !empty($kelompok) ? $kelompok[0]['id_kelompok'] : '0';
					$kode_kelompok = !empty($kelompok) ? $kelompok[0]['kode_kelompok'] : '0';

					$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'kode_kelompok'=>$kode_kelompok,'status_hapus'=>0));
					$id_jenis = '';
					foreach ($petani as $key => $valjenis) {
						foreach (json_decode($valjenis->jenis_komoditi) as $key => $validjns) {
							$id_jenis = $id_jenis.','.$validjns->id;
						}
					}

					$id_jenis_komo = array_unique(explode(",", $id_jenis));
					
					$arrJnsKomoditi = array_filter($id_jenis_komo, create_function('$value', 'return $value !== "";'));

					foreach ($arrJnsKomoditi as $key => $valjk) {
						$seaweed = array('id'=>$valjk, 'jumlah'=>Seaweed::model()->getJenisperdate($valjk, $start, $end));
						array_push($jenis_komoditi, $seaweed);
					}
				}

				$this->render('report_kelompok', array(
					'gudang' => $gudang,
					'kelompok'=>$kelompok,
					'jenis_komoditi'=>$jenis_komoditi,
					'petani' => $petani,
					'id_gudang' => $id_gudang,
					'id_klpk' => $id_klpk,
					'range' => $range
				));
			}else{
				$this->redirect('/kospermindo');

			}
		}

		public function actionChartkelompok(){
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
			$idKelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';
			$start = !empty($_POST['start']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['start']))) : '';
			$end = !empty($_POST['end']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['end']))) : '';

			$chart = array();
			$chartinarr = array();
			$getchart = Seaweed::model()->getAllJenisKelompok($start, $end, $id_gudang, $idKelompok);

			$chartJenis = array();
			$chartLabel = array();
			$chartLabelJenis = array();
			$chartyKeys = array();
			$total_panen = 0;

			$getDate = Seaweed::model()->getDateKelompok($start, $end, $id_gudang, $idKelompok);
			foreach ($getDate as $key => $valdate) {
				$keys = array();
				$arrval = array();
				$keys[] = "y";
				$arrval[] = date('Y-m-d', strtotime($valdate['created_date']));
				foreach ($getchart as $key => $valChart) {
					$valGetDate = Seaweed::model()->getDayKelompok(date('Y-m-d', strtotime($valdate['created_date'])),$valChart['id_seaweed'], $idKelompok);
					$keys[] = $valChart['id_seaweed'];
					$arrval[] = (!empty($valGetDate[0]['count'])) ? (float)$valGetDate[0]['count']/1000 : '0';
					array_push($chartLabel, $valChart['id_seaweed']);
				}
				$chartin = array_combine($keys, $arrval);
				array_push($chart, $chartin);
			}

			$countJenis = array();
			foreach (array_unique($chartLabel) as $key => $vl) {
				$komoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$vl, 'status'=>0));
				if(!empty($komoditi)){
					$getcount = Seaweed::model()->getCountKelompok($start,$end,$id_gudang, $idKelompok, $komoditi['id_komoditi']);
					$total_panen = $total_panen + number_format((float)$getcount[0]['count']/1000, 2, '.', '');
					$countJenis[] = array($komoditi['id_komoditi'] => number_format((float)$getcount[0]['count']/1000, 2, '.', ''));
					array_push($chartyKeys, $komoditi['id_komoditi']);
					array_push($chartLabelJenis, $komoditi['jenis']);
				}
			}

			$gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id_gudang, 'status'=>0));			
			$kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$idKelompok, 'status'=>0));			
			$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kelompok['kode_gudang'], 'kode_kelompok'=>$kelompok['kode_kelompok'], 'status_hapus'=>0));

			$arr = array('data'=>$chart, 
				'label'=>$chartLabelJenis,
				'ykeys' => $chartyKeys, 
				'petani'=>count($petani), 
				'hasil_panen'=>number_format((float)$total_panen, 2, '.', ''),
				'count_jenis'=>$countJenis,

			);
			array_push($chartJenis, $arr);

			echo json_encode($chartJenis);
		}

		public function actionGetkelompok(){
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
			$idKelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';
			$start = !empty($_POST['start']) ? $_POST['start'] : '';
			$end = !empty($_POST['end']) ? $_POST['end'] : '';

			Yii::app()->user->setFlash('id_kelompok',$idKelompok);
			Yii::app()->user->setFlash('id_gudang',$id_gudang);
			Yii::app()->user->setFlash('start',$start);
			Yii::app()->user->setFlash('end',$end);

			$pesan = array('message'=>'success');

			echo json_encode($pesan);
		}


		public function actionGudang()
		{
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("3", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

				$gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

				$arrJnsKomoditi = array();
				$jenis_komoditi = array();
				$petani = array();
				$id = '';
				$range = '';

				if (Yii::app()->user->hasFlash('id_gudang') && Yii::app()->user->hasFlash('start') && Yii::app()->user->hasFlash('end')) {
					$id_gudang = CHtml::encode(Yii::app()->user->getFlash('id_gudang'));
					$startFlash = CHtml::encode(Yii::app()->user->getFlash('start'));
					$endFlash = CHtml::encode(Yii::app()->user->getFlash('end'));
					$start = date("Y-m-d", strtotime(str_replace('/', '-', $startFlash)));
					$end = date("Y-m-d", strtotime(str_replace('/', '-', $endFlash)));
					$range = $startFlash.' - '.$endFlash;

					$get_gudang = Gudang::model()->findAllByAttributes(array('id_gudang'=> $id_gudang,'status'=>0), array('order'=>'kode_jenis_gudang'));
					$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
					$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'status_hapus'=>0));
					
					$id_jenis = '';
					foreach ($petani as $key => $valjenis) {
						foreach (json_decode($valjenis->jenis_komoditi) as $key => $validjns) {
							$id_jenis = $id_jenis.','.$validjns->id;
						}
					}

					$id_jenis_komo = array_unique(explode(",", $id_jenis));
					
					$arrJnsKomoditi = array_filter($id_jenis_komo, create_function('$value', 'return $value !== "";'));

					foreach ($arrJnsKomoditi as $key => $valjk) {
						$seaweed = array('id'=>$valjk, 'jumlah'=>Seaweed::model()->getJenisperdate($valjk, $start, $end));
						array_push($jenis_komoditi, $seaweed);
					}

				}else{

					$start = date("Y-m-01");
					$end = date("Y-m-t");
					$id_jnsgudang = JenisGudang::model()->findAll();

					$range = date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($end));
					$get_gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

					$id_gudang = !empty($get_gudang) ? $get_gudang[0]['id_gudang'] : '0';
					$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
					$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'status_hapus'=>0));
					$id_jenis = '';
					foreach ($petani as $key => $valjenis) {
						foreach (json_decode($valjenis->jenis_komoditi) as $key => $validjns) {
							$id_jenis = $id_jenis.','.$validjns->id;
						}
					}

					$id_jenis_komo = array_unique(explode(",", $id_jenis));
					
					$arrJnsKomoditi = array_filter($id_jenis_komo, create_function('$value', 'return $value !== "";'));

					foreach ($arrJnsKomoditi as $key => $valjk) {
						$seaweed = array('id'=>$valjk, 'jumlah'=>Seaweed::model()->getJenisperdate($valjk, $start, $end));
						array_push($jenis_komoditi, $seaweed);
					}
				}

				$this->render('report_gudang', array(
					'gudang' => $gudang,
					'jenis_komoditi'=>$jenis_komoditi,
					'petani' => $petani,
					'id_gudang' => $id_gudang,
					'range' => $range
				));
			}else{
				$this->redirect('/kospermindo');

			}
		}

		public function actionChartgudang(){
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
			$start = !empty($_POST['start']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['start']))) : '';
			$end = !empty($_POST['end']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['end']))) : '';

			$chart = array();
			$chartinarr = array();
			$getchart = Seaweed::model()->getAllJenisGudang($start, $end, $id_gudang);

			$chartJenis = array();
			$chartLabel = array();
			$chartLabelJenis = array();
			$chartyKeys = array();
			$total_panen = 0;

			$getDate = Seaweed::model()->getDateGudang($start, $end, $id_gudang);
			foreach ($getDate as $key => $valdate) {
				$keys = array();
				$arrval = array();
				$keys[] = "y";
				$arrval[] = date('Y-m-d', strtotime($valdate['created_date']));
				foreach ($getchart as $key => $valChart) {
					$valGetDate = Seaweed::model()->getDayGudang(date('Y-m-d', strtotime($valdate['created_date'])),$valChart['id_seaweed'], $id_gudang);
					$keys[] = $valChart['id_seaweed'];
					$arrval[] = (!empty($valGetDate[0]['count'])) ? (float)$valGetDate[0]['count']/1000 : '0';
					array_push($chartLabel, $valChart['id_seaweed']);
				}
				$chartin = array_combine($keys, $arrval);
				array_push($chart, $chartin);
			}

			$countJenis = array();
			foreach (array_unique($chartLabel) as $key => $vl) {
				$komoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$vl, 'status'=>0));
				if(!empty($komoditi)){
					$getcount = Seaweed::model()->getCountGudang($start,$end,$id_gudang,$komoditi['id_komoditi']);
					$total_panen = $total_panen + number_format((float)$getcount[0]['count']/1000, 2, '.', '');
					$countJenis[] = array($komoditi['id_komoditi'] => number_format((float)$getcount[0]['count']/1000, 2, '.', ''));
					array_push($chartyKeys, $komoditi['id_komoditi']);
					array_push($chartLabelJenis, $komoditi['jenis']);
				}
			}

			$gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id_gudang, 'status'=>0));
			$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$gudang['kode_gudang'],'status_hapus'=>0));

			$arr = array('data'=>$chart, 
				'label'=>$chartLabelJenis,
				'ykeys' => $chartyKeys, 
				'petani'=>count($petani), 
				'hasil_panen'=>number_format((float)$total_panen, 2, '.', ''),
				'count_jenis'=>$countJenis,

			);
			array_push($chartJenis, $arr);

			echo json_encode($chartJenis);
		}

		public function actionGetgudang(){
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
			$start = !empty($_POST['start']) ? $_POST['start'] : '';
			$end = !empty($_POST['end']) ? $_POST['end'] : '';

			Yii::app()->user->setFlash('id_gudang',$id_gudang);
			Yii::app()->user->setFlash('start',$start);
			Yii::app()->user->setFlash('end',$end);

			$pesan = array('message'=>'success');

			echo json_encode($pesan);
		}

		public function actionReportcontoh(){
			$this->render('report-contoh');
		}


































	    public function actionGetDatapanen()

	    {

			for ($i = 2015; $i <= 2020; $i++) {

				$tes[] = Komoditi::model()->getGrafik($i);

			}

			$data = array(

				array(

				  'y' => '2016-08-10',

				  'a' => !empty($tes[0][0]['total_panen']) ? $tes[0][0]['total_panen'] : "0",

				  'b' => !empty($tes[0][1]['total_panen']) ? $tes[0][1]['total_panen'] : "0",

				  'c' => !empty($tes[0][2]['total_panen']) ? $tes[0][2]['total_panen'] : "0",

				  'd' => !empty($tes[0][3]['total_panen']) ? $tes[0][3]['total_panen'] : "0",

				),

				array(

				  'y' => '2016-08-12',

				  'a' => !empty($tes[1][0]['total_panen']) ? $tes[1][0]['total_panen'] : "0",

				  'b' => !empty($tes[1][1]['total_panen']) ? $tes[1][1]['total_panen'] : "0",

				  'c' => !empty($tes[1][2]['total_panen']) ? $tes[1][2]['total_panen'] : "0",

				  'd' => !empty($tes[1][3]['total_panen']) ? $tes[1][3]['total_panen'] : "0",

				),

				array(

				  'y' => '2016-08-13',

				  'a' => !empty($tes[2][0]['total_panen']) ? $tes[2][0]['total_panen'] : "0",

				  'b' => !empty($tes[2][1]['total_panen']) ? $tes[2][1]['total_panen'] : "0",

				  'c' => !empty($tes[2][2]['total_panen']) ? $tes[2][2]['total_panen'] : "0",

				  'd' => !empty($tes[2][3]['total_panen']) ? $tes[2][3]['total_panen'] : "0",

				),

				array(

				  'y' => '2016-08-15',

				  'a' => !empty($tes[3][0]['total_panen']) ? $tes[3][0]['total_panen'] : "0",

				  'b' => !empty($tes[3][1]['total_panen']) ? $tes[3][1]['total_panen'] : "0",

				  'c' => !empty($tes[3][2]['total_panen']) ? $tes[3][2]['total_panen'] : "0",

				  'd' => !empty($tes[3][3]['total_panen']) ? $tes[3][3]['total_panen'] : "0",

				),

				array(

				  'y' => '2019',

				  'a' => !empty($tes[4][0]['total_panen']) ? $tes[4][0]['total_panen'] : "0",

				  'b' => !empty($tes[4][1]['total_panen']) ? $tes[4][1]['total_panen'] : "0",

				  'c' => !empty($tes[4][2]['total_panen']) ? $tes[4][2]['total_panen'] : "0",

				  'd' => !empty($tes[4][3]['total_panen']) ? $tes[4][3]['total_panen'] : "0",

				),

				array(

				  'y' => '2020',

				  'a' => !empty($tes[5][0]['total_panen']) ? $tes[5][0]['total_panen'] : "0",

				  'b' => !empty($tes[5][1]['total_panen']) ? $tes[5][1]['total_panen'] : "0",

				  'c' => !empty($tes[5][2]['total_panen']) ? $tes[5][2]['total_panen'] : "0",

				  'd' => !empty($tes[5][3]['total_panen']) ? $tes[5][3]['total_panen'] : "0",

				),

			);

			echo CJSON::encode($data);

	    }

		public function actionCetakhasilgudang(){
		 if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}
			$isGroupAll = array();
			$isfarmergroup = array();
			$totalpanenpetani = array();

			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSumPanen();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));

			$groups = TabelKelompok::model()->findAllByAttributes(array('status' => 1));
			$cek = VKomoditibygroup::model()->findAll();
			$romi = array();
			foreach ($groups as $key => $valuee) {
				foreach ($cek as $key => $value) {
					if ($value->idkelompok == $valuee->id_user) {
						array_push($romi, $value->total);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$apa = array();
			$aku = array();
			$kamu = array();
			$allkelompok = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			foreach ($allkelompok as $value) {
				$isPetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
				// $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
				$apa[] = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
			}
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));
			$cek = VKomoditibygroup::model()->findAll();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
			foreach ($isCoordinator as $key => $value) {
				$isGroupAll[] = TabelKelompok::model()->countByAttributes(array('idgudang' => $value->id));
			}
			$tes = VKomoditibygroup::model()->getTotalPanen();
			//helper::dd($tes);
			$totalpanengroup = array();
			foreach ($isCoordinator as $key => $valuee) {
				foreach ($tes as $key => $value) {
					if ($value['lokasi'] == $valuee['lokasi']) {
						array_push($totalpanengroup, $value['total']);
					} else {
					}
				}
			}
			//helper::dd($totalpanengroup);
			$isfarmer = TabelPetani::model()->findAllByAttributes(array('status' => 1));
			foreach ($isfarmer as $key => $value) {
				$isfarmergroup[] = Pengguna::model()->getgroup($value->idkelompok);
				$totalpanenpetani[] = Komoditi::model()->getPanenFarmer($value->id_user);
			}
			$this->renderPartial('cetak_hasilgudang', array(
				'allFarmers'       => $allFarmers,
				'allGroups'        => $allGroups,
				'allWarehouses'    => $allWarehouses,
				'summary'          => $summary,
				'warehouse'        => $isCoordinator,
				'groups'           => $groups,
				'farmers'          => $farmers,
				'allkelompok'      => $apa,
				'totalpanen'       => $romi,
				'total_panen'      => $totalpanengroup,
				'total_group'      => $isGroupAll,
				'allfarmerMenu'    => $isfarmer,
				'farmergroup'      => $isfarmergroup,
				'totalpanenpetani' => $totalpanenpetani,
				'totalPanengudang' => $tes
			)); 
		}

		public function actionFarmers()
		{
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));

			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSummarySeaweed();
			//helper::dd($summary);
			$panen = Komoditi::model()->getSumPanen();
			//for view statistic
			$groups = TabelKelompok::model()->findAllByAttributes(array('status' => 1));
			$cek = VKomoditibygroup::model()->findAll();
			$romi = array();
			foreach ($groups as $key => $valuee) {
				foreach ($cek as $key => $value) {
					if ($value->idkelompok == $valuee->id_user) {
						array_push($romi, $value->total);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}

			$isUser = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			//helper::dd(count($isUser));
			foreach ($isUser as $value) {
				$tes = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
				//$isGroupAll[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
			}
			//helper::dd($tes);
			//$tes = Pengguna::model()->countByAttributes(array('idkelompok'=>$))

			//$sumFamGroup = count($isFarmerAll);
			// helper::dd(count($isFarmerAll));
			//$isFarmerAll = Pengguna::model()->findAllByAttributes(array('idkelompok' => $isUser->id));

			$isCoordinator = Pengguna::model()->findAllByAttributes(array('levelid' => 1, 'status' => 1));
			foreach ($isCoordinator as $value) {
				$isgroups[] = Pengguna::model()->findAllByAttributes(array('idkoordinator' => $value->id, 'levelid' => 2));
			}
			//helper::dd($isgroups);

			//cari kelompok
			$apa = array();
			$aku = array();
			$kamu = array();
			$allkelompok = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			foreach ($allkelompok as $value) {
				$isPetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
				// $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
				$apa[] = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
			}

			//ganti array 2 dimensi ke 1 dimensi
			// foreach ($isPetani as  $value) {
			// 	foreach ($value as $valuee) {
			// 		array_push($aku, $valuee);
			// 	}
			// }
			$komoditiAll = Komoditi::model()->getSumGroupPanen();

			foreach ($aku as $value) {
				$findUsername[] = Komoditi::model()->findAllByAttributes(array('id_user' => $value->username));
			}
			// foreach ($ispetani as $value) {
			// 	foreach ($value as $key => $valuee) {
			// 		if($valuee[$key]->username ==$sumPanen[$key]["id_user"]){
			// 			echo "berhasil";
			// 		}else{
			// 			echo "gagal";
			// 		}
			// 		//$sumPanen[] = Komoditi::model()->getSumGroupPanen($valuee->username);
			// 		echo $valuee->username;
			// 		//$sumPanen[] = Komoditi::model()->findAllByAttributes(array('id_user'=>$valuee->username));
			// 	}
			// }
			//helper::dd($isPetani);
			// foreach ($findUsername as $value) {
			// 	foreach ($value as $valuee) {
			// 		array_push($kamu, $valuee);
			// 	}
			// }
			//helper::dd($findUsername);
			// $sumPanen = Komoditi::model()->getSumGroupPanen();
			// foreach ($ispetani as $value) {
			// 	foreach ($value as $key => $valuee) {
			// 		if($valuee->username ==$sumPanen[$key]["id_user"]){
			// 			echo "berhasil";
			// 		}else{
			// 			echo "gagal";
			// 		}
			// 		//$sumPanen[] = Komoditi::model()->getSumGroupPanen($valuee->username);
			// 		echo $valuee->username;
			// 		//$sumPanen[] = Komoditi::model()->findAllByAttributes(array('id_user'=>$valuee->username));
			// 	}
			// }
			// helper::dd($sumPanen);
			$this->render('farmers', array(
				'allFarmers'    => $allFarmers,
				'allGroups'     => $allGroups,
				'allWarehouses' => $allWarehouses,
				'summary'       => $panen,
				'farmers'       => $farmers,
				'allkelompok'   => $apa,
				'groups'        => $groups,
				'totalpanen'    => $romi,
			));
		}

		public function actionWarehouse()
		{
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));

			$isGroupAll = array();

			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSummarySeaweed();
			$panen = Komoditi::model()->getSumPanen();
			$cek = VKomoditibygroup::model()->findAll();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
			foreach ($isCoordinator as $key => $value) {
				$isGroupAll[] = TabelKelompok::model()->countByAttributes(array('idgudang' => $value->id));
			}

			$tes = VKomoditibygroup::model()->getTotalPanen();
			$romi = array();
			foreach ($isCoordinator as $key => $valuee) {
				foreach ($tes as $key => $value) {
					if ($value['lokasi'] == $valuee['lokasi']) {
						array_push($romi, $value['total']);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			//helper::dd($romi);
	

			// helper::dd($tes);
			$this->render('warehouse', array(
				'allFarmers'    => $allFarmers,
				'allGroups'     => $allGroups,
				'allWarehouses' => $allWarehouses,
				'summary'       => $panen,
				'farmers'       => $farmers,
				'warehouse'     => $isCoordinator,
				'total_panen'   => $romi,
				'total_group'   => $isGroupAll,
			));
		}
		public function actionCetak_komoditi($id){
		$isPetani = TabelPetani::model()->findByAttributes(array('id'=>$id));
		//helper::dd($isPetani->id_user);
		//$petanikomoditi = Komoditi::model()->getPanenPetani($isPetani->id_user);
		//helper::dd($petanikomoditi);
		$this->renderPartial('cetak_komoditi',array(
			'petani' =>$isPetani
			));
		}
		public function actionCetakhasil(){
			$isGroupAll = array();
			$isfarmergroup = array();
			$totalpanenpetani = array();

			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}
			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSumPanen();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));

			$groups = TabelKelompok::model()->findAllByAttributes(array('status' => 1));
			$cek = VKomoditibygroup::model()->findAll();
			$romi = array();
			foreach ($groups as $key => $valuee) {
				foreach ($cek as $key => $value) {
					if ($value->idkelompok == $valuee->id_user) {
						array_push($romi, $value->total);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$apa = array();
			$aku = array();
			$kamu = array();
			$allkelompok = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			foreach ($allkelompok as $value) {
				$isPetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
				// $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
				$apa[] = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
			}
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));
			$cek = VKomoditibygroup::model()->findAll();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
			foreach ($isCoordinator as $key => $value) {
				$isGroupAll[] = TabelKelompok::model()->countByAttributes(array('idgudang' => $value->id));
			}

			$tes = VKomoditibygroup::model()->getTotalPanen();
			$totalpanengroup = array();
			foreach ($isCoordinator as $key => $valuee) {
				foreach ($tes as $key => $value) {
					if ($value['lokasi'] == $valuee['lokasi']) {
						array_push($totalpanengroup, $value['total']);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$isfarmer = TabelPetani::model()->findAllByAttributes(array('status' => 1));
			foreach ($isfarmer as $key => $value) {
				$isfarmergroup[] = Pengguna::model()->getgroup($value->idkelompok);
				$totalpanenpetani[] = Komoditi::model()->getPanenFarmer($value->id_user);
			}
			//helper::dd($totalpanenpetani);

			// 'warehouse'=>$isCoordinator,
			// 'total_panen'=>$totalpanengroup,
			// 'total_group'=>$isGroupAll
			//$tes = Komoditi::model()->getGrafik('2016');
			//helper::dd($tes);
			// // console.log($tes);
			//helper::dd($tes);
			$this->renderPartial('cetak_panen', array(
				'allFarmers'       => $allFarmers,
				'allGroups'        => $allGroups,
				'allWarehouses'    => $allWarehouses,
				'summary'          => $summary,
				'warehouse'        => $isCoordinator,
				'groups'           => $groups,
				'farmers'          => $farmers,
				'allkelompok'      => $apa,
				'totalpanen'       => $romi,
				'total_panen'      => $totalpanengroup,
				'total_group'      => $isGroupAll,
				'allfarmerMenu'    => $isfarmer,
				'farmergroup'      => $isfarmergroup,
				'totalpanenpetani' => $totalpanenpetani,
			));
		}
		public function actionCetakpanenkelompok(){
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}
			$isGroupAll = array();
			$isfarmergroup = array();
			$totalpanenpetani = array();
			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSumPanen();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));

			$groups = TabelKelompok::model()->findAllByAttributes(array('status' => 1));
			$cek = VKomoditibygroup::model()->findAll();
			$panenkelompok = Komoditi::model()->getpanenKelompok();
			//helper::dd($panenkelompok);
			$romi = array();
			$apa = array();
			$aku = array();
			$kamu = array();
			$allkelompok = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			foreach ($allkelompok as $value) {
				$isPetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
				$apa[] = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
			}
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));
			$cek = VKomoditibygroup::model()->findAll();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
			foreach ($isCoordinator as $key => $value) {
				$isGroupAll[] = TabelKelompok::model()->countByAttributes(array('idgudang' => $value->id));
			}
			$tes = VKomoditibygroup::model()->getTotalPanen();
			$totalpanengroup = array();
			foreach ($isCoordinator as $key => $valuee) {
				foreach ($tes as $key => $value) {
					if ($value['lokasi'] == $valuee['lokasi']) {
						array_push($totalpanengroup, $value['total']);
					} else {
					}
				}
			}
			$isfarmer = TabelPetani::model()->findAllByAttributes(array('status' => 1));
			foreach ($isfarmer as $key => $value) {
				$isfarmergroup[] = Pengguna::model()->getgroup($value->idkelompok);
				$totalpanenpetani[] = Komoditi::model()->getPanenFarmer($value->id_user);
			}
			$this->renderPartial('cetak_hasilkelompok', array(
				'allFarmers'       => $allFarmers,
				'allGroups'        => $allGroups,
				'allWarehouses'    => $allWarehouses,
				'summary'          => $summary,
				'warehouse'        => $isCoordinator,
				'groups'           => $groups,
				'farmers'          => $farmers,
				'allkelompok'      => $apa,
				'totalpanen'       => $romi,
				'total_panen'      => $totalpanengroup,
				'total_group'      => $isGroupAll,
				'allfarmerMenu'    => $isfarmer,
				'farmergroup'      => $isfarmergroup,
				'totalpanenpetani' => $totalpanenpetani,
				'panenkelompok' =>$panenkelompok
			));
		}
		public function actionCetakhasilpetani(){
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}
			$isGroupAll = array();
			$isfarmergroup = array();
			$totalpanenpetani = array();

			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSumPanen();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));

			$groups = TabelKelompok::model()->findAllByAttributes(array('status' => 1));
			$cek = VKomoditibygroup::model()->findAll();
			$romi = array();
			foreach ($groups as $key => $valuee) {
				foreach ($cek as $key => $value) {
					if ($value->idkelompok == $valuee->id_user) {
						array_push($romi, $value->total);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$apa = array();
			$aku = array();
			$kamu = array();
			$allkelompok = Pengguna::model()->findAllByAttributes(array('levelid' => 2, 'status' => 1));
			foreach ($allkelompok as $value) {
				$isPetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
				// $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
				$apa[] = Pengguna::model()->countByAttributes(array('idkelompok' => $value->id));
			}
			$farmers = TabelPetani::model()->findAllByAttributes(array(
				'id_perusahaan' => Yii::app()->user->id,
				'status'        => 1,
			));
			$cek = VKomoditibygroup::model()->findAll();
			$isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
			foreach ($isCoordinator as $key => $value) {
				$isGroupAll[] = TabelKelompok::model()->countByAttributes(array('idgudang' => $value->id));
			}

			$tes = VKomoditibygroup::model()->getTotalPanen();
			$totalpanengroup = array();
			foreach ($isCoordinator as $key => $valuee) {
				foreach ($tes as $key => $value) {
					if ($value['lokasi'] == $valuee['lokasi']) {
						array_push($totalpanengroup, $value['total']);
					} else {
						//array_push($romi, "0");
						//array_push($romi, $value->total);
					}
				}
			}
			$isfarmer = TabelPetani::model()->findAllByAttributes(array('status' => 1));
			foreach ($isfarmer as $key => $value) {
				$isfarmergroup[] = Pengguna::model()->getgroup($value->idkelompok);
				$totalpanenpetani[] = Komoditi::model()->getPanenFarmer($value->id_user);
			}
			//helper::dd($totalpanenpetani);

			// 'warehouse'=>$isCoordinator,
			// 'total_panen'=>$totalpanengroup,
			// 'total_group'=>$isGroupAll
			//$tes = Komoditi::model()->getGrafik('2016');
			//helper::dd($tes);
			// // console.log($tes);
			//helper::dd($tes);
			$this->renderPartial('cetak_hasilpetani', array(
				'allFarmers'       => $allFarmers,
				'allGroups'        => $allGroups,
				'allWarehouses'    => $allWarehouses,
				'summary'          => $summary,
				'warehouse'        => $isCoordinator,
				'groups'           => $groups,
				'farmers'          => $farmers,
				'allkelompok'      => $apa,
				'totalpanen'       => $romi,
				'total_panen'      => $totalpanengroup,
				'total_group'      => $isGroupAll,
				'allfarmerMenu'    => $isfarmer,
				'farmergroup'      => $isfarmergroup,
				'totalpanenpetani' => $totalpanenpetani,
			));
		}

		public function actionSeaweed()
		{
			$allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
			$allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
			$allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
			$summary = Komoditi::model()->getSummarySeaweed();
			$panen = Komoditi::model()->getSumPanen();
			$this->render('seaweed', array(
				'allFarmers'    => $allFarmers,
				'allGroups'     => $allGroups,
				'allWarehouses' => $allWarehouses,
				'summary'       => $summary,
				'panen'         => $panen,
			));
			//$this->render('seaweed');
		}
	}