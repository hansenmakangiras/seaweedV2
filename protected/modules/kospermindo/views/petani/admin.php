<?php
    /**
     * Created by PhpStorm.
     * User: hanse
     * Date: 5/25/2016
     * Time: 2:37 PM
     */
    Yii::app()->clientScript->registerScript('search', "
        $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('book-grid', {
                data: $(this).serialize()
            });
            return false;
        });
");
?>
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Admin</h2>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
                        </p>
                        <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="search-form" style="display:none">
                    <?php $this->renderPartial('_search',array(
                        'model'=>$model,
                    )); ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php $this->widget('zii.widgets.grid.CGridView', array(
                                'id'=>'book-grid',
                                'dataProvider'=>$model->search(),
                                'filter'=>$model,
                                'columns'=>array(
                                    'id_petani',
                                    'nama_petani',
                                    'id_koor',
                                    array(
                                        'class'=>'CButtonColumn',
                                    )
                                ),
                            )); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



