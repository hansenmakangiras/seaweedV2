<div class="login-header login-caret">

  <div class="login-content">

    <a href="<?= $this->baseUrl; ?>" class="logo">
      <img src="<?= $this->baseUrl; ?>/static/admin/images/logo-white.png" width="200" alt="Logo Panrita" />
    </a>

    <p class="description">Create an account, it's free and takes few moments only!</p>

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
      <p id="pesan" class="no-padding"><?= !empty($pesan) ? $pesan : ''?></p>
    </div>
    <?php $form = $this->beginWidget('CActiveForm', array(
      'id'                   => 'register-form',
      'enableAjaxValidation' => true,
      'htmlOptions'          => array(
        'class' => 'mt',
        'role' => 'form',
        'id' => 'form_register'
      ),
    )); ?>

    <div class="form-register-success">
      <i class="entypo-check"></i>
      <h3>You have been successfully registered.</h3>
      <p>We have emailed you the confirmation link for your account.</p>
    </div>
    <div class="form-steps">

      <div class="step current" id="step-1">
        <div class="form-group">

          <div class="input-group">
            <div class="input-group-addon">
              <i class="entypo-user"></i>
            </div>
            <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" autocomplete="off" />
          </div>
        </div>

        <div class="form-group">

          <div class="input-group">
            <div class="input-group-addon">
              <i class="entypo-phone"></i>
            </div>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" data-mask="phone" autocomplete="off" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="entypo-calendar"></i>
            </div>

            <input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Date of Birth (DD/MM/YYYY)" data-mask="date" autocomplete="off" />
          </div>
        </div>

        <div class="form-group">
          <button type="button" data-step="step-2" class="btn btn-primary btn-block btn-login">
            <i class="entypo-right-open-mini"></i>
            Next Step
          </button>
        </div>

        <div class="form-group">
          Step 1 of 2
        </div>

      </div>

      <div class="step" id="step-2">

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="entypo-user-add"></i>
            </div>

            <input type="text" class="form-control" name="username" id="username" placeholder="Username" data-mask="[a-zA-Z0-1\.]+" data-is-regex="true" autocomplete="off" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="entypo-mail"></i>
            </div>

            <input type="text" class="form-control" name="email" id="email" data-mask="email" placeholder="E-mail" autocomplete="off" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="entypo-lock"></i>
            </div>

            <input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" autocomplete="off" />
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block btn-login">
            <i class="entypo-right-open-mini"></i>
            Complete Registration
          </button>
        </div>

        <div class="form-group">
          Step 2 of 2
        </div>

      </div>

    </div>
    <?php $this->endWidget(); ?>
    <div class="login-bottom-links">

      <a href="/kospermindo/users/login" class="link">
        <i class="entypo-lock"></i>
        Return to Login Page
      </a>

      <br />

      &copy; 2016 Panrita. by
      <a href="https://www.docotel.com" target="_blank">Docotel Teknologi Celebes</a>

    </div>
  </div>
</div>
