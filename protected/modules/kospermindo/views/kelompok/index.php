<?php

    Yii::app()->clientScript->registerScript('search', "

        var element = $('#main-menu li[data-nav=\"master\"]');

        element.addClass('active opened');

        element.find('ul').addClass('visible');

        element.find('ul li:nth-child(2)').addClass('active');

");

?>



<div class="headline">

    <ol class="breadcrumb bc-3">

        <li>

            <a href="<?= Kospermindo::getBaseUrl(); ?>"><i class="entypo-home"></i>Beranda</a>

        </li>

        <li class="active">

            <strong><?php echo 'Data Kelompok'; ?></strong>

        </li>

    </ol>

    <h2>Data Kelompok</h2><br/>

</div>



<div class="row">

    <div class="col-md-12">

        <div id="pesan" class="row">

            <div class="col-md-6">

                <?php if (Yii::app()->user->hasFlash('success')) { ?>

                    <div class="alert alert-success">

                        <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('success')); ?></strong>

                    </div>

                <?php } elseif (Yii::app()->user->hasFlash('error')) { ?>

                    <div class="alert alert-danger">

                        <strong><?php echo CHtml::encode(Yii::app()->user->getFlash('error')); ?></strong>

                    </div>

                <?php } else { ?>

                    <div></div>

                <?php } ?>

            </div>

        </div>



        <div class="row">

            <div class="col-md-12">

                <button id="btn-tmbh" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-insert"><i class="entypo-plus"></i>&nbsp;Tambah</button>

                <hr>

            </div>

        </div>



        <div class="row">

            <div class="col-md-12">

                <table id="tblkelompok" class="table table-responsive table-hover table-bordered" cellspacing="0" width="100%">

                    <thead>

                    <tr>

                        <th class="text-center" width="5%">No</th>

                        <th>Nama Kelompok</th>

                        <th>Nama Gudang</th>

                        <th>Ketua Kelompok (<i>Dipilih saat mengisi form petani</i>)</th>

                        <th width="200px">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (!empty($data->getData())) { $i=1;?>

                        <?php foreach ($data->getData() as $value) { ?>

                            <tr>

                                <?php if ($value->status == 1) { ?>

                                    <td class="text-center"><?= $i; ?></td>

                                    <td><?= $value->nama_kelompok; ?></td>

                                    <td><?= !empty($value->id_gudang) ? Kelompok::model()->getNamaGudang($value->id_gudang) : '-';?></td>

                                    <td><?= !empty($value->ketua_kelompok) ? Kelompok::model()->getNamaPetani($value->ketua_kelompok) : "Belum ada ketua kelompok";?></td>

                                    <td>

                                        <a id="sunting" class="btn btn-default btn-sm btn-icon icon-left" href="#" class='modal-edit' data-id="<?= $value['id_kelompok'];?>" data-namakelompok="<?= $value['nama_kelompok'];?>" data-gudang = "<?= !empty($value->id_gudang) ? Kelompok::model()->getNamaGudang($value->id_gudang) : '-';?>" data-ketuakelompok = "<?= !empty($value->ketua_kelompok) ? Kelompok::model()->getNamaPetani($value->ketua_kelompok) : "Belum ada ketua kelompok";?>">
                                        
                                            <i class="entypo-pencil"></i>Sunting</a>

                                        <a href="#" data-record-id="<?= $value['id_kelompok']; ?>" data-record-title="Konfirmasi"

                                             data-href="<?php echo $this->baseUrl; ?>/kospermindo/kelompok/hapus"

                                             data-record-body="Apakah anda yakin ingin menghapus data ini?" data-toggle="modal"

                                             data-target="#confirm-delete" class="btn btn-danger btn-sm btn-icon icon-left">Hapus <i

                                                class="entypo-trash"></i>

                                        </a>
                                        
                                    </td>

                                <?php $i++;} ?>

                            </tr>

                        <?php } ?>

                    <?php } else { ?>

                        <td colspan="5" class="text-center">Tidak ada hasil ditemukan</td>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <?php

            $pages = $data->getPagination();

            $this->widget('CLinkPager', array(

                'pages'             => $pages,

                'maxButtonCount' => 30,

                'pageSize'          => 10,

                'itemCount' => (int) $data->totalItemCount,

                'htmlOptions'       => array('class' => 'pagination pagination-custom'),

                'hiddenPageCssClass' => '',

                'selectedPageCssClass' => 'active',

                'header' => '',

                'nextPageLabel'     => 'Berikutnya',

                'prevPageLabel'     => 'Sebelumnya',

                'lastPageLabel'     => 'Akhir',

                'firstPageLabel'     => 'Awal',

            ));

        ?>

    </div>

</div>





<!-- Modal -->

<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Tambah Kelompok</h4>

            </div>

            <div class="modal-body">

                <div class="row">



                    <form action="/kospermindo/kelompok/tambah" method="POST" class="form-horizontal">



                        <div class="col-md-12">

                            <input id="nama_kelompok" type="text" placeholder="Nama Kelompok" name="nama_kelompok" class="form-control input-lg" required>

                            <br>

                            <select name="nama_gudang" id="nama_gudang" class="form-control input-lg" required>

                                <option value="0">Pilih Nama Gudang</option>

                            </select>

                            <br/>

                            <select name="ketua_kelompok" id="ketua_kelompok" class="form-control input-lg" required>

                                <option value="0">Pilih Ketua Kelompok</option>

                            </select>

                        </div>

                        
                        <div class="col-md-12">

                            <hr>

                            <br/>

                            <div class="alert hidden"><strong></strong></div>

                            <br/>

                            <div class="pull-right">

                                <button id="submit" type="submit" class="btn btn-info btn-lg"><i class="entypo-plus"></i>&nbsp;Tambah</button>

                                <a id="edit" class="btn btn-info btn-lg" data-id=""><i class="entypo-pencil"></i>Ubah</a>

                            </div>

                        </div>



                    </form>



                </div>

            </div>

        </div>

    </div>

</div>



<script>

    var baseurl;

    var pesan = '<?php $pesan ?>';

    var kelompok = '<?php $data->getData(); ?>';

</script>

<?php

    Yii::app()->clientScript->registerScript('showNotif', '

         setTimeout(function () {

                $("#pesan").addClass("hidden");

         }, 5000); 



        $("#add").click(function (e) {

            toastr.error("Anda Harus Menambahkan Data Gudang Terlebih Dahulu!!!", pesan);

            e.preventDefault();

        });

     
        $("#modal-insert").prependTo("#modal-view");


        $.ajax({
            type: "POST",
            url: "/kospermindo/kelompok/getNamaGudang",
            data:{
            },
            success: function(data){
                msg = $.parseJSON(data);
                $.each(msg, function(i, v){
                    $("#nama_gudang").append("<option value=\""+ v +"\">"+ v +"</option>");
                });
            }
        });

        $("#nama_gudang").on("change", function(){
            $.ajax({
                type: "POST",
                url: "/kospermindo/kelompok/getPetani",
                data:{
                    "nama_gudang" : $("#nama_gudang").val(),
                },
                success: function(data){
                    msg = $.parseJSON(data);
                    console.log(msg);
                    $("#ketua_kelompok").empty();
                    if(msg.length === 0){
                        $("#ketua_kelompok").append("<option value=\'0\'>Belum Ada Petani di Gudang ini</option>");
                    }else{
                        $.each(msg, function(i, v){
                            $("#ketua_kelompok").append("<option value=\'"+ v +"\'>"+ v +"</option>");
                        });
                    }
                }
            });
        });

        $("#btn-tmbh").on("click", function(){
            $("#myModalLabel").html("Tambah Gudang");
            $("#nama_kelompok").val("");
            $("#nama_gudang").val("0");
            $("#ketua_kelompok").val("0");
            $("#edit").addClass("hidden");
            $("#submit").removeClass("hidden");
        });

        $(document).on("click","#sunting", function(){
            $("#nama_kelompok").val($(this).attr("data-namakelompok"));
            $("#nama_gudang").val($(this).attr("data-gudang"));
            $("#ketua_kelompok").append("<option value=\""+ $(this).attr("data-ketuakelompok") +"\" selected>"+ $(this).attr("data-ketuakelompok") +"</option>");
            $("#myModalLabel").html("Ubah Gudang");
            $("#edit").attr("data-id", $(this).attr("data-id"));
            $("#edit").removeClass("hidden");
            $("#submit").addClass("hidden");
            $("#modal-insert").modal("show");
        });

        $("#edit").on("click", function(){
        $.ajax({
            type: "POST",
            url: "/kospermindo/kelompok/ubah",
            data:{
                "nama_kelompok"   : $("#nama_kelompok").val(),
                "nama_gudang"     : $("#nama_gudang").val(),
                "ketua_kelompok"  : $("#ketua_kelompok").val(),
                "id"            : $(this).attr("data-id")
            },
            success: function(data){
                    msg = $.parseJSON(data);

                    if(msg.message === "success"){
                            $(".alert strong").html("Kelompok Berhasil diubah !");
                            $(".alert").removeClass("hidden");
                            $(".alert").addClass("alert-success");
                        setTimeout(function() {
                            $(".alert strong").html("");
                            $(".alert").addClass("hidden");
                            $(".alert").removeClass("alert-success");
                            window.location.reload(true);
                        }, 2500);
                    }else{
                        $(".alert strong").html("Kelompok Gagal diubah !");
                        $(".alert").removeClass("hidden");
                        $(".alert").addClass("alert-danger");
                        setTimeout(function() {
                            $(".alert strong").html("");
                            $(".alert").addClass("hidden");
                            $(".alert").removeClass("alert-danger");
                        }, 2500);
                    }
                }
            });
        });

    ');

?>

