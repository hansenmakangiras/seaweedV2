<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Registrasi Moderator</h2>
                <div class="row">
                <?php echo $this->renderPartial('_form', array('model_petani'=>$model_petani,'model'=>$model,'pesan' => $pesan,'update'=>$update,'pesan_group'=>$pesan_group,'profile' =>$profile)); ?>
                </div>
            </div>
        </div>
    </div>
</div>