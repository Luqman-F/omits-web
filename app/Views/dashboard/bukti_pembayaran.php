<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            Data berhasil disimpan
        </div>
    <?php endif ?>
    <?php if ($msg = session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger">
            <?= $msg ?>
        </div>
    <?php endif; ?>
    <form action="<?= url_to('Peserta::uploadPembayaran') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="bukti_bayar">Upload bukti pembayaran</label>
            <input type="file" class="form-control-file" id="bukti_bayar" name="bukti_bayar">
            <small class="form-text">*Ukuran file maksimal 2 MB</small>

        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>

    </form>
    <div class="row">
    <div class="col-lg-6 konfirm-bayar-omits mt-4">
        <h5>KONFIRMASI PEMBAYARAN OMITS</h5>
        <P>Hubungi nomor di bawah ini sesuai provinsi sekolah Anda, dengan mengetikkan OMITS_SD/SMP/SMA_PROVINSI_NAMALENGKAP
            Contoh: OMITS_SMP_ACEH_XXXX
        </P>
        <br>
        <p>Mohon perhatikan baik-baik, nomor yang dihubungi harus sesuai dengan provinsi sekolah Anda. Terimakasih.
        </p>

        <ol>
            <li class="mb-2">
                <p>Jawa Timur 1:</p>
                <p>Naya (081271385098)</p>
                <p>Manda (087875394858)</p>
                <ul>
                    <li>Gresik</li>
                    <li>Sidoarjo</li>
                    <li>Surabaya</li>
                </ul>
            </li>
            <li class="mb-2">
                <p>Jawa Timur 2:</p>
                <p>Zahrotun (085645886467)</p>
                <p>Yohanna (089609716322)</p>
                <ul>
                    <li>Bojonegoro</li>
                    <li>Jombang</li>
                    <li>Lamongan</li>
                    <li>Madiun</li>
                    <li>Madura</li>
                    <li>Magetan</li>
                    <li>Mojokerto</li>
                    <li>Nganjuk</li>
                    <li>Ngawi</li>
                    <li>Pasuruan</li>
                    <li>Tuban</li>
                </ul>
            </li>
            <li class="mb-2">
                <p>Jawa Timur 3:</p>
                <p>Chika (085645973827)</p>
                <p>Silvia (089691879494)</p>
                <ul>
                    <li>Banyuwangi</li>
                    <li>Batu</li>
                    <li>Blitar</li>
                    <li>Bondowoso</li>
                    <li>Jember</li>
                    <li>Kediri</li>
                    <li>Lumajang</li>
                    <li>Malang</li>
                    <li>Pacitan</li>
                    <li>Ponorogo</li>
                    <li>Probolinggo</li>
                    <li>Situbondo</li>
                    <li>Trenggalek</li>
                    <li>Tulungagung</li>
                </ul>
            </li>
            <li class="mb-2">
                <p>Jawa Tengah:</p>
                <p>Juwita (082228395480)</p>
            </li>
            <li class="mb-2">
                <p>D.I. Yogyakarta:</p>
                <p>Fitri (085748535474)</p>
            </li>
            <li class="mb-2">
                <p>Jawa Barat:</p>
                <p>Niken (082397229285)</p>
            </li>
            <li class="mb-2">
                <p>D.K.I Jakarta:</p>
                <p>Salsabila (085204302771)</p>
            </li>
            <li class="mb-2">
                <p>Banten:</p>
                <p>Ela (085745206295)</p>
            </li>
            <li class="mb-2">
                <p>Sulawesi Selatan:</p>
                <p>Nida (082228578869)</p>
            </li>
            <li class="mb-2">
                <p>Kalimantan Timur:</p>
                <p>Zen (0895369154734)</p>
            </li>
            <li class="mb-2">
                <p>Kalimantan Barat:</p>
                <p>Efril (089676513624)</p>
            </li>
            <li class="mb-2">
                <p>Riau:</p>
                <p>Ica (083846720942)</p>
            </li>
            <li class="mb-2">
                <p>Lampung:</p>
                <p>Faizah (082298596696)</p>
            </li>
            <li class="mb-2">
                <p>Bali:</p>
                <p>Indira (089529776916)</p>
            </li>
            <li class="mb-2">
                <p>Nusantara 1:</p>
                <p>Efril (089609716322)</p>
                <ul>
                    <li>Papua</li>
                    <li>Papua Barat</li>
                    <li>Maluku</li>
                    <li>Maluku Utara</li>
                    <li>Gorontalo</li>
                    <li>Sulawesi Tengah</li>
                    <li>Sulawesi Tenggara</li>
                    <li>Sulawesi Barat </li>
                    <li>NTB</li>
                    <li>NTT</li>
                </ul>
            </li>
            <li class="mb-2">
                <p>Nusantara 2:</p>
                <p>Trisna (081238101448)</p>
                <ul>
                    <li>Kalimantan Utara</li>
                    <li>Kalimantan Tengah</li>
                    <li>Kalimantan Selatan</li>
                    <li>Aceh</li>
                    <li>Sumatera Barat</li>
                    <li>Sumatera Utara</li>
                    <li>Kepulauan Riau</li>
                    <li>Kepulauan Bangka Belitung</li>
                    <li>Sumatera Selatan</li>
                    <li>Bengkulu</li>
                    <li>Jambi</li>
                </ul>
            </li>
        </ol>
    </div>

    <div class="col-lg-6 konfirm-bayar-mission mt-4">
        <h5>KONFIRMASI PEMBAYARAN MISSION</h5>
        <P>Hubungi nomor di bawah ini sesuai provinsi perguruan tinggi Anda, dengan mengetikkan MISSION_PROVINSI_NAMALENGKAP
            Contoh: MISSION_ACEH_XXXX

        </P>
        <br>
        <p>Mohon perhatikan baik-baik, nomor yang dihubungi harus sesuai dengan provinsi perguruan tinggi Anda. Terimakasih.

        </p>

        <ol>
            <li>
                <p>Nusantara:</p>
                <p>Nida (082228578869)</p>
                <p>Naya (081271385098)</p>
                <p>Manda (087875394858)</p>
                <ul>
                    <li>PAPUA</li>
                    <li>MALUKU</li>
                    <li>SULAWESI</li>
                    <li>BALI</li>
                    <li>NTB</li>
                    <li>NTT</li>
                </ul>
            </li>
            <br>
            <li>
                <p>Kalimantan & Sumatera:</p>
                <p>Salsabila (085204302771)</p>
                <p>Indira (089529776916)</p>
                <p>Yohanna (089609716322)</p>
            </li>
            <br>
            <li>
                <p>D.K.I. Jakarta & Banten:</p>
                <p>Ela (085745206295)</p>
                <p>Zahrotun (085645886467)</p>
                <p>Trisna (081238101448)</p>
            </li>
            <br>
            <li>
                <p>D.I Yogyakarta & Jawa Tengah:</p>
                <p>Ica (083846720942)</p>
                <p>Chika (085645973827)</p>
                <p>Silvia (089691879494)</p>
            </li>
            <br>
            <li>
                <p>Jawa Barat:</p>
                <p>Fitri (085748535474)</p>
                <p>Faizah (082298596696)</p>
                <p>Zen (0895369154734)</p>
            </li>
            <br>
            <li>
                <p>Jawa Timur:</p>
                <p>Juwita (082228395480)</p>
                <p>Niken (082397229285)</p>
                <p>Efril (089676513624)</p>
            </li>
            <br>

        </ol>
    </div>
</div>
</div>

<?= $this->endSection() ?>