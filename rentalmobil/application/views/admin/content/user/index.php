<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data User</h3>
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
                                                <!-- <th>Jenis Kelamin</th> -->
                                                <th>Nomor Telephone</th>
                                                <th>Alamat</th>
                                                <th>Pekerjaan</th>
                                                <th>Aski</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($user as $key) { ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $key["nama"] ?></td>
                                                    <!-- <td><?= getKelamin($key["jk"]) ?></td> -->
                                                    <td><?= $key["no_hp"] ?></td>
                                                    <td><?= $key["alamat"] ?></td>
                                                    <td><?= $key["pekerjaan"] ?></td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <a href="<?php echo base_url(); ?>user/detail/<?= $key['id'] ?>" class="btn btn-sm btn-info">Detail User</a>
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
                text: "Apakah Anda yakin ingin menghapus data ini?",
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