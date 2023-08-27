<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Dalam Proses Peminjaman</h3>
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

                                                $perpanjangan = $this->Transaksi_model->get_data_detail_perpanjang($key['id_transaksi']);
                                                $hari_perpanjang = 0;
                                                if ($perpanjangan != null) {
                                                    $t2 = date_create($perpanjangan['tgl_perpanjangan']);
                                                    $n2 = date_create($perpanjangan['tgl_kembali']);
                                                    $terlambat2 = date_diff($t2, $n2);
                                                    $hari_perpanjang = $terlambat2->format("%a");
                                                }
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $this->User_model->get_data_id($key['id_user'])["nama"]; ?></td>
                                                    <td><?= $this->Mobil_model->get_data_id($key['id_mobil'])["nama_mobil"] ?></td>
                                                    <td><?= $this->Mobil_model->get_data_id($key['id_mobil'])["plat_mobil"] ?></td>
                                                    <!-- <td><?= $key['tgl_pinjam'] ?></td>
                                                    <td><?= $key['tgl_kembali'] ?></td> -->
                                                    <td><?= $terlambat->format("%a") + $hari_perpanjang . " Hari"; ?></td>
                                                    <td><?= $key['tgl_transaksi'] ?></td>
                                                    <!-- <td><?= getRupiah($terlambat->format("%a") * $this->Mobil_model->get_data_id($key['id_mobil'])["harga"]) ?></td> -->
                                                    <td><?= getRupiah($this->Mobil_model->get_data_id($key['id_mobil'])["harga"] * ($terlambat->format("%a") + $hari_perpanjang)) ?></td>
                                                    <td><?= getStatus($key['status']) ?></td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <?php if ($key["status"] == "0") { ?>

                                                            <?php } else if ($key["status"] == "4") { ?>
                                                                <a href="<?php echo base_url(); ?>transaksi/detail_pembayaran_perpanjang/<?= $key['id_transaksi'] ?>" class="btn btn-sm btn-warning">Bukti Pembayaran</a>
                                                            <?php } else if ($key["status"] == "5") { ?>
                                                                <a onclick="doneTransaksi('<?= $key['id_transaksi'] ?>');" class="btn btn-danger btn-success btn-sm">
                                                                    <font color="white">Konfirmasi Pengembalian</font>
                                                                </a>

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
    function doneTransaksi(recertid) {
        swal({
                title: "",
                text: "Apakah Anda yakin dengan tindakan ini?",
                type: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "YA!",
                cancelButtonText: "Batal!",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location = "<?php echo site_url('transaksi/terima_transaksi_selesai/'); ?>" + recertid;
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