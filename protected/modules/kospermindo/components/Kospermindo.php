<?php

  /**
   * Kospermindo helper class file.
   *
   * Provides static functions for interaction with Kospermindo from outside of the module.
   *
   * @author Hansen Makangiras <hansen@docotel.co.id>
   * @copyright Copyright &copy; 2016 Hansen Makangiras
   * @since 0.0.1
   */
  class Kospermindo
  {
    const PERM_NONE = 0;
    const PERM_DIRECT = 1;
    const PERM_INHERITED = 2;

    private static $_m;
    private static $_a;

    public $dateFormat = 'Y-m-d H:i:s';

    /**
     * Returns the base url to Kospermindo.
     * @return the url to Kospermindo.
     */
    public static function getBaseUrl()
    {
      $module = self::module();

      return Yii::app()->createUrl($module->baseUrl);
    }

    /**
     * @return string $_m Get This module.
     */
    public static function module()
    {
      if (isset(self::$_m) === false) {
        self::$_m = self::findModule();
      }

      return self::$_m;
    }

    /**
     * Searches for the Kospermindo module among all installed modules.
     * The module will be found even if it's nested within another module.
     *
     * @param CModule $module the module to find the module in. Defaults to null,
     * meaning that the application will be used.
     *
     * @return string $m Kospermindo module.
     */
    private static function findModule(CModule $module = null)
    {
      if ($module === null) {
        $module = Yii::app();
      }

      if (($m = $module->getModule('kospermindo')) !== null) {
        return $m;
      }

      foreach ($module->getModules() as $id => $c) {
        if (($m = self::findModule($module->getModule($id))) !== null) {
          return $m;
        }
      }

      return null;
    }

    /**
     * Translates a message to the specified language.
     * Wrapper class for setting the category correctly.
     *
     * @param string $category message category.
     * @param string $message the original message.
     * @param array  $params parameters to be applied to the message using <code>strtr</code>.
     * @param string $source which message source application component to use.
     * @param string $language the target language.
     *
     * @return string the translated message.
     */
    public static function t($category, $message, $params = array(), $source = null, $language = null)
    {
      return Yii::t('KospermindoModule.' . $category, $message, $params, $source, $language);
    }

    public static function getCountUnreadMessages()
    {
      $data = Messages::model()->findAll("sent_status = 0 AND is_read = 0");
      return count($data);
    }

    public static function getCountReadMessages()
    {
      $data = Messages::model()->findAll("sent_status = 0 AND is_read = 1");
      return count($data);
    }

    public static function getCountDraft()
    {
      $data = Messages::model()->findAll("is_draft = 1");
      return count($data);
    }

    public static function getCountUnreadDraft()
    {
      $data = Messages::model()->findAll("is_draft = 0");
      return count($data);
    }

    public static function getSentMessageStatus(){
      $data = Messages::model()->findAll("sent_status = 1");
      return count($data);
    }

    public function getCountUnreadedMessages($userId) {
      return Messages::model()->getCountUnreaded($userId);
    }
  }
