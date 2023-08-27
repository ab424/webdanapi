<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">

                <div class="col-lg-6 col-5 text-left">
                    <!-- <a href="#" class="btn btn-sm btn-neutral">New</a>
                    <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
                    <!-- <form action="<?php echo base_url(); ?>path/to/search_result" method="post" target="_blank"> -->
                    <form action="<?php echo base_url() . "laporan/laporan"; ?>" method="post">
                        <div class="card-header-left">
                            <div class="btn-group card-option">

                                <input placeholder="Dari Tanggal" name="tgl_dari" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?php echo $tgl_dari ?>" required>
                                <font style="margin-top: 10px; padding-left: 10px; padding-right: 10px;" color="white">sampai</font>
                                <input placeholder="Sampai Tanggal" name="tgl_sampai" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?php echo $tgl_sampai ?>" required>
                                <!-- <button type="submit" class="btn-primary btn-sm" data-toggle="modal" data-target="#defaultModal" id="click">Cari</button> -->
                                <input style="margin-left: 10px; margin-right: 10px;" type="submit" class="btn-danger btn-sm" name="cari" value="Tampilkan">

                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <form action="<?php echo base_url() . "laporan/laporan"; ?>" method="post" target="_blank">
                        <div class="card-header-left">
                            <div class="btn-group card-option">
                                <input placeholder="Dari Tanggal" name="tgl_dari" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?php echo $tgl_dari ?>" hidden>
                                <input placeholder="Sampai Tanggal" name="tgl_sampai" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?php echo $tgl_sampai ?>" hidden>
                                <input type="submit" class="btn-info btn-sm" name="cetak" value="cetak">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Laporan</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">No</th>
                                <th scope="col" class="sort" data-sort="budget">Tanggal</th>
                                <th scope="col" class="sort" data-sort="status">Nama Pasien</th>
                                <th scope="col">Jenis terapi</th>
                                <th scope="col">Terapi</th>
                                <th scope="col" class="sort" data-sort="completion">Lokasi</th>
                                <th scope="col">Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="list">

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
                                    <th scope="row"><?= $i++ ?></th>
                                    <td class="budget"><?= $key["tgl"] ?></td>
                                    <td><?= $this->Pasien_model->get_data_id($key['id_pasien'])['nama'] ?></td>
                                    <td><?= implode(",", $arr2) ?></td>
                                    <td><?= $key['nama_terapi'] ?></td>
                                    <td><?= $key['kondisi'] ?></td>
                                    <td><?= getRupiah($key['satuan']) ?></td>
                                </tr>
                            <?php } ?>
                            <!-- <thead class="thead-light">
                                <tr>
                                    <th colspan="3" scope="col" class="sort" data-sort="name"></th>
                                    <th scope="col">Total</th>
                                    <th scope="col" class="sort" data-sort="completion">
                                        <font size="20">Rp. 2.500.000</font>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead> -->
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <font size="5">Total : </font>
                                <font size="5"><?= getRupiah($total_harga) ?></font>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>