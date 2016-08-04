<div class="content-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">View User #<?php echo $model->id; ?></h2>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <?php //var_dump($model->attributes);?>
                <?php $this->widget('zii.widgets.CDetailView', array(
                  'data'=>$model,
                  'attributes'=>array(
                    'id',
                    'username',
                    'no_handphone'
                  ),
                  'htmlOptions' => array(
                    'class' => 'content-format'
                  ),
                  'itemCssClass' => '
                  '
                )); ?>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>
