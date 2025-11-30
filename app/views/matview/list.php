<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2></i> View Laporan Klinik</h2>
        <hr>
    </div>
</div>

        <p class="text-muted">
        </p>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Jumlah Kunjungan</th>
                        <th>Jumlah Pasien</th>
                        <th>Daftar Diagnosis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['nama_dokter']) ?></td>
                            <td><span class="badge bg-primary"><?= $d['jumlah_kunjungan'] ?></span></td>
                            <td><span class="badge bg-success"><?= $d['jumlah_pasien'] ?></span></td>
                            <td><?= htmlspecialchars($d['daftar_diagnosis']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
