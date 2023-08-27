<html>

<head>
    <title>Data Laporan</title>
    <link href="<?php echo base_url(); ?>public/assets/css/report.css" rel="stylesheet" type="text/css">
    <style>
        .textx {
            mso-number-format: "\@";
        }

        td,
        th {
            font-size: 6.5pt;
            mso-number-format: "\@";
        }
    </style>
</head>

<body>
    <div id="container">
        <!-- Print Body -->
        <div id="body">
            <div class="header" align="left">
                <h3> DATA LAPORAN </h3>
                <h5>Dari <?= $tgl_dari ?> Sampai <?= $tgl_sampai ?></h5>
                <h3> </h3>
            </div>
            <br>
            <table class="border thick">
                <thead>
                    <tr class="border thick">
                        <th>
                            <font size="2">No</font>
                        </th>
                        <th>
                            <font size="2">Tanggal</font>
                        </th>
                        <th>
                            <font size="2">Nama Pasien</font>
                        </th>
                        <th>
                            <font size="2">Jenis terapi</font>
                        </th>
                        <th>
                            <font size="2">Terapi</font>
                        </th>
                        <th>
                            <font size="2">Lokasi</font>
                        </th>
                        <th>
                            <font size="2">Pendapatan</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $arr = array();
                    foreach ($laporan as $key) {
                        $harga = $key['satuan'];
                        $total = array_push($arr, $harga);
                        $total_harga = array_sum($arr);
                        $arr2 = array();
                        for ($j = 0; $j < count($this->Rekam_model->get_data_terapi($key['jenis_terapi'])); $j++) {
                            array_push($arr2, $this->Rekam_model->get_data_terapi($key['jenis_terapi'])[$j]["jenis_terapi"]);
                        }
                    ?>
                        <tr>
                            <td>
                                <font size="2"><?= $i++ ?></font>
                            </td>
                            <td>
                                <font size="2"><?= $key["tgl"] ?></font>
                            </td>
                            <td>
                                <font size="2"><?= $this->Pasien_model->get_data_id($key['id_pasien'])['nama'] ?></font>
                            </td>
                            <td>
                                <font size="2"><?= implode(",", $arr2) ?></font>
                            </td>
                            <td>
                                <font size="2"><?= $key['nama_terapi'] ?></font>
                            </td>
                            <td>
                                <font size="2"><?= $key['kondisi'] ?></font>
                            </td>
                            <td>
                                <font size="2"><?= getRupiah($key['satuan']) ?></font>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr class="border thick">
                        <th colspan="5"></th>
                        <th>Total</th>
                        <th>
                            <font size="4"><?= getRupiah($total_harga) ?></font>
                        </th>
                    </tr>
                </tbody>
            </table>

            <br><br><br>
            <table width="100%">
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td width="10%"></td>
                    <td width="50%"></td>
                    <td align="center"><?= $config['nama_desa'] ?>, <?= $tanggal_sekarang ?></td>
                </tr>
                <tr>
                    <td width="23%" align="center">
                        <font size="3">Mengetahui</font>
                    </td>
                    <td width="30%"></td>
                    <td align="center">
                        <font size="3">Penanggung Jawab</font>
                    </td>
                </tr>


                <tr>
                    <td align="center"><br><br><br><br><br><br><br>
                        <font size="3">( Pimpinan RBG ) </font>
                    <td></td>
                    <td align="center"><br><br><br><br><br><br><br>
                        <font size="3"></font>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <label>Tanggal cetak : &nbsp; </label>
        <?= tgl_indo(date("Y m d")) ?> -->
    </div>
</body>

</html>