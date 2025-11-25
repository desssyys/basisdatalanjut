<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Pasien</h6>
                        <h2><?= $stats['total_pasien'] ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-primary bg-opacity-75">
                <a href="<?= BASE_URL ?>index.php?page=pasien" class="text-white text-decoration-none">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Dokter</h6>
                        <h2><?= $stats['total_dokter'] ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-user-md fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-success bg-opacity-75">
                <a href="<?= BASE_URL ?>index.php?page=dokter" class="text-white text-decoration-none">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Obat</h6>
                        <h2><?= $stats['total_obat'] ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-pills fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-warning bg-opacity-75">
                <a href="<?= BASE_URL ?>index.php?page=obat" class="text-white text-decoration-none">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Janji Hari Ini</h6>
                        <h2><?= $stats['janji_hari_ini'] ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-calendar-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-info bg-opacity-75">
                <a href="<?= BASE_URL ?>index.php?page=janji" class="text-white text-decoration-none">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-info-circle"></i> Selamat Datang di <?= APP_NAME ?>
            </div>
            <div class="card-body">
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
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>