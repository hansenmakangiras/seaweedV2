<h2 class="page-title"><?php echo $this->pageTitle; ?></h2>
<div class="row">
  <div class="col-md-12">

    <div class="panel panel-primary" data-collapsed="0">

      <div class="panel-heading">
        <div class="panel-title">
<!--          <a href="/company/create" class="btn btn-default">Create new company</a>-->
        </div>
        <div class="panel-options">
<!--          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>-->
        </div>
      </div>
      <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
          'id',
          'prefix',
          'name',
          'type',
          'location',
          'telephone',
          'address',
          'komoditi_type',
        ),
        'itemCssClass' => 'table table-hover'
      )); ?>

    </div>

  </div>
</div>

