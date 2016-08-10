<?php

class DashboardController extends SController
{
	public function actionIndex()
	{
    if(Yii::app()->user->isGuest){
      $this->redirect(SAdmin::getBaseUrl().'/login');
    }

    $user = Yii::app()->user->getState("userData");
    $user = unserialize($user);

		$this->render('index',array(
      'userdata' => $user
    ));
	}
  /**
   * Logs out the current user and redirect to login page.
   */
  public function actionLogout()
  {
    Yii::app()->user->logout(false);
//    $this->redirect('/superadmin/login');
    $this->redirect(Yii::app()->getModule('superadmin')->user->loginUrl);
    //$this->redirect(Yii::app()->homeUrl);
  }
}