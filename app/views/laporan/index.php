<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2>Laporan</h2>
        <hr>
    </div>
</div>

<div class="card p-3">
    <?php if ($type == 'pasien'): ?>
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
        
    <?php elseif ($type == 'dokter'): ?>
        <h5 class="card-title">Laporan Kunjungan per Dokter</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Total Kunjungan</th>
                        <th>Kunjungan Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['nama_dokter']) ?></td>
                            <td><?= htmlspecialchars($d['spesialisasi']) ?></td>
                            <td><span class="badge bg-primary"><?= $d['total_kunjungan'] ?></span></td>
                            <td><?= $d['kunjungan_terakhir'] ? date('d-m-Y', strtotime($d['kunjungan_terakhir'])) : '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($type == 'penyakit'): ?>
        <h5 class="card-title">Laporan Penyakit Paling Banyak Ditangani (Top 10)</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Penyakit (Diagnosis)</th>
                        <th>Total Kasus</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['nama_penyakit']) ?></td>
                            <td><span class="badge bg-danger"><?= $d['total_kasus'] ?></span></td>
                            <td><?= number_format($d['persentase'], 2, ',', '.') ?>%</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($type == 'statistik'): ?>
        <h5 class="card-title">Statistik Pasien Berdasarkan Usia & Jenis Kelamin</h5>
        <div class="row">
            <div class="col-md-6">
                <h6>Statistik Jenis Kelamin</h6>
                <table class="table table-bordered table-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>Jumlah Pasien</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['jenis_kelamin'])): ?>
                            <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                            <?php foreach ($data['jenis_kelamin'] as $jk): ?>
                            <tr>
                                <td><?= $jk['jenis_kelamin'] ?></td>
                                <td><?= $jk['jumlah'] ?></td>
                                <td><span class="badge bg-primary"><?= number_format($jk['persentase'], 2, ',', '.') ?>%</span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Statistik Kelompok Usia</h6>
                <table class="table table-bordered table-sm">
                    <thead class="table-success">
                        <tr>
                            <th>Kelompok Usia</th>
                            <th>Jumlah Pasien</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['kelompok_usia'])): ?>
                            <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                            <?php foreach ($data['kelompok_usia'] as $usia): ?>
                            <tr>
                                <td><?= $usia['kelompok'] ?></td>
                                <td><?= $usia['jumlah'] ?></td>
                                <td><span class="badge bg-success"><?= number_format($usia['persentase'], 2, ',', '.') ?>%</span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>