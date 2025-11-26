<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-pills"></i> Data Obat</h2>
            <a href="<?= BASE_URL ?>index.php?page=obat&action=create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Obat
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="card">
    <div class="card-body">

    <form method="GET" style="margin-bottom: 15px;">
    <input type="hidden" name="page" value="obat">
    <input type="text" name="search" placeholder="Cari nama obat..." 
           value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" 
           style="padding: 6px; width: 200px;">

    <button type="submit" style="padding: 6px 12px; cursor:pointer;">
        Cari
    </button>
</form>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($obat)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($obat as $o): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $o['id_obat'] ?></td>
                            <td><?= htmlspecialchars($o['nama_obat']) ?></td>
                            <td>Rp <?= number_format($o['harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-success">
                                     <?= $o['stok'] ?>
                                </span>

                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>index.php?page=obat&action=edit&id=<?= $o['id_obat'] ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL ?>index.php?page=obat&action=delete&id=<?= $o['id_obat'] ?>" 
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
