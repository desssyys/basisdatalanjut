<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-file-medical"></i> Data Rekam Medis</h2>
            <a href="<?= BASE_URL ?>index.php?page=rekam&action=create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Rekam Medis
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Diagnosis</th>
                        <th>Obat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rekam)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($rekam as $r): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['id_rekam_medis'] ?></td>
                            <td><?= htmlspecialchars($r['nama_pasien'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($r['nama_dokter'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($r['diagnosis']) ?></td>
                            <td><?= htmlspecialchars($r['nama_obat'] ?? '-') ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>index.php?page=rekam&action=edit&id=<?= $r['id_rekam_medis'] ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL ?>index.php?page=rekam&action=delete&id=<?= $r['id_rekam_medis'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
