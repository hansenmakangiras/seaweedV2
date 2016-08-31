<?php

class DashboardController extends SController
{
	public function actionIndex()
	{
		if((Yii::app()->user->isGuest) || (Yii::app()->user->akses !== 0)){
			$this->redirect(SAdmin::getBaseUrl().'/login');
		}

		$alladmin = Users::model()->countByAttributes(array('su_akses' => 1));
		$allmoderator = Users::model()->countByAttributes(array('su_akses'=> 2));
		$allpetani = Petani::model()->countByAttributes(array('status_hapus'=> 0));
		

		$user = Yii::app()->user->getState("userData");
		$user = unserialize($user);

		$this->render('index',array(
			'userdata' => $user,
			'alladmin' => $alladmin,
			'allmoderator' => $allmoderator,
			'allpetani' => $allpetani

		));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout(false);

		$this->redirect('/superadmin/login');
	}
}