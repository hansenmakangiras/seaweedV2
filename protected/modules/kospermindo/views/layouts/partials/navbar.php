<div class="row nav-custom hidden-print">
  <!-- Profile Info and Notifications -->
  <div class="col-md-12 col-sm-8 clearfix hidden-print">

    <ul class="user-info pull-right pull-none-xsm hidden-print">
      <!-- Profile Info -->
      <li class="profile-info dropdown pull-right hidden-print">
        <!-- add class "pull-right" if you want to place this from right -->
        <a href="#" class="dropdown-toggle user hidden-print" data-toggle="dropdown">
          <img src="" data-name="<?php echo (!empty(Yii::app()->user->getName())) ? strtoupper(Yii::app()->user->getName()): "Guest" ?>" id="profile" alt="" class="img-circle profile" width="44"/>
          <strong style="color: #ffffff"><?php echo (!empty(Yii::app()->user->getName())) ? strtoupper(Yii::app()->user->getName()): "Guest" ?></strong>
        </a>

        <ul class="dropdown-menu">

          <!-- Reverse Caret -->
          <li class="caret"></li>

          <!-- Profile sub-links -->
          <li>
            <a href="/kospermindo/profile" class="no-margin">
              <i class="entypo-user"></i>
              Ubah Profil
            </a>
          </li>
          <li>
            <a href="/kospermindo/pengaturan" class="no-margin">
              <i class="entypo-cog"></i>
              Pengaturan
            </a>
          </li>
          <li>
            <a href="/kospermindo/message" class="no-margin">
              <i class=" entypo-mail"></i>
              Pesan
            </a>
          </li>
          <li>
            <a href="/kospermindo/users/logout" class="no-margin">
              <i class="entypo-logout"></i>
              Keluar
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<?php
  Yii::app()->clientScript->registerScript('initial', '
    $(".profile").initial({
      fontSize: 50,
      fontWeight: 700
     }); 
  ');
?>