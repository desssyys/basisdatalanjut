<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-users"></i> Data Pasien</h2>
            <a href="<?= BASE_URL ?>index.php?page=pasien&action=create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pasien
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
                        <th>ID Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pasien)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($pasien as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['id_pasien'] ?></td>
                            <td><?= htmlspecialchars($p['nama_pasien']) ?></td>
                            <td><?= $p['jenis_kelamin'] ?></td>
                            <td><?= $p['umur'] ?> tahun</td>
                            <td><?= htmlspecialchars($p['alamat']) ?></td>
                            <td><?= $p['no_hp'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>index.php?page=pasien&action=edit&id=<?= $p['id_pasien'] ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL ?>index.php?page=pasien&action=delete&id=<?= $p['id_pasien'] ?>" 
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