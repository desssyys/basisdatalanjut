<?php require_once '../app/views/layout/header.php'; ?>

<h2 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
<hr>

<div class="grid-cards">

    <div class="card-box bg-blue">
        <div class="card-info">
            <h6>Total Pasien</h6>
            <h2><?= $stats['total_pasien'] ?></h2>
        </div>
        <i class="fas fa-users card-icon"></i>
        <a class="card-footer-link" href="<?= BASE_URL ?>index.php?page=pasien">Lihat Detail →</a>
    </div>

    <div class="card-box bg-green">
        <div class="card-info">
            <h6>Total Dokter</h6>
            <h2><?= $stats['total_dokter'] ?></h2>
        </div>
        <i class="fas fa-user-md card-icon"></i>
        <a class="card-footer-link" href="<?= BASE_URL ?>index.php?page=dokter">Lihat Detail →</a>
    </div>

    <div class="card-box bg-yellow">
        <div class="card-info">
            <h6>Total Obat</h6>
            <h2><?= $stats['total_obat'] ?></h2>
        </div>
        <i class="fas fa-pills card-icon"></i>
        <a class="card-footer-link" href="<?= BASE_URL ?>index.php?page=obat">Lihat Detail →</a>
    </div>

    <div class="card-box bg-teal">
        <div class="card-info">
            <h6>Janji Hari Ini</h6>
            <h2><?= $stats['janji_hari_ini'] ?></h2>
        </div>
        <i class="fas fa-calendar-check card-icon"></i>
        <a class="card-footer-link" href="<?= BASE_URL ?>index.php?page=janji">Lihat Detail →</a>
    </div>

</div>

<div class="info-card">
    <div class="info-header">
        <i class="fas fa-info-circle"></i> Selamat Datang di <?= APP_NAME ?>
    </div>
    <div class="info-body">
        <p>Sistem ini digunakan untuk mengelola data klinik meliputi:</p>
        <ul>
            <li>Manajemen Data Pasien</li>
            <li>Manajemen Data Dokter dan Spesialisasi</li>
            <li>Manajemen Data Obat dan Stok</li>
            <li>Penjadwalan Janji Temu</li>
            <li>Pencatatan Rekam Medis</li>
            <li>Laporan dan Analisis</li>
        </ul>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>