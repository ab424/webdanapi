<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Transaksi Selesai</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <form action="<?php echo base_url() . "transaksiselesairental"; ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Rentang Waktu</h6>
                        <div class="input-daterange input-group" id="date-range" style="width: 50%;">
                            <input placeholder="Dari Tanggal" name="tgl_dari" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?php echo $tgl_dari ?>" required>
                            <span class="input-group-addon bg-primary b-0 text-white">to</span>
                            <input placeholder=" Sampai Tanggal" name="tgl_sampai" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?php echo $tgl_sampai ?>" required>
                            <input type="submit" class="btn btn-success waves-effect waves-light" name="cari" value="Lihat">
                        </div>
                    </div>
            </form>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <!-- <table id="datatable" class="table table-striped table-bordered" style="width:100%"> -->
                                    <table class="table table-striped table-bordered" style="width:100%">
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
                                            $arrTotal = array();
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

                                                $total = $this->Mobil_model->get_data_id($key['id_mobil'])["harga"] * ($terlambat->format("%a") + $hari_perpanjang);
                                                array_push($arrTotal, $total);
                                                $total_semua = array_sum($arrTotal);
                                            ?>
                                                <?php if ($_SESSION['id'] != $this->Mobil_model->get_data_id($key['id_mobil'])["id_rental"]) {
                                                } else { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $this->User_model->get_data_id($key['id_user'])["nama"]; ?></td>
                                                        <td><?= $this->Mobil_model->get_data_id($key['id_mobil'])["nama_mobil"] ?></td>
                                                        <td><?= $this->Mobil_model->get_data_id($key['id_mobil'])["plat_mobil"] ?></td>
                                                        <!-- <td><?= $key['tgl_pinjam'] ?></td>
                                                    <td><?= $key['tgl_kembali'] ?></td> -->
                                                        <td><?= $terlambat->format("%a") + $hari_perpanjang . " Hari"; ?></td>
                                                        <td><?= $key['tgl_transaksi'] ?></td>
                                                        <td><?= getRupiah($this->Mobil_model->get_data_id($key['id_mobil'])["harga"] * ($terlambat->format("%a") + $hari_perpanjang)) ?></td>
                                                        <td><?= getStatus($key['status']) ?></td>
                                                        <td>
                                                            <div class="avatar-group">

                                                                <a href="<?php echo base_url(); ?>transaksi/detail/<?= $key['id_user'] . '/' . $key['id_transaksi'] ?>" class="btn btn-sm btn-primary">Detail Transaksi</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                            <th colspan="5"></th>
                                            <th colspan="1">Jumlah Total</th>
                                            <th>
                                                <?php
                                                if (empty($total_semua)) {
                                                } else {
                                                    echo getRupiah($total_semua);
                                                } ?>
                                            </th>
                                            <th></th>
                                            <th></th>
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