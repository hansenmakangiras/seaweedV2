<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 2:37 PM
   */
  Yii::app()->clientScript->registerScript('search', "
//        $('.search-button').click(function(){
//            $('.search-form').toggle();
//            return false;
//        });
//        $('.panel').submit(function(){
//            $.fn.yiiGridView.update('grid', {
//                data: $(this).serialize()
//            });
//            return false;
//        });
");
?>
<h2>Groups Management</h2><br />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
<!--          --><?php //$this->renderPartial('menu'); ?>
       <?php if(Users::model()->isSuperUser() === true) { ?>
          <a href="/user/create" class="btn btn-default">Create User For Company</a>
        <?php }else { ?>
         <a href="/user" class="btn btn-default">Manage Seaweed</a>
          <a href="/user/setgroup" class="btn btn-default">Manage Groups</a>
          <a href="/user/setwarehouse" class="btn btn-default">Manage Warehouses</a>
          <a href="/user/setfarmer" class="btn btn-default">Manage Farmers</a>
          
        <?php } ?>
          <!-- <a href="/user/level" class="btn btn-default">Manage Level</a> -->
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <?php //Helper::dd($dataProvider->getTotalItemCount()) ?>
      <?php if(Users::model()->isSuperUser()==true) { ?>
        <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th width="5%">ID</th>
            <th width="10%">Username</th>
            <th>Help Desk Phone</th>
            <th width="15%">Email</th>
            <?php if(Users::model()->isSuperUser()==true) { ?>
            <th>Type of Commodity</th>
            <?php } ?>
            <th>Status</th>
            <th width="15%">Action</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($data as $value) { ?>
            
              <tr>
                <td><?= $value->id; ?></td>
                <td><?= $value->username; ?></td>
                <td><?= $value->no_handphone; ?></td>
                <td><?= $value->email; ?></td>
                <?php if(Users::model()->isSuperUser()==true) { ?>
                <td><?= $value->komoditi; ?></td>
                <?php } ?>
                <td><?= ($value->status === '1') ? 'Aktif' : 'Non Aktif'; ?></td>
                <td>
                  <a class="btn btn-sm btn-default" href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value->id); ?>">
                    Edit
                  </a>
                  <?php if($value->status === '0') { ?>
                    <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                       data-href="<?php echo $this->baseUrl; ?>/user/aktifkandata"
                       data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                       data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                    </a>
                  <?php } else { ?>
                    <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
                       data-href="<?php echo $this->baseUrl; ?>/user/delete"
                       data-record-body="Apakah anda yakin ingin menghapus data ini?"
                       data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Disable
                    </a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          
          </tbody>
        </table>
        <?php }else { ?>
          <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th width="5%">ID</th>
            <th>Group Name</th>
            <th>Group Location</th>
            <th>Status</th>
            <th>Action</th>
            
          </tr>
          </thead>
          <tbody>
          <?php foreach ($groupData as $value) { ?>
            <tr>
                <td><?= $value->id; ?></td>
                <td><?= $value->nama_kelompok; ?></td>
                <td><?= $value->lokasi; ?></td>
                
                <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
                <td>
                  <?php if(($value->status) === '0') { ?>
                    <a href="#" data-record-id="<?= strtolower($value->id_user); ?>" data-record-title="Confirmation"
                       data-href="<?php echo $this->baseUrl; ?>/user/delete"
                       data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                       data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                    </a>
                  <?php } else { ?>
                    <a class="btn btn-default btn-sm btn-icon icon-left" href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value['id_user']); ?>"><i class="entypo-pencil"></i>
                      Edit
                    </a>
                    <a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation"
                       data-href="<?php echo $this->baseUrl; ?>/user/delete"
                       data-record-body="Apakah anda yakin ingin menghapus data ini?"
                       data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Disable
                       <i class="entypo-cancel"></i>
                    </a>

                    <?php echo CHtml::link('<i class="entypo-info"></i>Details', $this->createUrl('/user/showfarmers?gid='.strtolower($value->nama_kelompok).'&id='.strtolower($value->id_user)) , array('class' =>'btn btn-info btn-sm btn-icon icon-left'))?>
                  <?php } ?>
                </td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
        <?php }?>
      
      <div class="panel panel-footer">
        <div class="row">
          <div class="col-sm-6">
            <?php
              //$pages = $dataProvider->getPagination();
              //var_dump($pages);
              //$this->widget('CLinkPager', array(
              //  'pages' => $dataProvider->pagination,
//            'currentPage'=>$pages->currentPage,
//            'itemCount'=>$dataProvider->getItemCount(),
//            'pageSize'=>$pages->pageSize,
//            'maxButtonCount'=>5,
//            //'nextPageLabel'=>'My text >',
//            'header'=>'',
//            'htmlOptions'=>array('class'=>'pagination pagination-sm'),
              //));?>
          </div>
          <div class="col-sm-6">
            <h5>Total Data : <?php //echo $dataProvider->getTotalItemCount(); ?></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
