<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ubah Data Baju Adat</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 ">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <form action="<?php echo site_url() . "mobil/edit/" . $mobil["id_mobil"]; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Rental</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="rental" class="form-control form-control-sm select2" required="">
                                        <option value="">Pilih Rental</option>
                                        <?php
                                        foreach ($rental as $kt) {
                                            $selected = ($kt['id'] == $mobil['id_rental']) ? ' selected="selected"' : "";
                                            echo '<option value="' . $kt['id'] . '" ' . $selected . '>' . $kt['nama'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama_mobil" value="<?= $mobil['nama_mobil'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Asal Derah Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="plat_mobil" value="<?= $mobil['plat_mobil'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Suku</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="merk" value="<?= $mobil['merk'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Usia Pemakai</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="tahun" value="<?= $mobil['tahun'] ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" max="1000000" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Ukuran</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="kapasitas" value="<?= $mobil['kapasitas'] ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" max="1000000" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Harga</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="harga" id="harga" value="<?= $mobil['harga'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Warna</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="warna" value="<?= $mobil['warna'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Untuk</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="tipe" class="form-control" required>
                                        <option value="">Jenis Kelamin</option>
                                        <option value="1" <?php if ($mobil['tipe'] == 1) {
                                                                echo "selected";
                                                            } ?>>laki-laki</option>
                                        <option value="2" <?php if ($mobil['tipe'] == 2) {
                                                                echo "selected";
                                                            } ?>>perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Deskripsi Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <!-- <input type="text" class="form-control" name="warna" value="<?= $mobil['warna'] ?>" required> -->
                                    <textarea class="form-control" name="deskripsi"><?= $mobil['deskripsi'] ?></textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <form action="<?php echo site_url() . "mobil/edit_gambar/" . $mobil["id_mobil"]; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Staff</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <img style="width: 100%;" src="<?php echo base_url(); ?>public/images/mobil/<?= $mobil["foto"] ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Pilih Foto Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="hidden" class="form-control" name="fotonama" value="<?php echo $mobil['foto'] ?>">
                                    <input name="foto" type="file" id="input-file-now" class="form-control" data-max-file-size="10.5M" required />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9  offset-md-3">
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

<script type="text/javascript">
    var rupiah = document.getElementById("harga");
    rupiah.addEventListener("keyup", function(e) {
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>