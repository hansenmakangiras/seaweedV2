<h2>List Moderator</h2>
<div class="row">
  <div class="col-md-8">
  <?php if(Yii::app()->user->hasFlash('pesan')) {?>
      <div class="alert alert-success" id="myHideEffect"><strong><?php echo Yii::app()->user->getFlash('pesan'); ?></strong></div>
    <?php  } ?>
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <!-- <a href="<?php echo $this->baseUrl; ?>/pengguna/create?level=3" class="btn btn-default">Add Farmer</a> -->
  <a href="<?= $this->baseUrl; ?>/kospermindo/moderator/create" class="btn btn-default">
              <i class="entypo-plus"></i> Tambah Moderator
            </a>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
          <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php endif; ?>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>
      <table id="tblpetani" class="table table-responsive table-hover table-bordered">
                <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th>Nama Moderator</th>
                  <th>Status</th>
                  

                </tr>
                </thead>
                <tbody>
                <?php foreach ($moderator as $value) { ?>
                  
                  <tr>
                    <td><?= $value->id; ?></td>
                    <td><?= $value->username; ?></td>
                    <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
                    
                  </tr>
                <?php } ?>
                </tbody>
              </table>
      <div class="panel panel-footer">
        <div class="row">
          <div class="col-sm-6">
            <?php
              //echo Helper::dd($data->pagination);
              //$pages = $data->getPagination();
              //$this->widget('CLinkPager', array(
                //'pages' => $data->pagination,
//                'currentPage'=>$pages->currentPage,
//                'itemCount'=>$data->getItemCount(),
//                'pageSize'=>$pages->pageSize,
//                'maxButtonCount'=>5,
//                //'nextPageLabel'=>'My text >',
//                'header'=>'',
//                'htmlOptions'=>array('class'=>'pagination pagination-sm'),
              //));?>
          </div>
          <div class="col-sm-6">
            <!--            <h5>Total Data : --><?php //echo $data->getTotalItemCount(); ?><!--</h5>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 
<div class="row">
  <div class="col-md-12">
    <p class="text-info">Disini anda dapat menambahkan pengguna,mengedit pengguna,dan lain-lain.</p>
    <hr>
   
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table id="tblpetani" class="table table-responsive table-hover table-bordered">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="10%">Username</th>
                <th>Help Desk Phone</th>
                <th width="15%">Email</th>
                <?php if (Users::model()->isSuperUser() == true) { ?>
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
                  <?php if (Users::model()->isSuperUser() == true) { ?>
                    <td><?= $value->komoditi; ?></td>
                  <?php } ?>
                  <td><?= ($value->status === '1') ? 'Aktif' : 'Non Aktif'; ?></td>
                  <td>

                    <a class="btn btn-sm btn-default"
                       href="<?= $this->baseUrl; ?>/kospermindo/user/update?id=<?= strtolower($value->id); ?>">
                      Edit
                    </a>
                    <?php if ($value->status === '0') { ?>
                      <a href="#" data-record-id="<?= strtolower($value->id); ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/aktifkandata"
                         data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                      </a>
                    <?php } else { ?>
                      <a href="#" data-record-id="<?= $value->id; ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
                         data-record-body="Apakah anda yakin ingin menghapus data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Disable
                      </a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>

              </tbody>
            </table>
          <?php } else { ?>
           
            <a href="<?= $this->baseUrl; ?>/kospermindo/moderator/create" class="btn btn-default">
            	<i class="entypo-plus"></i> Tambah Moderator
            </a>
            <br/>
            <br/>
            <div class="col-md-8">
              <table id="tblpetani" class="table table-responsive table-hover table-bordered">
                <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th>Nama Moderator</th>
                  <th>Status</th>
                  

                </tr>
                </thead>
                <tbody>
                <?php foreach ($moderator as $value) { ?>
                  
                  <tr>
                    <td><?= $value->id; ?></td>
                    <td><?= $value->username; ?></td>
                    <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
                    
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?> 

  </div>
</div>

   -->