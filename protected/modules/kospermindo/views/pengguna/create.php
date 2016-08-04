<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Add Users</h2>
                <div class="row">
                <?php echo $this->renderPartial('_form', array('model'=>$model,'pesan' => $pesan,'level'=>$level,'model_koordinator'=>$model_koordinator,'model_kelompok'=>$model_kelompok,'model_petani'=>$model_petani)); ?>
                </div>
            </div>
        </div>
    </div>
</div>