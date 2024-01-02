<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md">
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('admin/edit_user/') ?><?= $edit_user['Id_user'] ?>" method="post">
                            <input type="hidden" name="id" value="<?= $edit_user['Id_user'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="name" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?= $edit_user['nama_user'] ?>">
                                <?= form_error('name', '<small class="text-danger ">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="<?= $edit_user['user_name'] ?>">
                                <?= form_error('username', '<small class="text-danger ">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->