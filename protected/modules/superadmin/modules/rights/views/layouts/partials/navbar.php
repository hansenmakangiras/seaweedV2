<div class="row">
  <!-- Profile Info and Notifications -->
  <div class="col-md-6 col-sm-8 clearfix">

    <ul class="user-info pull-left pull-none-xsm">
      <!-- Profile Info -->
      <li class="profile-info dropdown">
        <!-- add class "pull-right" if you want to place this from right -->

        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?= $this->baseUrl ?>/static/admin/images/thumb-1@2x.png" alt="" class="img-circle" width="44"/>
          Welcome, <strong><?php echo (!empty(Yii::app()->user->getName())) ? strtoupper(Yii::app()->user->getName()): "Guest" ?></strong>
        </a>

        <ul class="dropdown-menu">

          <!-- Reverse Caret -->
          <li class="caret"></li>

          <!-- Profile sub-links -->
          <li>
            <a href="/profile" class="no-margin">
              <i class="entypo-user"></i>
              Edit Profile
            </a>
          </li>

          <li>
            <a href="/message" class="no-margin">
              <i class=" entypo-mail"></i>
              Inbox
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>

  <!-- Raw Links -->
  <div class="col-md-6 col-sm-4 clearfix hidden-xs">

    <ul class="list-inline links-list pull-right">
      <li>
        <a href="<?= $this->baseUrl; ?>/settings">
          Settings <i class="entypo-cog right"></i>
        </a>
      </li>
      <li class="sep"></li>

      <li>
        <a href="<?= $this->baseUrl; ?>/site/logout">
          Log Out <i class="entypo-logout right"></i>
        </a>
      </li>
    </ul>

  </div>

</div>
<hr/>
<?php
  Yii::app()->clientScript->registerScript('initial', '
    $(".profile").initial({
      fontSize: 50,
      fontWeight: 700
     }); 
  ');
?>