<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Staff</h3>
                <br>
                <a href="<?php echo site_url('rental/add'); ?>" class="btn btn-primary m-b-0-25 waves-effect waves-light"><i class="ti-write"></i>&nbsp;Tambah Data</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>No Telphone</th>
                                                <th>No Rekening</th>
                                                <th>alamat</th>
                                                <th>Jumlah Mobil</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($rental as $key) { ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $key["nama"] ?></td>
                                                    <td><?= $key["no_hp"] ?></td>
                                                    <td><?= $key["norek"] ?></td>
                                                    <td><?= $key["alamat"] ?></td>
                                                    <td><?= $this->Mobil_model->get_data_count($key["id"]) . " Mobil"; ?></td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <a href="<?php echo base_url(); ?>rental/edit/<?= $key['id'] ?>" class="btn btn-sm btn-info">Ubah</a>
                                                            <a onclick="myFunction('<?= $key['id'] ?>');" class="btn btn-danger btn-rounded btn-sm">
                                                                <font color="white">Hapus</font>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>
    function myFunction(recertid) {
        swal({
                title: "",
                text: "Apakah Anda yakin ingin menghapus data ini? Semua data Mobil dan data Transaksi terkait Rental ini akan terhapus!!",
                type: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus!",
                cancelButtonText: "Batal!",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location = "<?php echo site_url('rental/remove/'); ?>" + recertid;
                } else {
                    //return false;
                    swal({
                        title: "",
                        text: "Dibatalkan!",
                        type: "error",
                        timer: 1000
                    });
                }
            });
    }
</script>