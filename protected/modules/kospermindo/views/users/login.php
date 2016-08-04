<div class="login-header login-caret">

  <div class="login-content">

    <a href="<?= $this->baseUrl; ?>" class="logo">
      <img src="<?= $this->baseUrl; ?>/static/admin/images/logo-white.png" width="200" alt="Logo Panrita"/>
    </a>

    <p class="description">Dear user, log in to access the admin area!</p>

    <!-- progress bar indicator -->
    <div class="login-progressbar-indicator">
      <h3>43%</h3>
      <span>Logging in...</span>
    </div>
  </div>

</div>

<div class="login-progressbar">
  <div></div>
</div>

<div class="login-form">

  <div class="login-content">

    <div class="form-login-error form-login-error-custom">
      <p id="pesan" class="no-padding"><?= !empty($pesan) ? $pesan : '' ?></p>
    </div>
    <?php $form = $this->beginWidget('CActiveForm', array(
      'id'                   => 'login-form',
      'enableAjaxValidation' => true,
//      'enableClientValidation'=>true,
//       'clientOptions'=>array(
//           'validateOnSubmit'=>true,
//       ),
      'htmlOptions'          => array(
        'class' => 'mt',
        'role'  => 'form',
        'id'    => 'form_login',
      ),
    )); ?>

    <div class="form-group">

      <div class="input-group">
        <div class="input-group-addon">
          <i class="entypo-user"></i>
        </div>
        <input type="text" class="form-control" name="LoginForm[username]" id="username" placeholder="Username"
               autocomplete="off"/>
      </div>
    </div>

    <div class="form-group">

      <div class="input-group">
        <div class="input-group-addon">
          <i class="entypo-key"></i>
        </div>
        <input type="password" class="form-control" name="LoginForm[password]" id="password" placeholder="Password"
               autocomplete="off"/>
      </div>
    </div>

    <div class="form-group text-left">
      <?php $checked = false; ?>
      <div class="checkbox checkbox-replace">
        <input type="checkbox" id="rememberMe" name="LoginForm[rememberMe]"
               checked="<?= $checked === true ? 'true' : 'false' ?>">
        <label>
          Remember me
        </label>
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block btn-login">
        <i class="entypo-login"></i>
        Log In
      </button>
    </div>
    <?php $this->endWidget(); ?>

    <div class="login-bottom-links">
      <a href="/forgot" class="link">Forgot your password?</a>
      <br/>
      &copy; 2016 Panrita. by
      <a href="https://www.docotel.com" target="_blank">Docotel Teknologi Celebes</a>
    </div>
  </div>
</div>
<?php
  Yii::app()->clientScript->registerScriptFile(Kospermindo::module()->getAssetsUrl().'/kospermindo-login.js',CClientScript::POS_END);
//  Yii::app()->clientScript->registerScriptFile($this->baseUrl.'/static/admin/js/neon-login.js',CClientScript::POS_END);
?>
