<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Forms</h2>
                <div class="row">
                    <div class="col-md-12">
                            <?php  if(isset($pesan)) { ?>
                                <div class="alert alert-dismissible alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                    <strong>Well done!</strong> <?= $pesan; ?> <a href="#" class="alert-link">this important alert message</a>.
                                </div>
                            <?php }?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Form fields</div>

                            <div class="panel-body">
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'book-form',
                                    'action'=>'../kordinator/create',
                                    'enableAjaxValidation'=>false,
                                    'htmlOptions' => array(
                                    'class' => 'form-horizontal'
                                    )
                                )); ?>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama Koordinator</label>
                                        <div class="col-sm-10">
                                        <input  class="form-control" type="text" name="koordinator[nama_koordinator]" required>
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-default" type="reset">Cancel</button>
<!--                                            <button class="btn btn-primary" type="submit">Simpan</button>-->
                                            <?php echo CHtml::submitButton('Simpan', array("class" => "btn btn-primary")); ?>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
<!--                                </form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
