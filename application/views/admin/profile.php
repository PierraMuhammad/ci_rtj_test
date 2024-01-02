<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile Admin</h1>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/') ?>img/default.jpg" class="img-fluid rounded-start" alt="default.jpg">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama_user'] ?></h5>
                    <p class="card-text"><?= $user['user_name'] ?></p>
                    <p class="card-text"><small class="text-body-secondary">Member since <?= date("Y-m-d", strtotime($user['created_user'])) ?></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->