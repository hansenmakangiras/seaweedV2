<?php
	/**
	 * Created by PhpStorm.
	 * User: hanse
	 * Date: 7/14/2016
	 * Time: 5:16 AM
	 */

class SeaweedController extends KController
{
	public function actionIndex(){
		if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/users/login');
			}

			// $dataProvider = new CActiveDataProvider('Users', array(
			//   'criteria' => array(
			//     'condition' => 'status=1',
			//     'order' => 'id ASC'
			//   ),
			//   'countCriteria' => array(
			//     'condition' => 'status=1'
			//   ),
			//   'pagination' => array(
			//     'pageSize' => 10,
			//   )
			// ));
			//$user = Helper::dd(Yii::app()->user->lastLogin);
			
			$kelompok = array();
			$findGroup = array();
			$users = Users::model()->isSuperUser();
			if ($users == false) {
				$data = Users::model()->findAllByAttributes(array(
					'isadmin'   => 0,
					'superuser' => 0,
					'status'    => 1,
					'levelid'   => 2,
					'companyid' => Yii::app()->user->id,
				));
				$dataUser = Pengguna::model()->findAllByAttributes(array(
					'levelid'       => 3,
					'id_perusahaan' => Yii::app()->user->id,
				));
				foreach ($dataUser as $dataKelompok) {
					$kelompok[]= $dataKelompok->idkelompok;
				}
				for($i=0;$i<count($kelompok);$i++) {
					$findUsername[] = Pengguna::model()->findByAttributes(array('id'=>$kelompok[$i]));
					$findGroup[] = TabelKelompok::model()->findByAttributes(array('id_user'=>$findUsername[$i]['username']));
				}
				$komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
				//Helper::dd($komoditi);
				$apa[]=0;
				foreach ($komoditi as $value) {
					$apa[]+=$value->total_panen;
				}

				//for profile 2
				$groupData = TabelKelompok::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
				$farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

				//for profile 3
				$warehouseData = TabelKoordinator::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
				$farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

				//for profile 4
				$farmer = TabelPetani::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
				$farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
				//Helper::dd(array_sum($apa));
			} elseif ($users == true) {
				$data = Users::model()->findAllByAttributes(array('status' => 1));
			}
			$summary = Komoditi::model()->getSummarySeaweed();
			//Helper::dd($summary);

			//Helper::dd(Users::model()->getKomoditiTipe());
			$dataProvider = new Users('search');
			$dataProvider->unsetAttributes();
			if (isset($_GET['Users'])) {
				$dataProvider->attributes = $_GET['Users'];
			}
			$pesan_group='';
			$koordinator = Pengguna::model()->findByAttributes(array('levelid'=>'1','status'=>1));
			if(empty($koordinator)){
				$pesan_group='gagal';
			}else{
				$pesan_group='berhasil';
			}
			$pesan_petani = '';
			$kelompokCek = Pengguna::model()->findByAttributes(array('levelid' => '2', 'status' => 1));
			if (empty($kelompokCek)) {
				$pesan_petani = 'gagalgagal';
			} else {
				$pesan_petani = 'berhasilberhasil';
			}
			$this->render('index', array(
				'data'     => $data,
				'dataUser' => $dataUser,
				'dataGroup'=>$findGroup,
				'summary' =>$summary,
				'groupData' => $groupData,
				'warehouseData' => $warehouseData,
				'farmer' => $farmer,
				'farmerData' =>$farmerData,
				'pesan_group'=>$pesan_group,
				'pesan_petani'=>$pesan_petani
			));
	}

	public function actionTesinput(){
		$seaweed =  new Seaweed;
		$seaweed->id_user = 7;
		$seaweed->id_gudang = 29;
		$seaweed->id_kelompok = 3;
		$seaweed->id_seaweed = 30;
		$seaweed->kadar_air = 10;
		$seaweed->total_panen = 1000;
		$seaweed->created_by = 7;
		$seaweed->status = 1;

		if($seaweed->save()){
			var_dump("success");
		}else{
			var_dump("error");
		}
	}

	public function actionElastic(){
		$client = Elasticsearch\ClientBuilder::create()->setHosts(['localhost:9200'])->build();

		$json = '
			{
				"query": {
					"bool": {
						"must": [
							{
								"match_all": {}
							},
							{
								"range": {
									"created_date": { "gte": "2013-12-09", "lte" : "2017-01-01" }
								}
							}
						]
					}
				},
				"aggs": {
					"hasil_jumlah": {
						"sum": {
							"field": "total_panen"
						}
					}
				}
			}
		';

		$params = [
				'index' => 'seaweed',
				'type' => 'hasil_seaweed',
				'body' => $json
				
		];

		// Update doc at /my_index/my_type/my_id
		$response = $client->search($params);
		echo '<pre>';
		var_dump($response['aggregations']);
	}
}