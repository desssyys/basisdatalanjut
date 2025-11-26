<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-users"></i> Data Janji Temu</h2>
            <a href="<?= BASE_URL ?>index.php?page=janji&action=create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Janji Temu
            </a>
        </div>
        <hr>
    </div>
</div>
        
<form method="GET" style="margin-bottom: 15px;">
    <input type="hidden" name="page" value="janji">
    <input type="text" name="search" placeholder="Cari janji temu..." 
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
                        <th>ID Janji Temu</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($janji)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($janji as $j): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $j['id_janji_temu'] ?></td>
                            <td><?= date('d-m-Y', strtotime($j['tanggal'])) ?></td>
                            <td><?= date('H:i', strtotime($j['jam'])) ?></td>
                            <td><?= htmlspecialchars($j['nama_pasien'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($j['nama_dokter'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($j['nama_spesialisasi'] ?? '-') ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>index.php?page=janji&action=edit&id=<?= $j['id_janji_temu'] ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL ?>index.php?page=janji&action=delete&id=<?= $j['id_janji_temu'] ?>" 
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