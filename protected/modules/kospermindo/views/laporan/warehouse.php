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
        <span class="badge badge-primary"><?= !empty($allFarmers) ? $allFarmers : "0";?></span>
        <a href="">Total Semua Petani</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-info"><?= !empty($summary[0]['total_panen']) ? $summary[0]['total_panen'] : "0";?></span>
        <a href="">Total Semua Hasil Panen</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-danger"><?= !empty($allFarmers) ? $allFarmers : "0";?></span>
        <a href="">Total Users</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-success"><?= !empty($allWarehouses) ? $allWarehouses : "0";?></span>
        <a href=""> Total Warehouse</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-warning"><?= !empty($allGroups) ? $allGroups : "0";?></span>
        <a href="">Total Groups</a>
      </li>
    </ul>
  </div>
  <div class="col-sm-9">
     <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          <h3>Warehouses</h3>
          <span>Statistics From Warehouses</span>
        </div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
      </div>

      <div class="panel-body">
        <table class="table table-hover table-responsive">
          <thead>
          <tr>
            <th>Warehouse Location</th>
            <th>Total Groups</th>
            <th class="text-center">Total Panen (Ton)</th>
          </tr>
          </thead>

          <tbody>
          <?php foreach($warehouse as $key => $value) { ?>
          <tr>
            <td><a href=""><?= !empty($value['lokasi_gudang']) ? $value['lokasi_gudang'] : "No Warehouse";?></a></td>
            <td><?= !empty($total_group[$key]) ? $total_group[$key] : "0";?></td>
            <td class="text-center"></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
        <?= $totalPanengudang;?>
      </div>
    </div>
    
  </div>
</div>

