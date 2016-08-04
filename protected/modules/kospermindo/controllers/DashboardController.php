<?php

  class DashboardController extends KController
  {
    public function actionIndex()
    {
      // renders the view file 'protected/views/site/index.php'
      // using the default layout 'protected/views/layouts/main.php'

      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $allFarmers = TabelPetani::model()->countByAttributes(array('status' => 1));
      $allGroups = TabelKelompok::model()->countByAttributes(array('status' => 1));
      $allWarehouses = TabelKoordinator::model()->countByAttributes(array('status' => 1));
      $summary = Komoditi::model()->getSummarySeaweedAll();
      $allPanen = Komoditi::model()->getSumPanen();
      $this->render('index', array(
        'allFarmers' => $allFarmers,
        'allPanen'   => $allPanen,
        'summary'    => $summary,
      ));
    }

    public function actionGetData()
    {
      for ($i = 2015; $i <= 2020; $i++) {
        $tes[] = Komoditi::model()->getGrafik($i);
      }

      $data = array(
        array(
          'y' => '2015',
          'a' => !empty($tes[0][0]['total_panen']) ? $tes[0][0]['total_panen'] : "0",
          'b' => !empty($tes[0][1]['total_panen']) ? $tes[0][1]['total_panen'] : "0",
          'c' => !empty($tes[0][2]['total_panen']) ? $tes[0][2]['total_panen'] : "0",
          'd' => !empty($tes[0][3]['total_panen']) ? $tes[0][3]['total_panen'] : "0",
        ),
        array(
          'y' => '2016',
          'a' => !empty($tes[1][0]['total_panen']) ? $tes[1][0]['total_panen'] : "0",
          'b' => !empty($tes[1][1]['total_panen']) ? $tes[1][1]['total_panen'] : "0",
          'c' => !empty($tes[1][2]['total_panen']) ? $tes[1][2]['total_panen'] : "0",
          'd' => !empty($tes[1][3]['total_panen']) ? $tes[1][3]['total_panen'] : "0",
        ),
        array(
          'y' => '2017',
          'a' => !empty($tes[2][0]['total_panen']) ? $tes[2][0]['total_panen'] : "0",
          'b' => !empty($tes[2][1]['total_panen']) ? $tes[2][1]['total_panen'] : "0",
          'c' => !empty($tes[2][2]['total_panen']) ? $tes[2][2]['total_panen'] : "0",
          'd' => !empty($tes[2][3]['total_panen']) ? $tes[2][3]['total_panen'] : "0",
        ),
        array(
          'y' => '2018',
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

    public function actionLogout(){
//      Yii::app()->user->logout();
      Yii::app()->user->logout(false);
      $this->redirect('/kospermindo/login');
      //$this->redirect(Yii::app()->homeUrl);
    }
  }