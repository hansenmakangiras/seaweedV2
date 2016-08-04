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
    var element = $('#main-menu li[data-nav=\"manage-user\"]');
    element.addClass('active opened');
    element.find('ul').addClass('visible').removeAttr('style');
    element.find('ul').find('li:nth-child(3)').addClass('active');
");
?>

<ol class="breadcrumb bc-3">
  <li>
    <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Teras</a>
  </li>
  <li>
    <a href="<?= Kospermindo::getBaseUrl(); ?>/users">Users</a>
  </li>
  <li class="active">
    <strong><?php echo 'Petani'; ?></strong>
  </li>
</ol>
<h3>Manajemen Petani</h3>
<hr>

<div class="row">
  <div class="col-md-12">
    
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table id="tblpetani" class="table table-responsive table-hover">
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
            <table id="tblpetani" class="table table-responsive table-hover">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Nama Petani</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Nomor Identitas</th>
                
                <th>Aksi</th>

              </tr>
              </thead>
              <tbody>
              <?php foreach ($farmer as $value) { ?>
                <?php if($value->status==='1') { ?>
                <tr>
                  <td><?= $value->id; ?></td>
                  <td><?= $value->nama_petani; ?></td>
                  <td><?= $value->alamat; ?></td>
                  <td><?= $value->no_telp; ?></td>
                  <td><?= $value->nmr_identitas; ?></td>
                  
                  <td>
                    <?php if (($value->status) === '0') { ?>
                      <a href="#" data-record-id="<?= strtolower($value->id_user); ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
                         data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Aktifkan
                      </a>
                    <?php } else { ?>
                      <a class="btn btn-default btn-sm btn-icon icon-left"
                         href="<?= $this->baseUrl; ?>/kospermindo/user/update?id=<?= strtolower($value['id_user']); ?>"><i
                          class="entypo-pencil"></i>
                        Edit
                      </a>
                      <a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/kospermindo/user/delete"
                         data-record-body="Apakah anda yakin ingin menghapus data ini?"
                         data-toggle="modal" data-target="#confirm-delete"
                         class="btn btn-danger btn-sm btn-icon icon-left">Hapus
                        <i class="entypo-cancel"></i>
                      </a>

                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              <?php } ?>
              </tbody>
            </table>
          <?php } ?>
       


    <!-- <a href="<?= $this->baseUrl; ?>/kospermindo/users/create"
                             class=" btn btn-black btn-sm btn-icon icon-left">
                      <i class="entypo-user-add"></i>
                      Add User
                    </a>
                    <br/>
            <table id="tblpetani" class="table table-responsive table-hover">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Pengguna</th>
                <th>Level</th>
                <th>Status</th>
                <th>Aksi</th>

              </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table> -->
    <!--  -->

  

  </div>
</div>

  