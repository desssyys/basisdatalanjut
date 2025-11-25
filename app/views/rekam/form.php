<?php require_once '../app/views/layout/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-file-medical"></i> <?= isset($rekam) ? 'Edit' : 'Tambah' ?> Rekam Medis</h2>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pasien <span class="text-danger">*</span></label>
                        <select class="form-select" name="pasien_id" required>
                            <option value="">Pilih Pasien</option>
                            <?php foreach ($pasien as $p): ?>
                                <option value="<?= $p['id_pasien'] ?>" 
                                    <?= isset($rekam) && $rekam['id_pasien'] == $p['id_pasien'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($p['nama_pasien']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dokter <span class="text-danger">*</span></label>
                        <select class="form-select" name="dokter_id" required>
                            <option value="">Pilih Dokter</option>
                            <?php foreach ($dokter as $d): ?>
                                <option value="<?= $d['id_dokter'] ?>" 
                                    <?= isset($rekam) && $rekam['id_dokter'] == $d['id_dokter'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($d['nama_dokter']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Obat</label>
                        <select class="form-select" name="obat_id">
                            <option value="">Pilih Obat</option>
                            <?php foreach ($obat as $o): ?>
                                <option value="<?= $o['id_obat'] ?>" 
                                    <?= isset($rekam) && $rekam['id_obat'] == $o['id_obat'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($o['nama_obat']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diagnosis <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="diagnosis" rows="4" required><?= isset($rekam) ? htmlspecialchars($rekam['diagnosis']) : '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Periksa <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal" 
                               value="<?= isset($rekam) ? $rekam['tanggal'] : date('Y-m-d') ?>" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="<?= BASE_URL ?>index.php?page=rekam" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>