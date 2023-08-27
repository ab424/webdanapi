<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> Data Baju Adat </h3>
                <br>
                <a href="<?php echo site_url('mobilrental/add'); ?>" class="btn btn-primary m-b-0-25 waves-effect waves-light"><i class="ti-write"></i>&nbsp;Tambah Data</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <h2>Media Gallery <small> gallery design </small></h2> -->
                        <?php echo form_open_multipart('mobilrental/search', array("class" => "form-horizontal btn"));  ?>
                        <div class="search-form btn" style="margin-left: -30px; margin-top: 10;">
                            <div class="btn">
                                <input type="search" name="search" value="<?= $search ?>" class="form-control b-a" placeholder="Search">
                            </div>
                            <button name="submit" class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                        <?php echo form_close(); ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <?php foreach ($mobil as $key) { ?>
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="<?php echo base_url(); ?>public/images/mobil/<?= $key["foto"] ?>" alt="image" />
                                            <div class="mask">
                                                <p><?= $key["nama_mobil"] ?></p>
                                                <div class="tools tools-bottom">
                                                    <a href="<?php echo base_url(); ?>mobilrental/detail/<?= $key['id_mobil'] ?>"><i class="fa fa-link"></i></a>
                                                    <a href="<?php echo base_url(); ?>mobilrental/edit/<?= $key['id_mobil'] ?>"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="myFunction('<?= $key['id_mobil'] ?>');"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <p><strong><?= $key["nama_mobil"] ?></strong></p>
                                            <p><?= "Asal Derah Baju Adat  : " . $key["plat_mobil"] ?></p>
                                            <!-- <p><?= "Harga Sewa " . getRupiah($key["harga"]) ?></p> -->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction(recertid) {
        swal({
                title: "",
                text: "Apakah Anda yakin ingin menghapus data ini? Semua data Transaksi terkait Mobil ini akan terhapus!! ",
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
                    window.location = "<?php echo site_url('mobilrental/remove/'); ?>" + recertid;
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