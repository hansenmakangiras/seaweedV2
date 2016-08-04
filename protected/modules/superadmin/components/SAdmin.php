<?php

  /**
   * Superadmin helper class file.
   *
   * Provides static functions for interaction with Superadmin from outside of the module.
   *
   * @author Hansen Makangiras <hansen@docotel.co.id>
   * @copyright Copyright &copy; 2016 Hansen Makangiras
   * @since 0.0.1
   */
  class SAdmin
  {
    const PERM_NONE = 0;
    const PERM_DIRECT = 1;
    const PERM_INHERITED = 2;

    private static $_m;
    private static $_a;

    /**
     * Returns the base url to Superadmin.
     * @return the url to Superadmin.
     */
    public static function getBaseUrl()
    {
      $module = self::module();

      return Yii::app()->createUrl($module->baseUrl);
    }

    /**
     * @return KospermindoModule the Kospermindo module.
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
     * @return the Kospermindo module.
     */
    private static function findModule(CModule $module = null)
    {
      if ($module === null) {
        $module = Yii::app();
      }

      if (($m = $module->getModule('superadmin')) !== null) {
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
      return Yii::t('SuperadminModule.' . $category, $message, $params, $source, $language);
    }
  }
