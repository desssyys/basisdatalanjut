<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'index.php?page=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a class="nav-brand" href="<?= BASE_URL ?>index.php?page=dashboard">
                <i class="fas fa-hospital"></i> <?= APP_NAME ?>
            </a>
            <button class="nav-toggler" id="navToggler" type="button" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>
            <div class="nav-menu" id="navMenu">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?page=dashboard">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?page=pasien">
                            <i class="fas fa-users"></i> Pasien
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?page=dokter">
                            <i class="fas fa-user-md"></i> Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?page=obat">
                            <i class="fas fa-pills"></i> Obat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?page=janji">
                            <i class="fas fa-calendar-check"></i> Janji Temu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?page=rekam">
                            <i class="fas fa-file-medical"></i> Rekam Medis
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="laporanDropdown">
                            <i class="fas fa-chart-bar"></i> Laporan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=matview">View Laporan Klinik</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=laporan&type=pasien">Laporan Pasien</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=laporan&type=janji">Laporan Janji</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=laporan&type=obat">Laporan Obat</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=laporan&type=penyakit">Laporan Penyakit</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=laporan&type=statistik">Statistik Pasien</a></li>
                        </ul>
                    </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav-list nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown">
                            <i class="fas fa-user"></i> <?= $_SESSION['username'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?page=logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">