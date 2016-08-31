<?php

  class ResetPasswordController extends KController
  {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
//	public function filters()
//	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
//	}
//    public function filters()
//    {
//      return array(
//        'rights',
//      );
//    }

//    /**
//     * Specifies the access control rules.
//     * This method is used by the 'accessControl' filter.
//     * @return array access control rules
//     */
//    public function accessRules()
//    {
//      return array(
//        array(
//          'allow',  // allow all users to perform 'index' and 'view' actions
//          'actions' => array('index', 'view'),
//          'users'   => array('*'),
//        ),
//        array(
//          'allow', // allow authenticated user to perform 'create' and 'update' actions
//          'actions' => array('create', 'update'),
//          'users'   => array('@'),
//        ),
//        array(
//          'allow', // allow admin user to perform 'admin' and 'delete' actions
//          'actions' => array('admin', 'delete'),
//          'users'   => array('admin'),
//        ),
//        array(
//          'deny',  // deny all users
//          'users' => array('*'),
//        ),
//      );
//    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
      $this->render('view', array(
        'model' => $this->loadModel($id),
      ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id the ID of the model to be loaded
     *
     * @return Company the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
      $model = Petani::model()->findByPk($id);
      if ($model === null) {
        throw new CHttpException(404, 'The requested page does not exist.');
      }

      return $model;
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      //Helper::dd($_POST);
      $pesan = '';
      $error = 2;
      $model = new Petani;

      if (isset($_POST['Petani'])) {
        $postNewPass = $_POST['Petani']['newPassword'];
        if (!empty($postNewPass)) {
          $uid = $_POST['Petani']['id_user'];
          $model = Petani::model()->findByPk((int)$uid);
          $model->attributes = $_POST['Petani'];
          $model->setScenario('changePassword');
          $model->password = CPasswordHelper::hashPassword($postNewPass);
          if ($model->save()) {
            $error = 0;
            $pesan = 'Kata sandi berhasil diubah. Kata sandi baru anda untuk pengguna : '.'<strong>'. $model->nama_petani.'</strong>'.' adalah : '. '<strong>'.$postNewPass.'</strong>';
          } else {
            $error = 1;
            $pesan = "Kata sandi gagal diubah";
          }
        } else {
          $error = 1;
          $pesan = "Silahkan masukkan kata kunci baru";
        }
      }
      $this->render('index', array(
        'model' => $model,
        'pesan' => $pesan,
        'error' => $error,
      ));
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Company $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
      if (isset($_POST['ajax']) && $_POST['ajax'] === 'company-form') {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
  }
