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
<h3>Seaweed Management</h3>
<hr>

<div class="row">
  <div class="col-md-12">
    <p class="text-info">Disini anda dapat melihat detail hasil panen, menambahkan kelompok, gudang dan lain-lain</p>
    <hr>
    <div class="tabs-vertical-env">
      <ul class="nav tabs-vertical"><!-- available classes "right-aligned" -->
        <li class="active"><a href="#profile-1" data-toggle="tab">Manajemen Rumput Laut</a></li>
        <li class=""><a href="#profile-2" data-toggle="tab">Manajemen Gudang</a></li>
        <li class=""><a href="#profile-3" data-toggle="tab">Manajemen Kelompok</a></li>
        <li class=""><a href="#profile-4" data-toggle="tab">Menajemen Petani</a></li>
      </ul>

        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-responsive table-hover">
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
                <th colspan="4">
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
                  <center>Total Panen</center>
                </td>
                <?php { ?>
                  <td>
                    <center><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen']." Ton" : "-"; ?> </center>
                  </td>
                  <td>
                    <center><?= !empty($summary[1]['total_panen']) ? $summary[1]['total_panen']." Ton" : "-"; ?> </center>
                  </td>
                  <td>
                    <center><?= !empty($summary[2]['total_panen']) ? $summary[2]['total_panen']." Ton" : "-"; ?> </center>
                  </td>
                  <td>
                    <center><?= !empty($summary[3]['total_panen']) ? $summary[3]['total_panen']." Ton" : "-"; ?> </center>
                  </td>
                  <td>
                    <center><?= !empty($summary[4]['total_panen']) ? $summary[4]['total_panen']." Ton" : "-"; ?> </center>
                  </td>
                  <td>
                    <center><?= !empty($summary[5]['total_panen']) ? $summary[5]['total_panen']." Ton" : "-"; ?> </center>
                  </td>
                <?php } ?>

          </tr>
          <tr>
            <td>
              <center>Kadar Air</center>
            </td>
            <td>
              <center><?= !empty($summary[0]['kadar_air']) ? $summary[0]['kadar_air']." %" : "-"; ?> </center>
            </td>
            <td>
              <center><?= !empty($summary[1]['kadar_air']) ? $summary[1]['kadar_air']." %" : "-"; ?> </center>
            </td>
            <td>
              <center><?= !empty($summary[2]['kadar_air']) ? $summary[2]['kadar_air']." %" : "-"; ?> </center>
            </td>
            <td>
              <center><?= !empty($summary[3]['kadar_air']) ? $summary[3]['kadar_air']." %" : "-"; ?> </center>
            </td>
            <td>
              <center><?= !empty($summary[4]['kadar_air']) ? $summary[4]['kadar_air']." %" : "-"; ?> </center>
            </td>
            <td>
              <center><?= !empty($summary[5]['kadar_air']) ? $summary[5]['kadar_air']." %" : "-"; ?> </center>
            </td>

          </tr>
          <tr>
            <td>
              <center>Jumlah Bentangan</center>
            </td>
            <td>
              <center><?= !empty($summary[0]['jumlah_bentangan']) ? $summary[0]['jumlah_bentangan']." m" : "-"; ?>
              </center>
            </td>
            <td>
              <center><?= !empty($summary[1]['jumlah_bentangan']) ? $summary[1]['jumlah_bentangan']." m" : "-"; ?>
              </center>
            </td>
            <td>
              <center><?= !empty($summary[2]['jumlah_bentangan']) ? $summary[2]['jumlah_bentangan']." m" : "-"; ?>
              </center>
            </td>
            <td>
              <center><?= !empty($summary[3]['jumlah_bentangan']) ? $summary[3]['jumlah_bentangan']." m" : "-"; ?>
              </center>
            </td>
            <td>
              <center><?= !empty($summary[4]['jumlah_bentangan']) ? $summary[4]['jumlah_bentangan']." m" : "-"; ?>
              </center>
            </td>
            <td>
              <center><?= !empty($summary[5]['jumlah_bentangan']) ? $summary[5]['jumlah_bentangan']." m" : "-"; ?>
              </center>
            </td>

              </tr>
              <tr>
                <td>
                  <center>Aksi</center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/kospermindo/user/detailseaweed?id=1"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/kospermindo/user/detailseaweed?id=2"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/kospermindo/user/detailseaweed?id=3"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/kospermindo/user/detailseaweed?id=4"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/kospermindo/user/detailseaweed?id=5"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center>
                </td>
                <td>
                  <center><a href="<?= $this->baseUrl; ?>/kospermindo/user/detailseaweed?id=6"
                             class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Detil
                    </a></center>
                </td>
              </tr>
              </tbody>
            </table>
        </div>
        <div class="tab-pane" id="profile-3">
          <?php if (Users::model()->isSuperUser() == true) { ?>
            <table class="table table-responsive table-hover">
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
           <a href="<?php echo $this->baseUrl; ?>/kospermindo/groups/create" class="btn btn-default" id="<?php if($pesan_group=='gagal') { echo "add"; } ?>"><i class="entypo-user-add"></i>Tambah Kelompok</a>
            <table class="table table-responsive table-hover">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Nama Kelompok</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Aksi</th>

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

                      <?php echo CHtml::link('<i class="entypo-info"></i>Detil',
                        $this->createUrl('/kospermindo/user/showfarmers?gid=' . strtolower($value->nama_kelompok) . '&id=' . strtolower($value->id_user)),
                        array('class' => 'btn btn-info btn-sm btn-icon icon-left')) ?>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          <?php } ?>
        </div>
        <div class="tab-pane" id="profile-2">
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
            <a href="<?= $this->baseUrl; ?>/kospermindo/warehouse/create"
                             class=" btn btn-default">
                      <i class="entypo-user-add"></i>
                      Tambah Gudang
                    </a>
                    <br/>
            <table id="tblpetani" class="table table-responsive table-hover">
              <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Lokasi Gudang</th>
                <th>Penanggung Jawab Gudang</th>
                <th>Status</th>
                <th>Aksi</th>


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
              </tbody>
            </table>
          <?php } ?>
        </div>
        <div class="tab-pane" id="profile-4">
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
                <th>Status</th>
                <th>Aksi</th>

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
                    <?php echo CHtml::link('<i class="entypo-info"></i>Detil', $this->createUrl('/kospermindo/petani/details?gid='.strtolower($value['nama_petani']).'&id='.strtolower($value['id_user'])) , array('class' =>'btn btn-info btn-sm btn-icon icon-left'))?>
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
<script>
  var pesan_petani = '<?php $pesan_petani ?>';
</script>
<?php
  Yii::app()->clientScript->registerScript('showNotif','
    $("#addfarmer").click(function (e) {
    toastr.error("Please fill the form group first !!!", pesan_petani);
    e.preventDefault();
  });
  ');
?>
<script>
  var pesan_group = '<?php $pesan_group ?>';
</script>
<?php
  Yii::app()->clientScript->registerScript('showNotifikasi','
    $("#add").click(function (e) {
    toastr.error("Please Add Warehose Name First!!!", pesan_group);
    e.preventDefault();
  });
  ');
?>
