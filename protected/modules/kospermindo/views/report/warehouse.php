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
        <a href="">Total Semua Petani</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-info"><?= $summary[0]['total_panen'];?></span>
        <a href="">Total Semua Hasil Panen</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-danger"><?= $allFarmers;?></span>
        <a href="">Total Users</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-success"><?= $allWarehouses;?></span>
        <a href=""> Total Warehouse</a>
      </li>
      <li class="list-group-item">
        <span class="badge badge-warning"><?= $allGroups;?></span>
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
          <tr>
            <td><a href="">Bone</a></td>
            <td>20</td>
            <td class="text-center">4.056</td>
          </tr>

          </tbody>
        </table>
      </div>
    </div>
    
  </div>
</div>

