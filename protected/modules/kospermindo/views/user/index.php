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
<!-- <h2>Seaweed Management</h2><br /> -->
<div class="row">

</div>

<div class="col-md-12">

  <div class="panel minimal minimal-gray">

    <div class="panel-heading">
      <!-- <div class="panel-title"><h4>Minimal Panel</h4></div> -->
      <div class="panel-options">

        <ul class="nav nav-tabs">
          <li class="active"><a href="#profile-1" data-toggle="tab">Seaweed Management</a></li>
          <li class=""><a href="#profile-2" data-toggle="tab">Groups Management</a></li>
          <li class=""><a href="#profile-3" data-toggle="tab">Warehouses Management</a></li>
          <li class=""><a href="#profile-4" data-toggle="tab">Farmers Management</a></li>
        </ul>
      </div>
    </div>

    <div class="panel-body">

      <div class="tab-content">
        <div class="tab-pane active" id="profile-1">
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
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
                  <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
                  <td>
                    <a class="btn btn-sm btn-default"
                       href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value->id); ?>">
                      Edit
                    </a>
                    <?php if ($value->status === '0') { ?>
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
          <?php } else { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
              <thead>
              <tr>
                <th rowspan="2" style="
    vertical-align: middle">
                  <center>Items</center>
                </th>
                <th rowspan="2" style="
    vertical-align: middle">
                  <center>Sango-Sango Laut</center>
                </th>
                <th rowspan="2" style="
    vertical-align: middle">
                  <center>Spinosom</center>
                </th>
                <th rowspan="2" style="
    vertical-align: middle">
                  <center>Euchema Cotoni</center>
                </th>
                <th colspan="5">
                  <center>Gracillia</center>
                </th>
              </tr>
              <tr>
                <th>
                  <center>KW 3</center>
                </th>
                <th>
                  <center>KW 4</center>
                </th>
                <th>
                  <center>BS</center>
                </th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>
                  <center>Amount of Seaweed</center>
                </td>
                <?php { ?>
                  <td>
                    <center><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen'] : "-"; ?> Ton</center>
                  </td>
                  <td>
                    <center><?= !empty($summary[1]['total_panen']) ? $summary[1]['total_panen'] : "-"; ?> Ton</center>
                  </td>
                  <td>
                    <center><?= !empty($summary[2]['total_panen']) ? $summary[2]['total_panen'] : "-"; ?> Ton</center>
                  </td>
                  <td>
                    <center><?= !empty($summary[3]['total_panen']) ? $summary[3]['total_panen'] : "-"; ?> Ton</center>
                  </td>
                  <td>
                    <center><?= !empty($summary[4]['total_panen']) ? $summary[4]['total_panen'] : "-"; ?> Ton</center>
                  </td>
                  <td>
                    <center><?= !empty($summary[5]['total_panen']) ? $summary[5]['total_panen'] : "-"; ?> Ton</center>
                  </td>
                <?php } ?>

              </tr>
              <tr>
                <td>
                  <center>Kadar Air</center>
                </td>
                <td>
                  <center><?= !empty($summary[0]['kadar_air']) ? $summary[0]['kadar_air'] : "-"; ?> %</center>
                </td>
                <td>
                  <center><?= !empty($summary[1]['kadar_air']) ? $summary[1]['kadar_air'] : "-"; ?> %</center>
                </td>
                <td>
                  <center><?= !empty($summary[2]['kadar_air']) ? $summary[2]['kadar_air'] : "-"; ?> %</center>
                </td>
                <td>
                  <center><?= !empty($summary[3]['kadar_air']) ? $summary[3]['kadar_air'] : "-"; ?> %</center>
                </td>
                <td>
                  <center><?= !empty($summary[4]['kadar_air']) ? $summary[4]['kadar_air'] : "-"; ?> %</center>
                </td>
                <td>
                  <center><?= !empty($summary[5]['kadar_air']) ? $summary[5]['kadar_air'] : "-"; ?> %</center>
                </td>

              </tr>
              <tr>
                <td>
                  <center>Jumlah Bentangan</center>
                </td>
                <td>
                  <center><?= !empty($summary[0]['jumlah_bentangan']) ? $summary[0]['jumlah_bentangan'] : "-"; ?>m
                  </center>
                </td>
                <td>
                  <center><?= !empty($summary[1]['jumlah_bentangan']) ? $summary[1]['jumlah_bentangan'] : "-"; ?>m
                  </center>
                </td>
                <td>
                  <center><?= !empty($summary[2]['jumlah_bentangan']) ? $summary[2]['jumlah_bentangan'] : "-"; ?>m
                  </center>
                </td>
                <td>
                  <center><?= !empty($summary[3]['jumlah_bentangan']) ? $summary[3]['jumlah_bentangan'] : "-"; ?>m
                  </center>
                </td>
                <td>
                  <center><?= !empty($summary[4]['jumlah_bentangan']) ? $summary[4]['jumlah_bentangan'] : "-"; ?>m
                  </center>
                </td>
                <td>
                  <center><?= !empty($summary[5]['jumlah_bentangan']) ? $summary[5]['jumlah_bentangan'] : "-"; ?>m
                  </center>
                </td>

              </tr>
              <tr>
                <td>
                  <center>Action</center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=1"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=2"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=3"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=4"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=5"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=6"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
              </tr>
              </tbody>
            </table>

          <?php } ?>


        </div>

        <div class="tab-pane" id="profile-2">
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
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
                       href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value->id); ?>">
                      Edit
                    </a>
                    <?php if ($value->status === '0') { ?>
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
          <?php } else { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
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
                    <?php if (($value->status) === '0') { ?>
                      <a href="#" data-record-id="<?= strtolower($value->id_user); ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/user/delete"
                         data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                      </a>
                    <?php } else { ?>
                      <a class="btn btn-default btn-sm btn-icon icon-left"
                         href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value['id_user']); ?>"><i
                          class="entypo-pencil"></i>
                        Edit
                      </a>
                      <a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/user/delete"
                         data-record-body="Apakah anda yakin ingin menghapus data ini?"
                         data-toggle="modal" data-target="#confirm-delete"
                         class="btn btn-danger btn-sm btn-icon icon-left">Disable
                        <i class="entypo-cancel"></i>
                      </a>

                      <?php echo CHtml::link('<i class="entypo-info"></i>Details',
                        $this->createUrl('/user/showfarmers?gid=' . strtolower($value->nama_kelompok) . '&id=' . strtolower($value->id_user)),
                        array('class' => 'btn btn-info btn-sm btn-icon icon-left')) ?>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          <?php } ?>


        </div>
        <div class="tab-pane" id="profile-3">
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
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
                       href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value->id); ?>">
                      Edit
                    </a>
                    <?php if ($value->status === '0') { ?>
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
          <?php } else { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Warehouse Location</th>
                <th>Warehose Coordinator</th>
                <th>Status</th>
                <th>Action</th>

              </tr>
              </thead>
              <tbody>
              <?php foreach ($warehouseData as $value) { ?>
                <tr>
                  <td><?= $value->id; ?></td>
                  <td><?= $value->lokasi_gudang; ?></td>
                  <td><?= $value->nama_koordinator; ?></td>
                  <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
                  <td>
                    <?php if (($value->status) === '0') { ?>
                      <a href="#" data-record-id="<?= strtolower($value->id_user); ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/user/delete"
                         data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                      </a>
                    <?php } else { ?>
                      <a class="btn btn-default btn-sm btn-icon icon-left"
                         href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value['id_user']); ?>"><i
                          class="entypo-pencil"></i>
                        Edit
                      </a>
                      <a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/user/delete"
                         data-record-body="Apakah anda yakin ingin menghapus data ini?"
                         data-toggle="modal" data-target="#confirm-delete"
                         class="btn btn-danger btn-sm btn-icon icon-left">Disable
                        <i class="entypo-cancel"></i>
                      </a>


                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          <?php } ?>


        </div>
        <div class="tab-pane" id="profile-4">
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
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
                       href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value->id); ?>">
                      Edit
                    </a>
                    <?php if ($value->status === '0') { ?>
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
          <?php } else { ?>
            <table id="tblpetani" class="table table-bordered table-responsive table-hover" cellspacing="0"
                   width="100%">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Farmer Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>status</th>
                <th>Action</th>

              </tr>
              </thead>
              <tbody>
              <?php foreach ($farmer as $value) { ?>
                <tr>
                  <td><?= $value->id; ?></td>
                  <td><?= $value->nama_petani; ?></td>
                  <td><?= $value->alamat; ?></td>
                  <td><?= $value->no_telp; ?></td>
                  <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
                  <td>
                    <?php if (($value->status) === '0') { ?>
                      <a href="#" data-record-id="<?= strtolower($value->id_user); ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/user/delete"
                         data-record-body="Apakah anda yakin ingin mengaktifkan data ini?"
                         data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-default">Enable
                      </a>
                    <?php } else { ?>
                      <a class="btn btn-default btn-sm btn-icon icon-left"
                         href="<?= $this->baseUrl; ?>/user/update?id=<?= strtolower($value['id_user']); ?>"><i
                          class="entypo-pencil"></i>
                        Edit
                      </a>
                      <a href="#" data-record-id="<?= $value->id_user; ?>" data-record-title="Confirmation"
                         data-href="<?php echo $this->baseUrl; ?>/user/delete"
                         data-record-body="Apakah anda yakin ingin menghapus data ini?"
                         data-toggle="modal" data-target="#confirm-delete"
                         class="btn btn-danger btn-sm btn-icon icon-left">Disable
                        <i class="entypo-cancel"></i>
                      </a>

                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          <?php } ?>


        </div>
      </div>

    </div>

  </div>

</div>