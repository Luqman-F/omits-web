<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <?php foreach ($roles as $role) : ?>
            <div class="col mb-4">
                <div class="card shadow border-left-info h-100">
                    <div class="card-body">
                        <div class="text-xs text-info font-weight-bold text-uppercase mb-1"><?= $role['role'] == '-' ? 'Belum terverifikasi' : $role['role'] ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $role['jumlah'] ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">Pendaftar Per Hari</h6>
                </div>
                <div class="card-body">
                        <canvas id="grafikPeserta" class="chartjs-render-monitor" height="80rem"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const ctx = document.getElementById('grafikPeserta');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                data: <?= $peserta ?>,
                borderColor: '#57ff4f',
                backgroundColor: '#00c640',
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    suggestedMin: 0,
                    suggestedMax: 10,
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>