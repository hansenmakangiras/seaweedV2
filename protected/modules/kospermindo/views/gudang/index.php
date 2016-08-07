<div class="headline">
  <ol class="breadcrumb bc-3">
    <li>
      <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>
    </li>
    <li class="active">
      <strong><?php echo 'Data Gudang'; ?></strong>
    </li>
  </ol>
  <h2>Manajemen Data Gudang</h2><br/>
</div>

<div class="row">
  <div class="col-md-12">
    <div id="pesan" class="row">
      <div class="col-md-6">
        <?php if (Yii::app()->user->hasFlash('success')) { ?>
          <div class="alert alert-success">
            <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?></strong>
          </div>
        <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
          <div class="alert alert-danger">
            <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('error')); ?></strong>
          </div>
        <?php }else{ ?>
          <div></div>
        <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <a href="/kospermindo/gudang/tambah" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</a>
<!--        <form action="/kospermindo/gudang" method="POST" class="form-horizontal validate">-->
<!--          <div class="form-group">-->
<!--            <div class="col-md-6">-->
<!--              <input id="lokasi" type="text" placeholder="Lokasi Gudang" name="lokasi" class="form-control input-lg" data-validate="required">-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--              <button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>-->
<!--            </div>-->
<!--          </div>-->
<!--        </form>-->
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
          'dataProvider'=>$data,
          'template'=>'{items} {pager}',
          'itemsCssClass'=>'table table-bordered table-responsive table-hover',
          'emptyText'=>Kospermindo::t('core', 'Hasil tidak ditemukan'),
          //'htmlOptions'=>array('class'=>'grid-view role-table'),
          'columns'=>array(
            array(
              'name'=>'id',
              'header'=>Kospermindo::t('core', 'No'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->id',
            ),
            array(
              'name'=>'lokasi',
              'header'=>Kospermindo::t('core', 'Lokasi'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->lokasi',
            ),
            array(
              'name'=>'provinsi',
              'header'=>Kospermindo::t('core', 'Provinsi'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->provinsi',
            ),
            array(
              'name'=>'kabupaten',
              'header'=>Kospermindo::t('core', 'Kabupaten'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->kabupaten',
              //'visible'=>'',
            ),
            array(
              'name'=>'titik_koordinat',
              'header'=>Kospermindo::t('core', 'Titik Koordinat'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->titik_koordinat',
              //'visible'=>Kospermindo::module()->enableBizRuleData===true,
            ),
            array(
              'name'=>'jumlah_stok',
              'header'=>Kospermindo::t('core', 'Jumlah Stok'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->jumlah_stok',
              //'visible'=>Kospermindo::module()->enableBizRuleData===true,
            ),
            array(
              'name'=>'deskripsi',
              'header'=>Kospermindo::t('core', 'Deskripsi'),
              'type'=>'raw',
              'htmlOptions'=>array('class'=>'text-center'),
              'value'=>'$data->deskripsi',
              //'visible'=>Kospermindo::module()->enableBizRuleData===true,
            ),
            array(
              'header' => 'Aksi',
              'htmlOptions'=>array('width'=>'20%','class' => 'text-center'),
              'class' => 'CButtonColumn',
              'template' => '{sunting} {hapus}',
              'buttons' => array(
                'sunting' => array(
                  'label' => '<i class="entypo-pencil"></i> Sunting',
                  'options' => array('class' => 'btn btn-default btn-sm btn-icon icon-left'),
                  'url' => 'Yii::app()->createUrl(\'/kospermindo/gudang/ubah\',array(\'id\' => strtolower($data->id)))'
                ),
                'hapus' => array(
                  'type' => 'raw',
                  'label' => 'Hapus <i class="entypo-trash"></i>',
                  'url' => '"#"',
                  'options' => array(
                    'class' => 'btn btn-danger btn-sm btn-icon icon-left',
                    'data-record-id' => '$data->id',
                    'data-record-title' => 'Konfirmasi',
                    'data-href' => '/kospermindo/gudang/hapus',
                    'data-record-body' => 'Apakah anda yakin ingin menghapus data ini?',
                    'data-toggle' => 'modal',
                    'data-target' => '#confirm-delete'
                  ),
                )
              )
            ),
          )
        )); ?>

      </div>
    </div>
  </div>
  <div class="col-md-12 center">
    <?php
//      $pages = $data->pagination;
//      $this->widget('CLinkPager', array(
//        'pages'             => $pages,
//        'maxButtonCount' => 30,
//        'pageSize'          => 10,
//        'itemCount' => (int) $data->totalItemCount,
//        'htmlOptions'       => array('class' => 'pagination pagination-custom'),
//        'hiddenPageCssClass' => '',
//        //'firstPageCssClass' => 'active',
//        //'lastPageCssClass' => 'active',
//        'selectedPageCssClass' => 'active',
//        //'currentPage'       => '1',
//        'header' => '',
//        'nextPageLabel'     => 'Berikutnya',
//        'prevPageLabel'     => 'Sebelumnya',
//        'lastPageLabel'     => 'Akhir',
//        'firstPageLabel'     => 'Awal',
//      ));
    ?>
  </div>
</div>
<script>
  var baseurl;
</script>
<?php
  Yii::app()->clientScript->registerScript('close-alert', '
  setTimeout(function () {
    $("#pesan").addClass("hidden");
  }, 5000); 
   
  ', CClientScript::POS_END);
?>