<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Transaksi Masuk</h3>
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
                                                <th>Nama Peminjam</th>
                                                <th>Nama Baju Adat</th>
                                                <th>Asal Derah Baju Adat</th>
                                                <th>Jumlah Hari</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Total Harga</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($transaksi as $key) {
                                                if ($key['id_rental'] != $_SESSION["id"]) {
                                                    break;
                                                }
                                                $t = date_create($key['tgl_pinjam']);
                                                $n = date_create($key['tgl_kembali']);
                                                $terlambat = date_diff($t, $n);
                                                $mobil = $this->User_model->get_data_id($key['id_user'])["nama"];
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $this->User_model->get_data_id($key['id_user'])["nama"]; ?></td>
                                                    <td><?= $this->Mobil_model->get_data_id($key['id_mobil'])["nama_mobil"] ?></td>
                                                    <td><?= $this->Mobil_model->get_data_id($key['id_mobil'])["plat_mobil"] ?></td>
                                                    <!-- <td><?= $key['tgl_pinjam'] ?></td>
                                                    <td><?= $key['tgl_kembali'] ?></td> -->
                                                    <td><?= $terlambat->format("%a") . " Hari"; ?></td>
                                                    <td><?= $key['tgl_transaksi'] ?></td>
                                                    <td><?= getRupiah($terlambat->format("%a") * $this->Mobil_model->get_data_id($key['id_mobil'])["harga"]) ?></td>
                                                    <td><?= getStatus($key['status']) ?></td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <?php if ($key["status"] == "0") { ?>

                                                            <?php } else if ($key["status"] == "1") { ?>
                                                                <a href="<?php echo base_url(); ?>transaksi/detail_pembayaran/<?= $key['id_transaksi'] ?>" class="btn btn-sm btn-warning">Bukti Pembayaran</a>
                                                                <!-- <a href="<?php echo base_url(); ?>transaksi/terima_transaksi/<?= $key['id_transaksi'] ?>/2" class="btn btn-sm btn-success">Konfirmasi Pembayaran</a> -->
                                                            <?php } else if ($key["status"] == "2") { ?>
                                                                <a href="<?php echo base_url(); ?>transaksi/terima_transaksi/<?= $key['id_transaksi'] ?>/3" class="btn btn-sm btn-info">Pesanan Dalam Perjalanan</a>
                                                            <?php } ?>
                                                            <a href="<?php echo base_url(); ?>transaksi/detail/<?= $key['id_user'] . '/' . $key['id_transaksi'] ?>" class="btn btn-sm btn-primary">Detail Transaksi</a>
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