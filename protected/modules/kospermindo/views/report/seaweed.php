<h2>Report Management</h2><hr />
<div class="row">
  <div class="col-md-12">
    <?php $this->renderPartial('_menu'); ?>
  </div>
</div><br />
<div class="row">
  <div class="col-sm-3">
    <ul class="list-group">
      <li class="list-group-item">
        <span class="badge badge-primary"><?= $allFarmers;?></span>
        Total Semua Petani
      </li>
      <li class="list-group-item">
        <span class="badge badge-info"><?= $panen[0]['total_panen'];?></span>
        Total Semua Hasil Panen
      </li>
      <li class="list-group-item">
        <span class="badge badge-danger"><?= $allFarmers;?></span>
        Total Users
      </li>
      <li class="list-group-item">
        <span class="badge badge-success"><?= $allWarehouses;?></span>
        Total Warehouse
      </li>
      <li class="list-group-item">
        <span class="badge badge-warning"><?= $allGroups;?></span>
        Total Groups
      </li>
    </ul>
  </div>
  <div class="col-sm-9">
  <!-- <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          <h3>Groups</h3>
          <span>Statistics From Groups</span>
        </div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <div class="panel-body">
        <table class="table table-hover table-responsive">
          <thead>
          <tr>
            <th>Seaweed Type</th>
            <th>Amount of Seaweed</th>
            <th>Kadar Air</th>
            <th>Jumlah Bentangan</th>
            <th class="text-center">Total Panen (Ton)</th>
          </tr>
          </thead>

          <tbody>
          <tr>
            <td>Rahmat</td>
            <td>Kelompok 1</td>
            <td>Bone</td>
            <td>29</td>
            <td class="text-center">4.056</td>
          </tr>

          </tbody>
        </table>
      </div>
    </div> -->
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          <h3>Seaweed</h3>
          <span>Statistics from seaweed</span>
        </div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <div class="panel-body">
        <?php if(Users::model()->isSuperUser()==true) { ?>
        <table id="tblpetani" class="table table-hover table-responsive" cellspacing="0" width="100%">
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
                <td><?= ($value->status === '1') ? 'Active' : 'Inactive'; ?></td>
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
          <table id="tblpetani" class="table table-hover table-responsive" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th rowspan="2" style="
    vertical-align: middle"><center>Items</center></th>
            <th rowspan="2" style="
    vertical-align: middle"><center>Sango-Sango Laut</center></th>
            <th rowspan="2" style="
    vertical-align: middle"><center>Spinosom</center></th>
            <th rowspan="2" style="
    vertical-align: middle"><center>Euchema Cotoni</center></th>
            <th colspan="5"><center>Gracillia</center></th>
          </tr>
          <tr>
            <th><center>KW 3</center></th>
            <th><center>KW 4</center></th>
            <th><center>BS</center></th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td><center>Amount of Seaweed</center></td>
              <?php  { ?>
                <td><center><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen'] : "-" ;?> Ton</center></td>
                <td><center><?= !empty($summary[1]['total_panen']) ? $summary[1]['total_panen'] : "-" ;?> Ton</center></td>
                <td><center><?= !empty($summary[2]['total_panen']) ? $summary[2]['total_panen'] : "-" ;?> Ton</center></td>
                <td><center><?= !empty($summary[3]['total_panen']) ? $summary[3]['total_panen'] : "-" ;?> Ton</center></td>
                <td><center><?= !empty($summary[4]['total_panen']) ? $summary[4]['total_panen'] : "-" ;?> Ton</center></td>
                <td><center><?= !empty($summary[5]['total_panen']) ? $summary[5]['total_panen'] : "-" ;?> Ton</center></td>  
              <?php } ?>

            </tr>
            <tr>
              <td><center>Kadar Air</center></td>
              <td><center><?= !empty($summary[0]['kadar_air']) ? $summary[0]['kadar_air'] : "-" ;?> %</center></td>
              <td><center><?= !empty($summary[1]['kadar_air']) ? $summary[1]['kadar_air'] : "-" ;?> %</center></td>
              <td><center><?= !empty($summary[2]['kadar_air']) ? $summary[2]['kadar_air'] : "-" ;?> %</center></td>
              <td><center><?= !empty($summary[3]['kadar_air']) ? $summary[3]['kadar_air'] : "-" ;?> %</center></td>
              <td><center><?= !empty($summary[4]['kadar_air']) ? $summary[4]['kadar_air'] : "-" ;?> %</center></td>
              <td><center><?= !empty($summary[5]['kadar_air']) ? $summary[5]['kadar_air'] : "-" ;?> %</center></td>  

            </tr>
            <tr>
              <td><center>Jumlah Bentangan</center></td>
              <td><center><?= !empty($summary[0]['jumlah_bentangan']) ? $summary[0]['jumlah_bentangan'] : "-" ;?> m</center></td>
              <td><center><?= !empty($summary[1]['jumlah_bentangan']) ? $summary[1]['jumlah_bentangan'] : "-" ;?> m</center></td>
              <td><center><?= !empty($summary[2]['jumlah_bentangan']) ? $summary[2]['jumlah_bentangan'] : "-" ;?> m</center></td>
              <td><center><?= !empty($summary[3]['jumlah_bentangan']) ? $summary[3]['jumlah_bentangan'] : "-" ;?> m</center></td>
              <td><center><?= !empty($summary[4]['jumlah_bentangan']) ? $summary[4]['jumlah_bentangan'] : "-" ;?> m</center></td>
              <td><center><?= !empty($summary[5]['jumlah_bentangan']) ? $summary[5]['jumlah_bentangan'] : "-" ;?> m</center></td>  

            </tr>
            <tr>
              <td><center>Action</center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=1" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=2" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=3" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=4" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=5" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center></td>
              <td><center><a href="<?= $this->baseUrl; ?>/user/detailseaweed?id=6" class="btn btn-info btn-sm btn-icon icon-left">
                      <i class="entypo-info"></i>
                      Details
                    </a></center></td>
            </tr>
          </tbody>
        </table>
        
        <?php }?>
      </div>
    </div>
  </div>
</div>

