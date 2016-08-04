<?php $this->beginContent(Rights::module()->appLayout); ?>
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row">
        <div id="rights" class="col-md-12">
          <div class="panel panel-default">
            <div id="content" class="panel panel-body">
              <?php if( $this->id!=='install' ): ?>
                <?php $this->renderPartial('/_menu'); ?>
              <?php endif; ?>
              <?php $this->renderPartial('/_flash'); ?>

              <?php echo $content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->endContent(); ?>