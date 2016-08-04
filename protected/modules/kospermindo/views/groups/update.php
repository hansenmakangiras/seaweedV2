
<?php if($level==1) { ?>
    <?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 2:37 PM
   */
  Yii::app()->clientScript->registerScript('search', "
    var element = $('#main-menu li[data-nav=\"manage-user\"]');
    element.addClass('active opened');
    element.find('ul').addClass('visible').removeAttr('style');
    element.find('ul').find('li:nth-child(1)').addClass('active');
");
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Perbaharuan Gudang: <strong><?php echo $model->username?></strong></h2>
                    <div class="row">
                        <?php echo $this->renderPartial('_form', array('model'=>$model,'model_koordinator'=>$model_koordinator,'pesan' => $pesan,'level'=>$level)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }elseif ($level==2) { ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Perbaharuan Kelompok: <strong><?php echo $model->username?></strong></h2>
                    <div class="row">
                        <?php echo $this->renderPartial('_form', array('model'=>$model,'model_kelompok'=>$model_kelompok,'pesan' => $pesan,'level'=>$level)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }elseif ($level==3) { ?>
    <?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 2:37 PM
   */
  Yii::app()->clientScript->registerScript('search', "
    var element = $('#main-menu li[data-nav=\"manage-user\"]');
    element.addClass('active opened');
    element.find('ul').addClass('visible').removeAttr('style');
    element.find('ul').find('li:nth-child(3)').addClass('active');
");
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Perbaharuan Petani: <strong><?php echo $model->username?></strong></h2>
                    <div class="row">
                        <?php echo $this->renderPartial('_form', array('model'=>$model,'model_petani'=>$model_petani,'pesan' => $pesan,'level'=>$level)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else { 
    $this->redirect('site/error', true, 404);
} ?>