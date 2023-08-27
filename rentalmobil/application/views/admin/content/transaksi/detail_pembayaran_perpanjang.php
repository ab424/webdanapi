<div class="right_col" role="main">

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Bukti Pembayaran</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $user["nama"] ?></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-4 col-sm-7 ">
                            <div class="product-image">
                                <img src="../../../api-rentalmobil/public/fbukti/<?= $transaksi["foto"] ?>" alt="..." />
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">
                            <?php
                            $t = date_create($transaksi['tgl_perpanjangan']);
                            $n = date_create($transaksi['tgl_kembali']);
                            $terlambat = date_diff($t, $n);
                            ?>
                            <h2>Atas Nama</h2>
                            <p><?= $transaksi["nama_pengirim"] ?></p>
                            <br />

                            <h2>Nomor Rekening</h2>
                            <p><?= $transaksi["nomor_pengirim"] ?></p>
                            <br />

                            <h2>Nama Bank</h2>
                            <p><?= $transaksi["nama_bank"] ?></p>
                            <br />

                            <h2>Dari Tanggal</h2>
                            <p><?= $transaksi["tgl_perpanjangan"] ?></p>
                            <br />

                            <h2>Sampai Tanggal</h2>
                            <p><?= $transaksi["tgl_kembali"] ?></p>
                            <br />

                            <h2>Jumlah Hari</h2>
                            <p><?= $terlambat->format("%a") . " Hari" ?></p>
                            <br />

                            <h2>Jumlah Yang harus Dibayar</h2>
                            <p><?= getRupiah($mobil["harga"] * $terlambat->format("%a")) ?></p>
                            <br />

                            <a href="<?php echo base_url(); ?>transaksi/terima_transaksi_perpanjangan/<?= $transaksi['id_transaksi'] ?>/2" class="btn btn-sm btn-info">Konfirmasi Pembayaran</a>
                            <!-- <a href="<?php echo base_url(); ?>transaksi/cancel_transaksi/<?= $transaksi['id_transaksi'] ?>/2" class="btn btn-sm btn-danger">Cancel Pemesanan</a> -->
                            <br />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>