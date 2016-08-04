<br />
<!--<hr >-->
<div class="col-md-12">
  <?php if (!empty($pesan)) { ?>
    <div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
      <?= $pesan; ?>
    </div>
  <?php } ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'user-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
          'class' => 'form-horizontal validate',
          'role' => 'form',
          'novalidate'=>'novalidate'
        ),
      )); ?>
      <div class="form-group">
        <!-- <label class="col-sm-2 control-label">ID User</label> -->
        <!--                    <div class="col-sm-10">-->
        <!--                        <input type="hidden" class="form-control" value="-->
        <?php //echo $id; ?><!--" disabled>-->
        <!--                    </div>-->
      </div>
      <!-- <div class="hr-dashed"></div> -->
      <div class="form-group">
        <label class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'data-validate'=>'required')); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <?php echo $form->passwordField($model, 'password', array('class' => 'form-control','data-validate' => 'required')); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Group Level</label>
        <div class="col-sm-10">
          <?php echo $form->dropDownList($model, 'levelid',Level::model()->getLevel(), array('class' => 'form-control')); ?>
        </div>
      </div>
      <!-- <div class="form-group">
        <label class="col-sm-2 control-label">User Group</label>
        <div class="col-sm-10">
          <?php //echo $form->dropDownList($model, 'groupid',UsersGroup::model()->listGroups(3), array('class' => 'form-control')); ?>
        </div>
      </div> -->
      <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'email', array('class' => 'form-control','data-validate' =>'email','placeholder' => 'Input valid email')); ?>
        </div>
      </div>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">No Handphone</label>
        <div class="col-sm-10">
          <?php echo $form->textField($model, 'no_handphone', array('class' => 'form-control','data-validation' =>'required')); ?>
        </div>
      </div>
      <!-- <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Komoditi</label>
        <div class="col-sm-10">
          <?php //echo $form->textField($model, 'komoditi', array('class' => 'form-control','data-validation' => 'required')); ?>
        </div>
      </div> -->
      <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Komoditi</label>
          <div class="col-sm-10">
            <!-- <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" class="form-control tagsinput" /> -->
            <?php echo $form->textField($model, 'komoditi', array('class' => 'form-control tagsinput','data-validation' => 'required')); ?>
          </div>
        </div>
      <div class="hr-dashed"></div>
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
          <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
          <?php echo CHtml::submitButton('S a v e', array("class" => "btn btn-primary")); ?>
        </div>
      </div>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>
