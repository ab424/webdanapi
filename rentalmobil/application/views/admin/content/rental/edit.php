<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ubah Data Staff</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 ">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <form action="<?php echo site_url() . "rental/edit/" . $rental["id"]; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" value="<?= $rental["nama"] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">No Telphone</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="no_hp" value="<?= $rental["no_hp"] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">No Rekening</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="norek" value="<?= $rental["norek"] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Bank</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama_bank" value="<?= $rental["nama_bank"] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Di Rekening</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama_rekening" value="<?= $rental["nama_rekening"] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Alamat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="alamat" value="<?= $rental["alamat"] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Password</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="password" class="form-control" name="password" value="<?= $rental["password"] ?>" required>
                                </div>
                            </div>
                            <!-- <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Lokasi Latitude</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="lat" value="<?= $rental["lat"] ?>">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Lokasi Longitude</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="lng" value="<?= $rental["lng"] ?>">
                                </div>
                            </div> -->
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>