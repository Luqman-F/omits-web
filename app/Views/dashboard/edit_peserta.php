<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if ($msg = session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $msg ?>
        </div>
    <?php endif ?>
    <?php if ($msg = session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger">
            <?= $msg ?>
        </div>
    <?php endif; ?>
    <form action="<?= route_to('Peserta::editProfil') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nama_ketua">Nama Lengkap Ketua</label>
                    <input type="text" class="form-control" name="nama_ketua" id="nama_ketua" placeholder="NAMA KETUA" value="<?= $user['nama_ketua'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama_anggota">Nama Lengkap Anggota</label>
                    <input type="text" class="form-control" name="nama_anggota" id="nama_anggota" placeholder="NAMA ANGGOTA" value="<?= $user['nama_anggota'] ?>">
                    <small class="form-text ml-2">*Nama ditulis menggunakan huruf kapital</small>
                </div>
                <div class="form-group">
                    <label for="sekolah">Sekolah</label>
                    <input type="text" class="form-control" name="sekolah" id="sekolah" placeholder="Sekolah" value="<?= $user['sekolah'] ?>">
                </div>
                <div class="form-group">
                    <label for="nisn_ketua">NISN/NIM Ketua</label>
                    <input type="text" class="form-control" name="nisn_ketua" id="nisn_ketua" placeholder="NISN/NIM Ketua" value="<?= $user['nisn_ketua'] ?>">
                </div>
                <div class="form-group">
                    <label for="nisn_anggota">NISN/NIM Anggota</label>
                    <input type="text" class="form-control" name="nisn_anggota" id="nisn_anggota" placeholder="NISN/NIM Ketua" value="<?= $user['nisn_anggota'] ?>">
                </div>
                <div class="form-group">
                    <label for="wa_ketua">No. WA Ketua</label>
                    <input type="text" class="form-control" name="wa_ketua" id="wa_ketua" placeholder="No. WA Ketua" value="<?= $user['wa_ketua'] ?>">
                </div>
                <div class="form-group">
                    <label for="wa_anggota">No. WA Anggota</label>
                    <input type="text" class="form-control" name="wa_anggota" id="wa_anggota" placeholder="No. WA Anggota" value="<?= $user['wa_anggota'] ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="<?= $user['kota'] ?>">
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" name="provinsi" id="provinsi" placeholder="Provinsi" value="<?= $user['provinsi'] ?>">
                </div>
                <div class="form-group">
                    <label for="bukti_nisn_ketua">Upload bukti NISN/NIM Ketua</label>
                    <input type="file" class="form-control-file" id="bukti_nisn_ketua" name="bukti_nisn_ketua">
                </div>
                <div class="form-group">
                    <label for="bukti_nisn_ketua">Upload bukti NISN/NIM Anggota</label>
                    <input type="file" class="form-control-file" id="bukti_nisn_ketua" name="bukti_nisn_ketua">
                </div>
                <div class="form-group">
                    <label for="role_id">Status</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <?php foreach ($roles as $role) : ?>
                            <option value=<?= $role['id'] ?> <?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>> <?= $role['name'] ?>
                            <?php endforeach ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Simpan</button>

            </div>
        </div>

    </form>
</div>

<?= $this->endSection() ?>