<section class="contact-map" id="map"></section>
<section class="contact-container">
  <div class="container">
    <div class="row">

      <div class="col-sm-7 sep">
        <?php if (Yii::app()->user->hasFlash('contact')): ?>
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
            <?php echo Yii::app()->user->getFlash('contact'); ?>
          </div>
        <?php else: ?>
          <h4>Get in touch with us, write us an e-mail!</h4>

          <p>
            To shewing another demands to. Marianne property cheerful informed at striking at. <br/>
            Clothes parlors however by cottage on.
          </p>
          <?php $form = $this->beginWidget('CActiveForm', array(
            'id'                     => 'contact-form',
            'enableAjaxValidation'   => false,
            'enableClientValidation' => true,
            'clientOptions'          => array(
              'validateOnSubmit' => true,
            ),
            'htmlOptions'            => array(
              'class'   => 'form-horizontal',
              'enctype' => "application/x-www-form-urlencoded",
            ),
          )); ?>
          <!--        <form class="contact-form" role="form" method="post" action="" enctype="application/x-www-form-urlencoded">-->
          <?php echo $form->errorSummary($model); ?>
          <div class="form-group">
            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Name:')); ?>
            <?php echo $form->error($model, 'name'); ?>
          </div>
          <div class="form-group">
            <?php echo $form->textField($model, 'email',
              array('class' => 'form-control', 'placeholder' => 'Email:')); ?>
            <?php echo $form->error($model, 'name'); ?>
          </div>
          <div class="form-group">
            <?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'maxlength' => 128,'placeholder' => "Subject:")); ?>
            <?php echo $form->error($model, 'subject'); ?>
          </div>
          <div class="form-group">
            <?php echo $form->textArea($model, 'body', array('class' => 'form-control',"placeholder" => "Message", "rows" =>"6")); ?>
            <?php echo $form->error($model, 'body'); ?>
          </div>
          <?php if (CCaptcha::checkRequirements()): ?>
            <div class="form-group">
              <?php $this->widget('CCaptcha'); ?>
              <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control','placeholder' => 'Verification Code:')); ?>
              <h5 class="hint">Please enter the letters as they are shown in the image above.</h5>
              <?php echo $form->error($model, 'verifyCode'); ?>
            </div>
          <?php endif; ?>
          <div class="form-group text-right">
            <?php echo CHtml::submitButton('Send', array("class" => "btn btn-primary","name" => "send")); ?>
          </div>
          <?php $this->endWidget(); ?>
        <?php endif; ?>
      </div>

      <div class="col-sm-offset-1 col-sm-4">

        <div class="info-entry">

          <h4>Address</h4>

          <p>
            Loop, Inc. <br/>
            795 Park Ave, Suite 120 <br/>
            San Francisco, CA 94107

            <br/>
            <br/>

            <strong>Working Hours:</strong>
            <br/>
            08:00 - 17:00 <br/>
            Monday to Friday
            <br/>
            <br/>
          </p>

        </div>

        <div class="info-entry">

          <h4>Call Us</h4>

          <p>
            Phone: +1 (52) 2215-251<br/>
            Fax: +1 (22) 5138-219<br/>
            info@laborator.al
          </p>

          <ul class="social-networks">
            <li>
              <a href="#">
                <i class="entypo-instagram"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="entypo-twitter"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="entypo-facebook"></i>
              </a>
            </li>
          </ul>

        </div>

      </div>

    </div>

  </div>

</section>
<!-- Footer Widgets --><section class="footer-widgets">

  <div class="container">

    <div class="row">

      <div class="col-sm-6">

        <a href="#">
          <img src="/static/admin/images/logo-color.png" width="200" />
        </a>

        <p>
          Vivamus imperdiet felis consectetur onec eget orci adipiscing nunc. <br />
          Pellentesque fermentum, ante ac interdum ullamcorper.
        </p>

      </div>

      <div class="col-sm-3">

        <h5>Address</h5>

        <p>
          Loop, Inc. <br />
          795 Park Ave, Suite 120 <br />
          San Francisco, CA 94107
        </p>

      </div>

      <div class="col-sm-3">

        <h5>Contact</h5>

        <p>
          Phone: +1 (52) 2215-251 <br />
          Fax: +1 (22) 5138-219 <br />
          info@laborator.al
        </p>

      </div>

    </div>

  </div>

</section>

