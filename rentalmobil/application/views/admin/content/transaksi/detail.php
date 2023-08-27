<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Transaksi</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $this->Rental_model->get_data_id($mobil["id_rental"])["nama"] ?></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <section class="content invoice">
                            <!-- info row -->
                            <br>
                            <div class="row invoice-info">
                                <div class="col-sm-2 invoice-col">
                                    <address>
                                        <strong>Nama Peminjam</strong>
                                        <br>Nomor Telephone
                                        <br>Pekerjaan
                                        <br>Alamat
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <strong><?= $user["nama"] ?></strong>
                                        <br><?= $user["no_hp"] ?>
                                        <br><?= $user["pekerjaan"] ?>
                                        <br><?= $user["alamat"] ?>
                                    </address>
                                </div>
                                <?php
                                $t = date_create($transaksi['tgl_pinjam']);
                                $n = date_create($transaksi['tgl_kembali']);
                                $terlambat = date_diff($t, $n);
                                ?>
                                <div class="col-sm-4 invoice-col">
                                    <b>Tanggal Transaksi </b> <?= $transaksi["tgl_transaksi"] ?>
                                    <br>
                                    <br>
                                    <b>Tanggal Pinjam:</b> <?= $transaksi["tgl_pinjam"] ?>
                                    <br>
                                    <b>Tanggal kembali:</b> <?= $transaksi["tgl_kembali"] ?>
                                    <br>
                                    <b>Jumlah Hari:</b> <?= $terlambat->format("%a") . " Hari" ?>
                                </div>
                            </div>
                            <br>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="  table">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Baju Adat</th>
                                                <th>Asal Derah Baju Adat</th>
                                                <th>Suku</th>
                                                <!-- <th>Kapasitas</th>
                                                <th>Tipe</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $mobil["nama_mobil"] ?></td>
                                                <td><?= $mobil["plat_mobil"] ?></td>
                                                <td><?= $mobil["merk"] ?></td>
                                                <!-- <td><?= $mobil["kapasitas"] . " Penumpang" ?></td>
                                                <td><?= getTipe($mobil["tipe"]) ?></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-md-6">
                                    <p class="lead">Foto Mobil yang dipinjam:</p>
                                    <img src="<?php echo base_url(); ?>public/images/mobil/<?= $mobil["foto"] ?>" style="width: 100%;" alt="Visa">
                                </div>
                                <div class="col-md-6">
                                    <p class="lead">Rincian Harga</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Harga Sewa Mobil:</th>
                                                    <td><?= getRupiah($mobil["harga"]) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Hari</th>
                                                    <td><?= $terlambat->format("%a") . " Hari" ?> </td>
                                                </tr>
                                                <?php
                                                $hari_perpanjang = 0;
                                                if ($perpanjangan != null) {
                                                    $t2 = date_create($perpanjangan['tgl_perpanjangan']);
                                                    $n2 = date_create($perpanjangan['tgl_kembali']);
                                                    $terlambat2 = date_diff($t2, $n2);
                                                    $hari_perpanjang = $terlambat2->format("%a");
                                                ?>
                                                    <tr>
                                                        <th style="width:50%">Jumlah Hari Perpanjangan:</th>
                                                        <td><?= $terlambat2->format("%a") . " Hari" ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td><b><?= getRupiah($mobil["harga"] * ($terlambat->format("%a") + $hari_perpanjang)) ?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <br>
                            <br>

                            <!-- this row will not appear when printing -->
                            <!-- <div class="row no-print">
                                <div class=" ">
                                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                                </div>
                            </div> -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>