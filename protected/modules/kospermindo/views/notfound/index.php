<div class="wrapper-page-notfound">
  <div class="container clearfix center-vh">
    <div class="wrapper-notfound text-center">
      <div class="col-md-12 col-centered no-padding">
        <h2 class="no-margin"><?php echo isset($message) ? CHtml::encode($message): 'OPSS ! SORRY, PAGE NOT FOUND' ; ?></h2>
        <br>
        <h1 class="no-margin"><strong><?php echo isset($code)?$code:'404'; ?></strong></h1>
        <br>
        <a href="<?php echo $this->baseUrl; ?>">- BACK TO HOME -</a>
    </div>
  </div>
</div>