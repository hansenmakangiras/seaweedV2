<!-- Modal 1 (Basic)-->
<div class="modal fade" id="confirm-delete" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title title">Konfirmasi</h4>
      </div>

      <div class="modal-body body">
        Apakah Anda yakin ingin menghapus data ini?
      </div>

      <div class="modal-footer">
        <!--        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
        <button type="submit" class="btn btn-info btn-ok">Ya</button>
        <button type="reset" class="btn btn-default btn-cancel">Tidak</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title title">Ubah Data Gudang</h4>
      </div>

      <div id="tes"></div>
      <form class="form-horizontal">
        <div class="modal-body body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-12">
                  <h4><b>Informasi Dasar</b></h4>
                  <hr>
                </div>
                <input type="hidden" id="id-gudang" placeholder="Nama Gudang" name="id_gudang"
                       class="form-control input-lg">
                <div class="col-md-6">
                  <input id="nama-gudang" type="text" placeholder="Nama Gudang" name="nama_gudang"
                         class="form-control input-lg" required>
                  <br>
                </div>

                <div class="col-md-6">
                  <input id="pj_gudang" type="text" placeholder="Penanggung Jawab Gudang" name="pj_gudang"
                         class="form-control input-lg" required>
                  <br>
                </div>

                <div class="col-md-6">
                  <input type="number" id="tel" placeholder="Telpon / HP" name="tel" class="form-control input-lg"
                         required>
                  <br>
                </div>

                <div class="col-md-6">
                  <div class="input-group">
                    <input id="luas_gudang" type="number" placeholder="Luas Gudang"
                           name="luas_gudang" class="form-control input-lg" required>
                    <span class="input-group-addon" id="basic-addon1">m<sup>2</sup></span>
                  </div>
                  <br>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-12">
                  <h4><b>Lokasi Gudang</b></h4>
                  <hr>

                  <input id="alamat" type="text" placeholder="Alamat" name="alamat" class="form-control input-lg"
                         required>
                  <br>

                  <select name="provinsi" id="editprov" class="form-control input-lg" required>
                    <option value="">Pilih Provinsi</option>
                  </select>
                  <br>

                  <select name="kabupaten" id="editkab" class="form-control input-lg" required>
                    <option value="">Pilih Kabupaten</option>
                  </select>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <!--          <button type="submit" class="btn btn-info btn-ok">Ya</button>-->
          <a id="sunting" class="btn btn-info btn-lg btn-edit"><i class="entypo-pencil"></i>&nbsp;Sunting
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal 1 (Basic)-->
<div class="modal fade" id="konf-del-komoditi" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title title">Konfirmasi</h4>
      </div>

      <div class="modal-body body">
        Apakah Anda yakin ingin menghapus data ini?
        <br>
      </div>

      <div class="modal-footer">
        <div class="alert hidden"><strong></strong></div>
        <!--        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
        <a class="btn btn-info btn-ok" data-id="" id="konfirm-yes">Ya</a>
        <button type="reset" class="btn btn-default btn-cancel">Tidak</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 1 (Basic)-->
<div class="modal fade" id="confirm-simpan" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title title">Konfirmasi</h4>
      </div>

      <div class="modal-body body">
        Apakah Anda yakin ingin menyimpan data ini?
      </div>

      <div class="modal-footer">
        <!--        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
        <button type="submit" class="btn btn-info btn-ok">Ya</button>
        <button type="reset" class="btn btn-cancel">Tidak</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal 1 (Basic)-->
<div class="modal fade" id="modal-filter" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title title">Filter</h4>
      </div>

      <div class="modal-body body">
        <!-- Waktu -->
        <div class="form-group">
          <label for="">Rentang Waktu</label>
          <input type="text" class="form-control daterange input-lg"/>
        </div>
        <!-- Petani -->
        <div class="form-group">
          <label for="">Petani</label>
          <select name="" class="form-control input-lg">
            <option value="">-- Pilih Petani --</option>
          </select>
        </div>
        <!-- Rumput Laut -->
        <div class="form-group">
          <label for="">Rumput Laut</label>
          <select name="" class="form-control input-lg">
            <option value="">-- Pilih Rumput Laut --</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-ok">Ya</button>
        <button type="button" data-dismiss="modal" class="btn btn-default btn-cancel">Tidak</button>
      </div>
    </div>
  </div>
</div>