<!-- Mail Body -->
<div class="mail-body">
  <?php //Helper::dd($model); ?>
  <div class="mail-header">
    <!-- title -->
    <div class="mail-title">
      <?php echo $model["subject"];?>
<!--      <span class="label label-warning">Friends</span>-->
<!--      <span class="label label-info">Sport</span>-->
    </div>

    <!-- links -->
    <div class="mail-links">

      <a href="/kospermindo/message/delete?id=<?php echo $model['id']; ?>" class="btn btn-default">
        <i class="entypo-trash"></i>
      </a>

<!--      <a href="--><?php //echo Yii::app()->createUrl("/kospermindo/message/reply", array("id" => $model['userid']))?><!--" class="btn btn-primary btn-icon">-->
<!--        Reply-->
<!--        <i class="entypo-reply"></i>-->
<!--      </a>-->

    </div>
  </div>

  <div class="mail-info">

    <div class="mail-sender dropdown">

      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo $this->baseUrl; ?>/static/admin/images/thumb-1.png" class="img-circle" width="30" />
        <span><?php echo ucfirst(Users::model()->getUserName($model['userid'])); ?></span>
        to <span>me</span>
      </a>

<!--      <ul class="dropdown-menu dropdown-red">-->
<!---->
<!--        <li>-->
<!--          <a href="#">-->
<!--            <i class="entypo-user"></i>-->
<!--            Add to Contacts-->
<!--          </a>-->
<!--        </li>-->
<!--        <li>-->
<!--          <a href="#">-->
<!--            <i class="entypo-menu"></i>-->
<!--            Show other messages-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="divider"></li>-->
<!--        <li>-->
<!--          <a href="/kospermindo/message/create">-->
<!--            <i class="entypo-reply"></i>-->
<!--            Reply-->
<!--          </a>-->
<!--        </li>-->
<!--      </ul>-->

    </div>

    <div class="mail-date">
      <?php echo date('H:i',strtotime($model['date_receive']))?> - <?php echo Helper::DateToIndo($model['date_receive'])?>
    </div>

  </div>

  <div class="mail-text">

    <p><?php echo $model['content']; ?></p>

  </div>



<!--  <div class="mail-reply">-->
<!---->
<!--    <div class="fake-form">-->
<!--      <div>-->
<!--        <a href="/kospermindo/message/create">Reply</a> or <a href="/kospermindo/message/create">Forward</a> this message...-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!--  </div>-->

</div>
