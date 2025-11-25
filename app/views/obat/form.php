<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-pills"></i> <?= isset($obat) ? 'Edit' : 'Tambah' ?> Obat</h2>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Obat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" 
                               value="<?= isset($obat) ? htmlspecialchars($obat['nama_obat']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="harga" 
                               value="<?= isset($obat) ? $obat['harga'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="stok" 
                               value="<?= isset($obat) ? $obat['stok'] : '' ?>" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="<?= BASE_URL ?>index.php?page=obat" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>