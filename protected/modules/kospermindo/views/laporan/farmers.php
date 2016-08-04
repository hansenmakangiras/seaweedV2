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
          <h3>Groups</h3>
          <span>Statistics From Groups</span>
        </div>
      </div>

      <div class="panel-body">
        <table class="table table-hover table-responsive">
          <thead>
          <tr>
            <th>Group Name</th>
            <th>Location</th>
            
            <th>Total Farmers</th>
            <th class="text-center">Total Panen (Ton)</th>
          </tr>
          </thead>

          <tbody>
          <?php foreach ($groups as $key=> $value) { ?>
            <tr>
              <td><a href=""><?= $value->nama_kelompok?></a></td>
              <td><?= $value->lokasi;?></td>
              <td><?=!empty($allkelompok[$key]) ? $allkelompok[$key] : "0";?> Farmer</td>
              <td class="text-center"><?=!empty($totalpanen[$key]) ? $totalpanen[$key] : "0";?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

