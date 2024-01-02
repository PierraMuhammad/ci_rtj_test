<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
            <a href="<?= base_url('admin/add_user') ?>" class="mx-3"><button class="btn btn-primary">add user</button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Username</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Role</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">created at</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($data_user as $member) : ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $member['nama_user'] ?></td>
                                            <td><?= $member['user_name'] ?></td>
                                            <td><?php if ($member['role_id'] == 1) {
                                                    echo 'Admin';
                                                } else {
                                                    echo 'User';
                                                } ?></td>
                                            <td><?= $member['created_user'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/view_user/') ?><?= $member['Id_user'] ?>">
                                                    <button class="btn btn-primary">View</button>
                                                </a>
                                                <a href="<?= base_url('admin/edit_user/') ?><?= $member['Id_user'] ?>">
                                                    <button class="btn btn-success">Edit</button>
                                                </a>
                                                <a href="<?= base_url('admin/delete_user/') ?><?= $member['Id_user'] ?>">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $i += 1;
                                    endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->