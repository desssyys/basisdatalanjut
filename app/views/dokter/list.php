<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-user-md"></i> Data Dokter</h2>
            <a href="<?= BASE_URL ?>index.php?page=dokter&action=create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Dokter
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
                        <th>ID Dokter</th>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dokter)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($dokter as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['id_dokter'] ?></td>
                            <td><?= htmlspecialchars($d['nama_dokter']) ?></td>
                            <td><?= htmlspecialchars($d['nama_spesialisasi'] ?? '-') ?></td>
                            <td><?= $d['no_hp'] ?></td>
                            <td><?= $d['email'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>index.php?page=dokter&action=edit&id=<?= $d['id_dokter'] ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL ?>index.php?page=dokter&action=delete&id=<?= $d['id_dokter'] ?>" 
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