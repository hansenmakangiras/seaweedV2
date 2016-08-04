<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Update User : <strong><?php echo $model->username?></strong></h2>
                <div class="row">
                    <?php echo $this->renderPartial('_form', array('model'=>$model,'id' => $id, 'pesan' => $pesan)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
