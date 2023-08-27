<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Data User</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 ">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <form action="<?php echo site_url() . "user/terima/" . $user["id"]; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Tanggal Pendaftaran</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" value="<?= $user["tgl_daftar"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nik</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $user["nik"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" value="<?= $user["nama"] ?>" disabled>
                                </div>
                            </div>
                            <!-- <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Jenis Kelamin</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" value="<?= getKelamin($user["jk"]) ?>" disabled>
                                </div>
                            </div> -->
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Nomor Telephone</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" value="<?= $user["no_hp"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Pekerjaan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $user["pekerjaan"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">No Rekening</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $user["norek"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Bank</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $user["nama_bank"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Di Rekening</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $user["nama_rekening"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Alamat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $user["alamat"] ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Foto Ktp</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <img style="width: 100%;" src="../../../api-rentalmobil/public/ktp/<?= $user["foto_ktp"] ?>" />
                                </div>
                            </div>
                            <?php if ($user["status"] == 0) { ?>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9  offset-md-3">
                                        <button type="submit" class="btn btn-success">Konfirmasi Pendaftaran</button>
                                    </div>
                                </div>
                            <?php } ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>