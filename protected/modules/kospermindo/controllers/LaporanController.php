<?php

  class LaporanController extends KController
  {
    public function actionIndex()
    {
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
        $isGroupAll[] = TabelKelompok::model()->countByAttributes(array('lokasi' => $value->lokasi));
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
      $this->render('index', array(
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
      // {"tipe_seaweed": "KW3", "Total Panen": 100},
      // {"tipe_seaweed": "KW4", "Total Panen": 24},
      // {"tipe_seaweed": "BS", "Total Panen": 3},
      // {"tipe_seaweed": "Sango-Sango Laut", "Total Panen": 12},
      // {"tipe_seaweed": "Euchema Cotoni", "Total Panen": 13},
      // {"tipe_seaweed": "Spinosom", "Total Panen": 22}
      
      // for ($i = 2010; $i <= 2016; $i++) {
      //   $tes[] = Komoditi::model()->getGrafik($i);
      // }
      // //$coba = Komoditi::model()->getGrafik();
      // //helper::dd($coba);
      // $data = array(
      //   array(
      //     'y' => '2010',
      //     'a' => !empty($tes[0][0]['total_panen']) ? $tes[0][0]['total_panen'] : "0",
      //     'b' => !empty($tes[0][1]['total_panen']) ? $tes[0][1]['total_panen'] : "0",
      //     'c' => !empty($tes[0][2]['total_panen']) ? $tes[0][2]['total_panen'] : "0",
      //     'd' => !empty($tes[0][3]['total_panen']) ? $tes[0][3]['total_panen'] : "0",
      //   ),
      //   array(
      //     'y' => '2011',
      //     'a' => !empty($tes[1][0]['total_panen']) ? $tes[1][0]['total_panen'] : "0",
      //     'b' => !empty($tes[1][1]['total_panen']) ? $tes[1][1]['total_panen'] : "0",
      //     'c' => !empty($tes[1][2]['total_panen']) ? $tes[1][2]['total_panen'] : "0",
      //     'd' => !empty($tes[1][3]['total_panen']) ? $tes[1][3]['total_panen'] : "0",
      //   ),
      //   array(
      //     'y' => '2012',
      //     'a' => !empty($tes[2][0]['total_panen']) ? $tes[2][0]['total_panen'] : "0",
      //     'b' => !empty($tes[2][1]['total_panen']) ? $tes[2][1]['total_panen'] : "0",
      //     'c' => !empty($tes[2][2]['total_panen']) ? $tes[2][2]['total_panen'] : "0",
      //     'd' => !empty($tes[2][3]['total_panen']) ? $tes[2][3]['total_panen'] : "0",
      //   ),
      //   array(
      //     'y' => '2013',
      //     'a' => !empty($tes[3][0]['total_panen']) ? $tes[3][0]['total_panen'] : "0",
      //     'b' => !empty($tes[3][1]['total_panen']) ? $tes[3][1]['total_panen'] : "0",
      //     'c' => !empty($tes[3][2]['total_panen']) ? $tes[3][2]['total_panen'] : "0",
      //     'd' => !empty($tes[3][3]['total_panen']) ? $tes[3][3]['total_panen'] : "0",
      //   ),
      //   array(
      //     'y' => '2014',
      //     'a' => !empty($tes[4][0]['total_panen']) ? $tes[4][0]['total_panen'] : "0",
      //     'b' => !empty($tes[4][1]['total_panen']) ? $tes[4][1]['total_panen'] : "0",
      //     'c' => !empty($tes[4][2]['total_panen']) ? $tes[4][2]['total_panen'] : "0",
      //     'd' => !empty($tes[4][3]['total_panen']) ? $tes[4][3]['total_panen'] : "0",
      //   ),
      //   array(
      //     'y' => '2015',
      //     'a' => !empty($tes[5][0]['total_panen']) ? $tes[5][0]['total_panen'] : "0",
      //     'b' => !empty($tes[5][1]['total_panen']) ? $tes[5][1]['total_panen'] : "0",
      //     'c' => !empty($tes[5][2]['total_panen']) ? $tes[5][2]['total_panen'] : "0",
      //     'd' => !empty($tes[5][3]['total_panen']) ? $tes[5][3]['total_panen'] : "0",
      //   ),
      //   array(
      //     'y' => '2016',
      //     'a' => !empty($tes[6][0]['total_panen']) ? $tes[6][0]['total_panen'] : "0",
      //     'b' => !empty($tes[6][1]['total_panen']) ? $tes[6][1]['total_panen'] : "0",
      //     'c' => !empty($tes[6][2]['total_panen']) ? $tes[6][2]['total_panen'] : "0",
      //     'd' => !empty($tes[6][3]['total_panen']) ? $tes[6][3]['total_panen'] : "0",
      //   ),
      // );
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
      }
      $isGroupAll = array();
      $isfarmergroup = array();
      $totalpanenpetani = array();

      $allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
      $allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
      $allWarehouses = Gudang::model()->countByAttributes(array('status' => 1));
      $isCoordinator = Gudang::model()->findAllByAttributes(array('status' => 1));
      $report_petani = Komoditi::model()->getReportPetani();
      $this->render('report_petani', array(
        'allFarmers'       => $allFarmers,
        'allGroups'        => $allGroups,
        'allWarehouses'    => $allWarehouses,
        'report_petani'    => $report_petani,
      ));
    }

    public function actionKelompok()
    {
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
      // foreach ($groups as $key => $valuee) {
      //   foreach ($panenkelompok as $key => $value) {
      //     if ($value->idkelompok == $valuee->id) {
      //       array_push($romi, $value->total);
      //     } else {
      //       //array_push($romi, "0");
      //       //array_push($romi, $value->total);
      //     }
      //   }
      // }
      //helper::dd($romi);
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
      $this->render('report_kelompok', array(
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

    public function ActionGudang()
    {
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
      $this->render('report_gudang', array(
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