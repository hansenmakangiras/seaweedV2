<?php

  class DashboardController extends KController

  {

	public function actionIndex()
	{

	  if (Yii::app()->user->isGuest) {

		$this->redirect('/kospermindo/login');

	  }elseif (Yii::app()->user->akses == 3) {

	  	$id = Yii::app()->user->id;
	  	$allPetani = Gudang::model()->countPetani();

		$sumProduksi = Gudang::model()->sumProduksiByPetani($id);

		$data = array();

		$sumProduksiByJenis = Gudang::model()->sumProduksiByJenisPetani($id);
		// var_dump($sumProduksiByJenis);
		// exit();

		$allGudang = Gudang::model()->findAllByAttributes(array('status' => 0));
		$allKelompok = Kelompok::model()->findAllByAttributes(array('status' => 0));

		$this->render('index', array(
			'allFarmers'         => $allPetani,
			'allPanen'           => $sumProduksi,
			'sumProduksiByJenis' => $sumProduksiByJenis,
			'allGudang'          => $allGudang,
			'allKelompok'        => $allKelompok,
		  ));
		
	  }else{

		  $allPetani = Gudang::model()->countPetani();

		  $sumProduksi = Gudang::model()->sumProduksi();

		  $data = array();

		  $sumProduksiByJenis = Gudang::model()->sumProduksiByJenis();

		  $allGudang = Gudang::model()->findAllByAttributes(array('status' => 0));
		  $allKelompok = Kelompok::model()->findAllByAttributes(array('status' => 0));

		  $this->render('index', array(
			'allFarmers'         => $allPetani,
			'allPanen'           => $sumProduksi,
			'sumProduksiByJenis' => $sumProduksiByJenis,
			'allGudang'          => $allGudang,
			'allKelompok'        => $allKelompok,
		  ));

	  }


	}

	public function actionGetData()

	{

		if(Yii::app()->user->akses == 3){
			$id = Yii::app()->user->id;
			
			$sumProduksiByJenis = Gudang::model()->sumProduksiByJenisPetani($id);
		
		}else{

	  		$sumProduksiByJenis = Gudang::model()->sumProduksiByJenis();
		}

	  	echo json_encode($sumProduksiByJenis);


	  /*$data = array(

		array(

		  'y' => '2015',

		  'a' => !empty($jss[0][0]['total_produksi']) ? $jss[0][0]['total_produksi'] : "0",

		  'b' => !empty($jss[0][1]['total_produksi']) ? $jss[0][1]['total_produksi'] : "0",

		  'c' => !empty($jss[0][2]['total_produksi']) ? $jss[0][2]['total_produksi'] : "0",

		  'd' => !empty($jss[0][3]['total_produksi']) ? $jss[0][3]['total_produksi'] : "0",

		),

		array(

		  'y' => '2016',

		  'a' => !empty($jss[1][0]['total_produksi']) ? $jss[1][0]['total_produksi'] : "0",

		  'b' => !empty($jss[1][1]['total_produksi']) ? $jss[1][1]['total_produksi'] : "0",

		  'c' => !empty($jss[1][2]['total_produksi']) ? $jss[1][2]['total_produksi'] : "0",

		  'd' => !empty($jss[1][3]['total_produksi']) ? $jss[1][3]['total_produksi'] : "0",

		),

		array(

		  'y' => '2017',

		  'a' => !empty($jss[2][0]['total_produksi']) ? $jss[2][0]['total_produksi'] : "0",

		  'b' => !empty($jss[2][1]['total_produksi']) ? $jss[2][1]['total_produksi'] : "0",

		  'c' => !empty($jss[2][2]['total_produksi']) ? $jss[2][2]['total_produksi'] : "0",

		  'd' => !empty($jss[2][3]['total_produksi']) ? $jss[2][3]['total_produksi'] : "0",

		),

		array(

		  'y' => '2018',

		  'a' => !empty($jss[3][0]['total_produksi']) ? $jss[3][0]['total_produksi'] : "0",

		  'b' => !empty($jss[3][1]['total_produksi']) ? $jss[3][1]['total_produksi'] : "0",

		  'c' => !empty($jss[3][2]['total_produksi']) ? $jss[3][2]['total_produksi'] : "0",

		  'd' => !empty($jss[3][3]['total_produksi']) ? $jss[3][3]['total_produksi'] : "0",

		),

		array(

		  'y' => '2019',

		  'a' => !empty($jss[4][0]['total_produksi']) ? $jss[4][0]['total_produksi'] : "0",

		  'b' => !empty($jss[4][1]['total_produksi']) ? $jss[4][1]['total_produksi'] : "0",

		  'c' => !empty($jss[4][2]['total_produksi']) ? $jss[4][2]['total_produksi'] : "0",

		  'd' => !empty($jss[4][3]['total_produksi']) ? $jss[4][3]['total_produksi'] : "0",

		),

		array(

		  'y' => '2020',

		  'a' => !empty($jss[5][0]['total_produksi']) ? $jss[5][0]['total_produksi'] : "0",

		  'b' => !empty($jss[5][1]['total_produksi']) ? $jss[5][1]['total_produksi'] : "0",

		  'c' => !empty($jss[5][2]['total_produksi']) ? $jss[5][2]['total_produksi'] : "0",

		  'd' => !empty($jss[5][3]['total_produksi']) ? $jss[5][3]['total_produksi'] : "0",

		),

	  );

	  echo CJSON::encode($data);*/

	}

	public function actionLogout()
	{

	  Yii::app()->user->logout(false);

	  $this->redirect(Yii::app()->getModule('kospermindo')->user->loginUrl);

	}

  }
