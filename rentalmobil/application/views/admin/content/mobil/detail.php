<div class="right_col" role="main">

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Baju Adat</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $this->Rental_model->get_data_id($mobil["id_rental"])["nama"] ?></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-7 col-sm-7 ">
                            <div class="product-image">
                                <img src="<?php echo base_url(); ?>public/images/mobil/<?= $mobil["foto"] ?>" alt="..." />
                            </div>
                            <!-- <div class="product_gallery">
                                <a>
                                    <img src="images/prod-2.jpg" alt="..." />
                                </a>
                                <a>
                                    <img src="images/prod-3.jpg" alt="..." />
                                </a>
                                <a>
                                    <img src="images/prod-4.jpg" alt="..." />
                                </a>
                                <a>
                                    <img src="images/prod-5.jpg" alt="..." />
                                </a>
                            </div> -->
                        </div>

                        <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title"><?= $mobil["nama_mobil"] ?></h3>

                            <h2>Suku</h2>
                            <p><?= $mobil["merk"] ?></p>
                            <br />

                            <!-- <h2>Ukuran</h2>
                            <p><?= $mobil["kapasitas"]?></p>
                            <br />

                            <h2>Untuk</h2>
                            <p><?= getTipe($mobil["tipe"]) ?></p>
                            <br /> -->

                            <h2>Deskripsi Baju Adat</h2>
                            <p><?= $mobil["deskripsi"] ?></p>
                            <br />

                            <div class="">
                                <div class="product_price">
                                    <h1 class="price"><?= getRupiah($mobil["harga"]) ?></h1>
                                    <span class="price-tax">Harga Sewa</span>
                                    <br>
                                </div>
                            </div>
                            <br>

                            <h2>Status</h2>
                            <p>
                                <?php
                                if ($mobil["status"] == 0) { ?>
                                    <a href="#" class="btn btn-sm btn-success">Tersedia</a>
                                <?php } else { ?>
                                    <a href="" class="btn btn-sm btn-danger">DiPinjam</a>
                                <?php } ?>
                            </p>
                            <br />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>