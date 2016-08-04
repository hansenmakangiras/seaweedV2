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
  <div class="col-sm-3">

   <div class="tile-title tile-cyan">
      
      <div class="icon">
        <i class="glyphicon glyphicon-leaf"></i>
      </div>
      
      <div class="title">
        <h3>Warehouse Report</h3>
        <p>Details for warehouse</p>
      </div>
    </div>
    <div class="tile-title tile-cyan">
      
      <div class="icon">
        <i class="glyphicon glyphicon-leaf"></i>
      </div>
      
      <div class="title">
        <h3>Group Report</h3>
        <p>Details for Groups</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3">

   <div class="tile-title tile-cyan">
      
      <div class="icon">
        <i class="glyphicon glyphicon-leaf"></i>
      </div>
      
      <div class="title">
        <h3>Farmers Report</h3>
        <p>Details for Farmers</p>
      </div>
    </div>
    <div class="tile-title tile-cyan">
      
      <div class="icon">
        <i class="glyphicon glyphicon-leaf"></i>
      </div>
      
      <div class="title">
        <h3>Seaweed Report</h3>
        <p>Details for Seaweed</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3">

   <div class="tile-title tile-cyan">
      
      <div class="icon">
        <i class="glyphicon glyphicon-leaf"></i>
      </div>
      
      <div class="title">
        <h3>Big Center Tile</h3>
        <p>so far in our blog, and our website.</p>
      </div>
    </div>
    
  </div>
</div>

