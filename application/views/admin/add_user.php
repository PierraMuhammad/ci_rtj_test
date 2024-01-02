<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New User</h1>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md">
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('admin/add_user') ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="name" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<small class="text-danger ">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="<?= set_value('username') ?>">
                                <?= form_error('username', '<small class="text-danger ">', '</small>'); ?>
                            </div>
                            <div class=" form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="password1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password1" name="password1">
                                    <?= form_error('password1', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="password2" class="form-label">Re-entry Password</label>
                                    <input type="password" class="form-control" id="password2" name="password2">
                                </div>
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