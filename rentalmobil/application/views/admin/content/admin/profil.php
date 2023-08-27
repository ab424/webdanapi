<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img src="<?php echo base_url();?>public/images/ic_admin.png" style="width: 100px;" alt="AdminBSB - Profile Image" />
                        </div>
                        <div class="content-area">
                            <h4><?= $this->session->userdata('nama') ?></h4>
                            <p>
                                <?php
                                if ($this->session->userdata('level') == 1) {
                                echo "Super Admin";
                                }else{
                                echo "Admin";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <form class="form-horizontal" action="<?php echo base_url();?>administrator/ubahpass" method="POST">
                                        <div class="form-group">
                                            <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="OldPassword" name="oldpassword" placeholder="Old Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPassword" name="newpassword" placeholder="New Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPasswordConfirm" name="newpasswordconfirm" placeholder="New Password (Confirm)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php for ($i=0; $i < 15 ; $i++) { ?>
<br>
<?php } ?>
<?php if ($this->session->flashdata('error')): ?>
<script>
swal({
title: "Gagal",
text: "<?= $this->session->flashdata('error') ?>",
type: "error",
});
</script>
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
title: "Berhasil",
text: "<?= $this->session->flashdata('success') ?>",
type: "info",
});
</script>
<?php endif; ?>