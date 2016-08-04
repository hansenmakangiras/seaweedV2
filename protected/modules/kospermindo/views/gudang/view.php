<h1>View Book #<?php echo $model->id_petani; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'nama_petani',
        'id_koor'
    ),
)); ?>