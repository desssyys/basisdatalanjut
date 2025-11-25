<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-user-md"></i> <?= isset($dokter) ? 'Edit' : 'Tambah' ?> Dokter</h2>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" 
                               value="<?= isset($dokter) ? htmlspecialchars($dokter['nama_dokter']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Spesialisasi <span class="text-danger">*</span></label>
                        <select class="form-select" name="spesialisasi" required>
                            <option value="">Pilih Spesialisasi</option>
                            <?php foreach ($spesialisasi as $s): ?>
                                <option value="<?= $s['id_spesialisasi'] ?>" 
                                    <?= isset($dokter) && $dokter['id_spesialisasi'] == $s['id_spesialisasi'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['nama_spesialisasi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" class="form-control" name="no_hp" 
                               value="<?= isset($dokter) ? $dokter['no_hp'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" 
                               value="<?= isset($dokter) ? $dokter['email'] : '' ?>">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="<?= BASE_URL ?>index.php?page=dokter" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>