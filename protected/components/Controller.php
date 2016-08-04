<?php

  /**
   * Controller is the customized base controller class.
   * All controller classes for this application should extend from this base class.
   */
  //Yii::import("application.components.SHelper");

  class Controller extends CController
  {
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $baseUrl;

    public function init()
    {
      $this->baseUrl = Yii::app()->getBaseUrl(true);
      Helper::setTimeZone('Asia/Makassar');

      //Yii::app()->clientScript->registerCoreScript('jquery');
//      Yii::app()->clientScript->registerCoreScript('yii');

      // Tweaks for Ajax Requests
//      Yii::app()->user->loginRequiredAjaxResponse = "<script>window.location.href = '" . Yii::app()->user->id . "';</script>";
//      if (Yii::app()->request->isAjaxRequest) {
//        Yii::app()->clientScript->scriptMap = array(
//          'jquery.js'     => false,
//          'jquery.min.js' => false,
//        );
//      }
      if (YII_DEBUG) {
        if (isset($_GET['d']) && $_GET['d'] == 'clear') {
          Yii::app()->cache->flush();
        }
      }

      return parent::init();
    }

    public static function generatePaging($totalData)
    {
      $itemPerPage = Yii::app()->getParams()->itemAt('itemPerPage');
      $totalHal = ceil(abs($totalData / $itemPerPage));

      return $totalHal;
    }

  }