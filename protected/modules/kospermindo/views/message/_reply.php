<!-- Mail Body -->
<div class="mail-body">

  <div class="mail-header">
    <!-- title -->
    <div class="mail-title">
      <!--        <i class="entypo-pencil"></i>-->
      Compose Mail
    </div>

    <!-- links -->
    <div class="mail-links">
      <a href="#" class="btn btn-sm btn-default">
        <i class="entypo-cancel"></i>
      </a>
      <a href="#" class="btn btn-sm btn-default">
        Draft
        <i class="entypo-tag"></i>
      </a>
      <a class="btn btn-success btn-sm">
        Send
        <i class="entypo-mail"></i>
      </a>
    </div>
  </div>


  <div class="mail-compose">
    <?php $this->renderPartial('_form'); ?>
  </div>
</div>