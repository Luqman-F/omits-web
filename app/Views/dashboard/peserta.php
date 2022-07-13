<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Profil</h5>
                </div>
                <div class="card-body">
                    <?= $table ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>