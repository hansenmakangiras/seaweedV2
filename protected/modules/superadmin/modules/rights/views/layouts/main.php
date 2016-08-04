<?php $this->beginContent(Rights::module()->appLayout); ?>
  <h2><?php echo $this->pageTitle; ?></h2>

  <div class="row">
    <div id="rights" class="col-md-12">
      <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
          <div class="panel-title">
            <?php if( $this->id!=='install' ): ?>
              <?php $this->renderPartial('/_menu'); ?>
            <?php endif; ?>
          </div>
          <?php if (Yii::app()->user->hasFlash('success')): ?>
            <?php echo Yii::app()->user->getFlash('success'); ?>
          <?php endif; ?>
          <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          </div>
        </div>
        <div id="content" class="panel panel-body">
          <?php $this->renderPartial('/_flash'); ?>
          <?php echo $content; ?>
        </div>
      </div>

    </div>
  </div>
<?php $this->endContent(); ?>