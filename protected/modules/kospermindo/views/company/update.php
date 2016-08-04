<div class="content-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Update Company <?php echo $model->name; ?></h2>
        <div class="row">
          <?php echo $this->renderPartial('_form', array('model'=>$model,'komoditiTipe'=>$komoditiTipe)); ?>
        </div>
      </div>
    </div>
  </div>
</div>
