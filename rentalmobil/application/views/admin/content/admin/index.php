<section class="content">
    <div class="container-fluid">
        <!-- <div class="block-header">
            <h2>NORMAL TABLES</h2>
        </div> -->
        <!-- Bordered Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                        ADMINISTRATOR
                        <!-- <small>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</small> -->
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal" id="click">TAMBAH ADMIN</button>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($dataadmin as $key) { ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $key['nama'] ?></td>
                                    <td><?= $key['username'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url();?>cadmin/edit/<?= $key['id'] ?>" class="btn btn-warning waves-effect" role="button">UBAH</a>
                                        <a onclick="myFunction('<?= $key['id']?>');" class="btn btn-danger waves-effect" role="button">HAPUS</a>
                                        
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
</section>
<?php for ($i=0; $i < 15 ; $i++) { ?>
<br>
<?php } ?>
<!-- add modal -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Tambah Admin</h4>
            </div>
            
            <div class="modal-body">
                <?php echo form_open('cadmin/add');  ?>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <div class="form-line">
                                <input type="text" name="nama" class="form-control"  placeholder="Nama" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="form-line">
                                <input type="text" name="username" class="form-control"  placeholder="Username" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="form-line">
                                <input type="password" name="password" class="form-control"  placeholder="Username" required="">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-link waves-effect">SIMPAN</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
title: "<?= $this->session->flashdata('success') ?>",
text: "Tambah Admin Success",
type: "info",
});
</script>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
<script>
swal({
title: "Gagal",
text: "<?= $this->session->flashdata('error') ?>",
type: "error",
});
</script>
<?php endif; ?>
<?php if ($this->session->flashdata('gagal_hapus')): ?>
<script>
swal({
title: "Gagal",
text: "<?= $this->session->flashdata('gagal_hapus') ?>",
type: "error",
});
</script>
<?php endif; ?>
<script>
function myFunction(recertid){
swal({
title: "",
text: "Apakah Anda yakin ingin menghapus data ini?",
type: "warning",
showCancelButton: true,
showConfirmButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Hapus!",
cancelButtonText: "Batal!",
closeOnConfirm: false,
closeOnCancel: false,
},
function(isConfirm){
if (isConfirm)
{
window.location = "<?php echo site_url('cadmin/remove/'); ?>" + recertid;
} else {
//return false;
swal({
title: "",
text: "Dibatalkan!",
type: "error",
timer: 1000
});
}
});
}
</script>