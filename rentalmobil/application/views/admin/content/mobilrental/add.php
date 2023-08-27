<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Tambah Data Baju Adat</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 ">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <form action="<?php echo site_url() . "mobilrental/add"; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama_mobil" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Asal Derah Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="plat_mobil" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Suku</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="merk" required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Usia Pemakai</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="tahun" required>
                                    <!-- <input type="text" class="form-control" name="tahun" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" max="1000000" required> -->
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Ukuran</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="kapasitas" required>
                                    <!-- <input type="text" class="form-control" name="kapasitas" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" max="1000000" required> -->
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Harga/Hari</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="harga" id="harga" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Warna</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="warna" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Untuk</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="tipe" class="form-control" required>
                                        <option value="">Jenis Kelamin</option>
                                        <option value="1">laki-laki</option>
                                        <option value="2">perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Deskripsi Baju Adat</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <!-- <input type="text" class="form-control" name="warna" value="<?= $mobil['warna'] ?>" required> -->
                                    <textarea class="form-control" name="deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Pilih Foto Mobil</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input name="foto" type="file" id="input-file-now" class="form-control" data-max-file-size="20.5M" required />
                                </div>
                            </div>
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