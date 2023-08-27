<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<section class="content">
    <div class="container-fluid">
        <?php echo form_open('cadmin/edit/'.$dataadmin['id']); ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                        EDIT DATA ADMIN
                        </h2>
                    </div>
                    <div class="body">
                        
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <div class="form-line">
                                        <input type="text" value="<?= $dataadmin['nama'] ?>" name="nama" class="form-control"  placeholder="Nama" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>username</label>
                                    <div class="form-line">
                                        <input type="text" value="<?= $dataadmin['username'] ?>" name="username" class="form-control"  placeholder="Username" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="form-line">
                                        <input type="password" value="<?= $dataadmin['password'] ?>" name="password" class="form-control"  placeholder="Username" required="">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" id="save-btn">Simpan</button>
    <br><br>
    <?php echo form_close(); ?>
    <!-- #END# Multi Column -->
</section>