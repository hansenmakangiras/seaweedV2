<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 6/25/2016
   * Time: 11:35 PM
   */
class Panrita
{
  public static function getLevelAkses()
  {
    return array(
      CAuthItem::TYPE_OPERATION => Yii::t('core','Operation'),
      CAuthItem::TYPE_ROLE => Yii::t('core','Role'),
      CAuthItem::TYPE_TASK => Yii::t('core','Task'),
    );
  }

  /**
   * Returns the cross-site request forgery parameter for Ajax-requests.
   * Null is returned if csrf-validation is disabled.
   * @return string the csrf parameter.
   */
  public static function getCsrfParam()
  {
    if( Yii::app()->request->enableCsrfValidation===true )
    {
      $csrfTokenName = Yii::app()->request->csrfTokenName;
      $csrfToken = Yii::app()->request->csrfToken;
      return "'$csrfTokenName':'$csrfToken'";
    }
    else
    {
      return null;
    }
  }

  /**
   * @return string a string that can be displayed on your Web page
   * showing Powered-by-Panrita information.
   */
  public static function powered()
  {
    return 'Built by <a href="http://www.docotel.com" rel="external">PT.DTC</a> version 1.0.0';
  }

  /**
   * Translates a message to the specified language.
   * Wrapper class for setting the category correctly.
   * @param string $category message category.
   * @param string $message the original message.
   * @param array $params parameters to be applied to the message using <code>strtr</code>.
   * @param string $source which message source application component to use.
   * @param string $language the target language.
   * @return string the translated message.
   */
  public static function t($category, $message, $params=array(), $source=null, $language=null)
  {
    return Yii::t('PanritaModule.'.$category, $message, $params, $source, $language);
  }
}