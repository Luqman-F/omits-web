<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="number">
        <div class="bank">
            <h5>Bank (Transfer ATM/M-Banking)</h5>
            <p>Nomor rekening : Mandiri 1400021310496 a.n Niken Putri Ramadhani</p>
        </div>
        <div class="dana">
            <h5>DANA</h5>
                <p>Kirim ke No. Telepon: 085780307019</p>
                <p>Kirim ke Akun Bank: Mandiri 1400021310496 a.n Niken Putri Ramadhani</p>
        </div>
    </div>
    <br>
    <div class="mekanisme-transfer">
        <h5>Mekanisme Transfer</h5>

        <div class="dana">
            <h5>Transfer ke Sesama DANA :</h5>
            <ul>
                <li>Buka aplikasi DANA, lalu pilih menu Kirim(in)/Send(en).</li>
                <li>Pilih Kirim ke Nomor Telepon(in)/Send to Phone Number(en), lalu tambahkan nomor tujuan, contoh : 085780307019, lalu pilih Tambahkan penerima menggunakan nomor HP(in)/Add recipient by phone number(en).</li>
                <li>Masukkan nominal pembayaran yang akan dikirim, lalu pilih Kirim DANA(in)/SET AMOUNT(en).</li>
                <li>Pilih KONFIRMASI(in)/CONFIRM(en), lalu masukkan PIN DANA mu.</li>
                <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
            </ul>
        </div>
        <div class="atm">
            <h5>Transfer Antar Bank melalui ATM :</h5>
            <ol>
                <li>
                    <h5>Bank BNI</h5>
                    <ul>
                        <li>Masukkan kartu ATM ke mesin ATM, kemudian pilih Bahasa Indonesia.</li>
                        <li>Masukkan enam digit PIN, klik benar, lalu pilih Menu Lain.</li>
                        <li>Pilih Menu Transfer, kemudian pilih Dari Rekening Tabungan.</li>
                        <li>Selanjutnya, pilih ke rekening Mandiri dan masukkan nomor rekening tujuan. Misalnya Bank Mandiri dengan kode (008) lalu diikuti nomor rekening tujuan. Contoh: 0081400021310496.</li>
                        <li>Masukkan jumlah uang, lalu klik benar.</li>
                        <li>Pilih benar lagi dan konfirmasi jika sudah benar pilih Ya.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
                <li>
                    <h5>Bank Mandiri</h5>
                    <ul>
                        <li>Masukkan kartu ATM Mandiri ke mesin atm.</li>
                        <li>Pilih Bahasa Indonesia lalu masukkan 6 digit PIN.</li>
                        <li>Pilih menu Transaksi Lainnya.</li>
                        <li>Pilih menu Transfer lalu pilih Antar Bank Online</li>
                        <li>Masukkan kode bank tujuan diikuti dengan nomor rekening tujuan transfer. Misalnya Bank Mandiri dengan kode (008) lalu diikuti nomor rekening tujuan. Contoh: 0081400021310496.</li>
                        <li>Masukkan jumlah uang yang akan dikirim kemudian pilih Benar.</li>
                        <li>Langkah berikutnya silahkan cek kembali apakah data yang diinput sudah benar, terutama no rekening, nama pemilik rekening dan nominal sudah benar, jika sudah benar pilih YA.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
                <li>
                    <h5>Bank BCA</h5>
                    <ul>
                        <li>Masukkan Kartu ATM dengan benar, lalu masukkan PIN.</li>
                        <li>Pilih Menu transfer.</li>
                        <li>Pilih Menu Transfer, kemudian Transfer Antar ke Bank Lain.</li>
                        <li>Masukkan Nominal Transfer.</li>
                        <li>Masukkan kode bank tujuan diikuti dengan nomor rekening tujuan. Misalnya Bank Mandiri dengan kode (008) lalu diikuti nomor rekening tujuan. Contoh: 0081400021310496.</li>
                        <li>Konfirmasi Ya untuk melanjutkan transfer.</li>
                        <li>Masukkan PIN.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
                <li>
                    <h5>Bank BRI</h5>
                    <ul>
                        <li>Masukkan kartu ATM Anda ke mesin ATM.</li>
                        <li>Pilih Bahasa Indonesia dan masukkan 6 digit PIN ATM.</li>
                        <li>Pilih Menu Lain.</li>
                        <li>Pilih Transfer.</li>
                        <li>Pilih Dari Rekening Tabungan.</li>
                        <li>Pilih Ke Rekening Bank Lain.</li>
                        <li>Masukkan Kode Bank tujuan+Nomor Rekening Tujuan. Misalnya Bank Mandiri dengan kode (008) lalu diikuti nomor rekening tujuan. Contoh: 0081400021310496.</li>
                        <li>Masukkan jumlah uang yang ingin dikirim.
                        </li>
                        <li>Pada halaman konfirmasi, lihat lagi apakah data yang dimasukkan sudah benar atau belum. Jika sudah, klik Ya.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
            </ol>
        </div>
        <div class="m-banking">
            <h5>Transfer Antar Bank melalui M-Banking :</h5>
            <ol>
                <li>
                    <h5>Bank BNI</h5>
                    <ul>
                        <li>Silahkan login ke BNI Mobile dengan memasukkan UserID dan MPIN.</li>
                        <li>Pilih menu Transfer lalu pilih Antar BNI.</li>
                        <li>Setelah itu pilih Input Baru lalu masukkan nomor rekening tujuan.</li>
                        <li>Masukkan nominal yang ingin di transfer, tambahkan keterangan transfer (jika ada), lalu pilih lanjut.</li>
                        <li>Setelah itu masukkan PIN, jika sudah benar pilih lanjut.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
                <li>
                    <h5>Bank Mandiri</h5>
                    <ul>
                        <li>Buka aplikasi mandiri online di HP Anda, kemudian silahkan login ke akun Anda terlebih dahulu.</li>
                        <li>Setelah masuk pilih menu Transfer.</li>
                        <li>Pilih Menu Ke Bank Lain Dalam Negeri.</li>
                        <li>Selanjutnya tap Rekening tujuan lalu pilih nama bank tujuan pengiriman uang.</li>
                        <li>Masukkan no rekening pada kolom Tujuan. Kemudian pilih Tambah Sebagai Tujuan Baru.</li>
                        <li>Periksa kembali nomor rekening dan jika sudah benar pilih Konfirmasi.</li>
                        <li>Masukkan jumlah uang yang ingin dikirim lalu pilih Lanjut.</li>
                        <li>Periksa kembali apakah nominal serta nama pemilik rekening sudah benar atau belum, jika sudah benar pilih Kirim.</li>
                        <li>Masukkan kode MPIN.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
                <li>
                    <h5>Bank BCA</h5>
                    <ul>
                        <li>Pilih menu m-BCA di ponsel Anda dan tekan OK/YES.</li>
                        <li>Pilih menu m-Transfer dan tekan OK/YES.</li>
                        <li>Kemudian Pilih Antar Bank dan tekan OK/YES.</li>
                        <li>Masukkan Kode Bank tujuan, nomor rekening tujuan dan masukkan Jumlah Uang yang akan ditransfer dan tekan OK/YES.</li>
                        <li>Pastikan data-data transaksi yang muncul di layar konfirmasi telah benar. Jika benar, tekan OK/YES.</li>
                        <li>Masukkan PIN m-BCA Anda dan tekan OK/YES.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.</li>
                    </ul>
                </li>
                <li>
                    <h5>Bank BRI</h5>
                    <ul>
                        <li>Silahkan buka aplikasi BRI Mobile, lalu pilih menu Mobile Banking BRI</li>
                        <li>Kemudian pilih menu Transfer, lalu klik Bank Lain.</li>
                        <li>Silahkan pilih Kode Bank Tujuan, masukkan Nomor Rekening tujuan dan Jumlah Nominal Transfer, lalu klik OK.</li>
                        <li>Masukkan PIN, lalu klik SEND.</li>
                        <li>Jika sudah, maka akan muncul informasi Mobile Banking BRI akan melakukan transaksi menggunakan SMS, lalu klik OK.</li>
                        <li>Selanjutnya akan berpindah ke halaman SMS, silahkan Kirim format SMS yang tersedia.</li>
                        <li>Akan ada SMS masuk, silahkan balas SMS tersebut sesuai perintah isi SMS, ketik YA(spasi)Nomor Kode kemudian Kirim SMS.</li>
                        <li>Pembayaran berhasil dilakukan, silahkan simpan bukti transfer untuk di upload sebagai bukti pembayaran.
                        </li>
                    </ul>
                </li>
            </ol>
        </div>

    </div>
</div>


<?= $this->endSection() ?>