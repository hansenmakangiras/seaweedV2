<?php
/**
* Kospermindo base controller class file.
*
* @author Hansen Makangiras <hansen@docotel.co.id>
* @copyright Copyright &copy; 2016 Hansen Makangiras
* @since 0.1
*/
class KController extends CController
{
    /**
    * @property string the default layout for the controller view. Defaults to '//layouts/column1',
    * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
    */
    public $layout='/layouts/column1';
    /**
    * @property array context menu items. This property will be assigned to {@link CMenu::items}.
    */
    public $menu=array();
    /**
    * @property array the breadcrumbs of the current page. The value of this property will
    * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
    * for more details on how to specify this property.
    */
    public $breadcrumbs=array();
    public $baseUrl;

    public function init()
    {
      Helper::setTimeZone('Asia/Makassar');

//      Yii::app()->clientScript->registerCoreScript('jquery');
//      Yii::app()->clientScript->registerCoreScript('yii');

      // Tweaks for Ajax Requests
      Yii::app()->user->loginRequiredAjaxResponse = "<script>window.location.href = '" . Yii::app()->user->id . "';</script>";
      if (Yii::app()->request->isAjaxRequest) {
        Yii::app()->clientScript->scriptMap = array(
          'jquery.js'     => false,
          'jquery.min.js' => false,
        );
      }
      if (YII_DEBUG) {
        if (isset($_GET['d']) && $_GET['d'] == 'clear') {
          Yii::app()->cache->flush();
        }
      }

      return parent::init();
    }
}
