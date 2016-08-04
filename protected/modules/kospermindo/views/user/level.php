<h2>Users Management</h2><br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <!--          --><?php //$this->renderPartial('menu'); ?>
          <a href="/user/create" class="btn btn-default">Create User For Company</a>
          <a href="/user/level" class="btn btn-default">Manage Level</a>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <?php //Helper::dd($dataProvider->getTotalItemCount()) ?>
      <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
          <th width="5%">ID</th>
          <th width="10%">Level</th>
          <th>Deskripsi</th>
          <th width="30%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->getData() as $value) { ?>
          <!--            --><?php //if(Users::model()->isSuperUser() === true) { ?>
          <tr>
            <td><?= $value->id ; ?></td>
            <td><?= $value->level; ?></td>
            <td><?= $value->deskripsi; ?></td>
            <td>
              <a class="btn btn-sm btn-info" href="<?= $this->baseUrl; ?>/user/level/update?id=<?= strtolower($value->id); ?>">
                Edit
              </a>
              <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
                 data-href="<?php echo $this->baseUrl; ?>/user/delete"
                 data-record-body="Apakah anda yakin ingin menghapus data ini?"
                 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-info">Delete
              </a>
              <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                 data-href="<?php echo $this->baseUrl; ?>/user/aktifkandata"
                 data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                 data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-info">Show
              </a>

            </td>
          </tr>
        <?php } ?>
        <?php // } ?>
        </tbody>
      </table>
      <div class="panel panel-footer">
        <div class="row">
          <div class="col-sm-6">
            <?php
              $pages = $dataProvider->getPagination();
              //var_dump($pages);
              $this->widget('CLinkPager', array(
                'pages' => $dataProvider->pagination,
//            'currentPage'=>$pages->currentPage,
//            'itemCount'=>$dataProvider->getItemCount(),
//            'pageSize'=>$pages->pageSize,
//            'maxButtonCount'=>5,
//            //'nextPageLabel'=>'My text >',
//            'header'=>'',
//            'htmlOptions'=>array('class'=>'pagination pagination-sm'),
              ));?>
          </div>
          <div class="col-sm-6">
            <h5>Total Data : <?php echo $dataProvider->getTotalItemCount(); ?></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
