<?php

class ReportController extends KController
{
	public function actionIndex()
	{
		$allFarmers = TabelPetani::model()->countByAttributes(array('status'=>1));
		$allGroups = TabelKelompok::model()->countByAttributes(array('status'=>1));
		$allWarehouses = TabelKoordinator::model()->countByAttributes(array('status'=>1));
		$summary = Komoditi::model()->getSumPanen();
		$this->render('index',array(
			'allFarmers'=>$allFarmers,
			'allGroups'=>$allGroups,
			'allWarehouses'=>$allWarehouses,
			'summary'=>$summary));
	}

  public function actionFarmers()
  {
  	$farmers = TabelPetani::model()->findAllByAttributes(array(
  		'id_perusahaan' => Yii::app()->user->id,
        'status'        => 1,
  		));
  	$allFarmers = TabelPetani::model()->countByAttributes(array('status'=>1));
	$allGroups = TabelKelompok::model()->countByAttributes(array('status'=>1));
	$allWarehouses = TabelKoordinator::model()->countByAttributes(array('status'=>1));
	$summary = Komoditi::model()->getSummarySeaweed();
	$panen = Komoditi::model()->getSumPanen();
	//for view statistic
	$groups = TabelKelompok::model()->findAllByAttributes(array('status'=>1));
	
	
	$isUser = Pengguna::model()->findAllByAttributes(array('levelid'=>2,'status'=>1));
	//helper::dd(count($isUser));
	foreach ($isUser as $value) {
		$tes = Pengguna::model()->countByAttributes(array('idkelompok'=>$value->id));
		//$isGroupAll[] = Pengguna::model()->findAllByAttributes(array('idkelompok' => $value->id));
	}
	//helper::dd($tes);
	//$tes = Pengguna::model()->countByAttributes(array('idkelompok'=>$))
	
	//$sumFamGroup = count($isFarmerAll);
	// helper::dd(count($isFarmerAll));
    //$isFarmerAll = Pengguna::model()->findAllByAttributes(array('idkelompok' => $isUser->id));

    $isCoordinator = Pengguna::model()->findAllByAttributes(array('levelid'=>1,'status'=>1));
    foreach ($isCoordinator as $value) {
    	$isgroups[] = Pengguna::model()->findAllByAttributes(array('idkoordinator'=>$value->id,'levelid'=>2));
    }
    //helper::dd($isgroups);

    //cari kelompok
    $apa = array();
    $aku = array();
    $kamu = array();
    $allkelompok = Pengguna::model()->findAllByAttributes(array('levelid'=>2,'status'=>1));
    foreach ($allkelompok as $value) {
    	$isPetani[]= Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
    	// $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
    	$apa[] = Pengguna::model()->countByAttributes(array('idkelompok'=>$value->id));
    }
    
    //ganti array 2 dimensi ke 1 dimensi
    // foreach ($isPetani as  $value) {
    // 	foreach ($value as $valuee) {
    // 		array_push($aku, $valuee);
    // 	}
    // }
    $komoditiAll = Komoditi::model()->getSumGroupPanen();


    foreach ($aku as $value) {
    	$findUsername[] = Komoditi::model()->findAllByAttributes(array('id_user'=>$value->username));
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
	$this->render('farmers',array(
		'allFarmers'=>$allFarmers,
		'allGroups'=>$allGroups,
		'allWarehouses'=>$allWarehouses,
		'summary'=>$summary,
		'farmers'=>$farmers,
		'allkelompok' => $apa,
		'groups'=>$groups));
  }
  public function actionWarehouse()
  {
  	$farmers = TabelPetani::model()->findAllByAttributes(array(
  		'id_perusahaan' => Yii::app()->user->id,
        'status'        => 1,
  		));
  	$allFarmers = TabelPetani::model()->countByAttributes(array('status'=>1));
	$allGroups = TabelKelompok::model()->countByAttributes(array('status'=>1));
	$allWarehouses = TabelKoordinator::model()->countByAttributes(array('status'=>1));
	$summary = Komoditi::model()->getSummarySeaweed();
	$panen = Komoditi::model()->getSumPanen();
	$this->render('warehouse',array(
		'allFarmers'=>$allFarmers,
		'allGroups'=>$allGroups,
		'allWarehouses'=>$allWarehouses,
		'summary'=>$summary,
		'farmers'=>$farmers));
  }

  public function actionSeaweed()
  {
  	$allFarmers = TabelPetani::model()->countByAttributes(array('status'=>1));
		$allGroups = TabelKelompok::model()->countByAttributes(array('status'=>1));
		$allWarehouses = TabelKoordinator::model()->countByAttributes(array('status'=>1));
		$summary = Komoditi::model()->getSummarySeaweed();
		$panen = Komoditi::model()->getSumPanen();
		$this->render('seaweed',array(
			'allFarmers'=>$allFarmers,
			'allGroups'=>$allGroups,
			'allWarehouses'=>$allWarehouses,
			'summary'=>$summary,
			'panen'=>$panen));
    //$this->render('seaweed');
  }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}