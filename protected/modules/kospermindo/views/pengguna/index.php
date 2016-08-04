<h2>Users Management</h2><br/>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <!--          --><?php //$this->renderPartial('menu'); ?>
          <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=1" class="btn btn-default">Create Warehouse Keeper</a>
          <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=2" class="btn btn-default">Create Group Leader</a>
          <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=3" class="btn btn-default">Create Farmer</a>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <?php //Helper::dd($dataProvider->getTotalItemCount()) ?>
      <table id="zctb" class="table table-responsive table-bordered table-hover" cellspacing="0"
             width="100%">
        <thead>
        <tr>
          <th width="10%">ID</th>
          <th width="20%">Username</th>
          <!-- <th>No HP</th> -->
          <th>Level Akses</th>

          <th width="20%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $value) { ?>
          <tr>
            <td><?= $value->id; ?></td>
            <td><?= $value->username; ?></td>
            <td><?= $value->levelid; ?></td>
            <td>
              <a class="btn btn-sm btn-default" href="<?= $this->baseUrl; ?>">Lihat Hak Akses</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="panel panel-footer">
        <div class="row">
          <div class="col-sm-6">
            <?php
//              $pages = $dataProvider->getPagination();
              //var_dump($pages);
//              $this->widget('CLinkPager', array(
//                'pages' => $dataProvider->pagination,
//            'currentPage'=>$pages->currentPage,
//            'itemCount'=>$dataProvider->getItemCount(),
//            'pageSize'=>$pages->pageSize,
//            'maxButtonCount'=>5,
//            //'nextPageLabel'=>'My text >',
//            'header'=>'',
//            'htmlOptions'=>array('class'=>'pagination pagination-sm'),
//              ));
            ?>
          </div>
          <div class="col-sm-6">
<!--            <h5>Total Data : --><?php //echo $dataProvider->getTotalItemCount(); ?><!--</h5>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

