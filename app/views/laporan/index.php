<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-chart-bar"></i> Laporan</h2>
        <hr>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if ($type == 'pasien'): ?>
            <!-- Laporan Pasien -->
            <h5 class="card-title">Laporan Pasien</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Total Kunjungan</th>
                            <th>Kunjungan Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data)): ?>
                            <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($data as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($d['nama_pasien']) ?></td>
                                <td><?= $d['jenis_kelamin'] ?></td>
                                <td><?= $d['umur'] ?> tahun</td>
                                <td><span class="badge bg-info"><?= $d['total_kunjungan'] ?></span></td>
                                <td><?= $d['kunjungan_terakhir'] ? date('d-m-Y', strtotime($d['kunjungan_terakhir'])) : '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($type == 'janji'): ?>
            <!-- Laporan Janji -->
            <h5 class="card-title">Laporan Janji Temu (30 Hari Terakhir)</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Total Janji</th>
                            <th>Total Pasien</th>
                            <th>Total Dokter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data)): ?>
                            <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($data as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d-m-Y', strtotime($d['tanggal'])) ?></td>
                                <td><span class="badge bg-primary"><?= $d['total_janji'] ?></span></td>
                                <td><span class="badge bg-success"><?= $d['total_pasien'] ?></span></td>
                                <td><span class="badge bg-warning"><?= $d['total_dokter'] ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($type == 'obat'): ?>
            <!-- Laporan Obat -->
            <h5 class="card-title">Laporan Penggunaan Obat</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Total Penggunaan</th>
                            <th>Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data)): ?>
                            <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($data as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($d['nama_obat']) ?></td>
                                <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge <?= $d['stok'] < 100 ? 'bg-danger' : 'bg-success' ?>">
                                        <?= $d['stok'] ?>
                                    </span>
                                </td>
                                <td><span class="badge bg-info"><?= $d['total_penggunaan'] ?></span></td>
                                <td>Rp <?= number_format($d['total_nilai'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>