<?php
require_once '../app/db.php';

class ReportModel {
    private $conn;

    public function __construct() {
        // Asumsi: Class db mengimplementasikan Singleton pattern dan getConnection() mengembalikan objek PDO.
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    // =========================================================================
    // FUNGSI ADMINISTRATIF: REFRESH SEMUA MATERIALIZED VIEW (BARU)
    // =========================================================================
    public function refreshAllMVs() {
        // Daftar semua MV yang digunakan dalam laporan
        $mvs = [
            'mv_laporan_pasien',
            'mv_laporan_janji_temu',
            'mv_laporan_obat',
            'mv_laporan_dokter',
            'mv_laporan_penyakit',
            'mv_statistik_pasien',
            // Ada juga getMatViewData() yang menggunakan 'laporan_klinik'. 
            // Kita asumsikan 'laporan_klinik' adalah MV atau View yang sudah ada.
            'laporan_klinik'
        ];
        
        $success = true;
        foreach ($mvs as $mv) {
            try {
                // Perintah REFRESH MATERIALIZED VIEW
                $sql = "REFRESH MATERIALIZED VIEW " . $mv;
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            } catch (PDOException $e) {
                // Jika terjadi error (misalnya MV tidak ditemukan), catat dan lanjutkan
                error_log("Gagal me-refresh MV {$mv}: " . $e->getMessage());
                $success = false;
            }
        }
        return $success;
    }

    // =========================================================================
    // FUNGSI LAPORAN DENGAN MENGGUNAKAN SELECT DARI MATERIALIZED VIEW
    // =========================================================================

    // FUNGSI INI DIASUMSIKAN MENGAMBIL DATA DARI MV/VIEW laporan_klinik
    public function getMatViewData() {
        // Mengubah kueri ke SELECT * FROM MV yang diasumsikan bernama laporan_klinik
        $query = "SELECT * FROM laporan_klinik ORDER BY jumlah_kunjungan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengganti kueri berat getLaporanPasien() dengan SELECT dari MV
    public function getLaporanPasien() {
        $query = "SELECT * FROM mv_laporan_pasien ORDER BY total_kunjungan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengganti kueri berat getLaporanJanji() dengan SELECT dari MV
    public function getLaporanJanji() {
        $query = "SELECT * FROM mv_laporan_janji_temu ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengganti kueri berat getLaporanObat() dengan SELECT dari MV
    public function getLaporanObat() {
        $query = "SELECT * FROM mv_laporan_obat ORDER BY total_penggunaan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengganti kueri berat getLaporanDokter() dengan SELECT dari MV
    public function getLaporanDokter() {
        $query = "SELECT * FROM mv_laporan_dokter ORDER BY total_kunjungan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengganti kueri berat getLaporanPenyakit() dengan SELECT dari MV
    public function getLaporanPenyakit() {
        $query = "SELECT * FROM mv_laporan_penyakit ORDER BY total_kasus DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengganti kueri berat getStatistikPasien() dengan SELECT dari MV
    // Asumsi MV ini menghasilkan baris-baris (Jenis Kelamin, Kelompok Usia)
    public function getStatistikPasien() {
        // MV harus sudah menggabungkan data Jenis Kelamin dan Usia (menggunakan UNION ALL)
        $query = "SELECT * FROM mv_statistik_pasien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // Mengembalikan data sebagai array tunggal agar mudah diproses di View
        // Ini berbeda dari implementasi lama yang mengembalikan array['jenis_kelamin'] dan array['kelompok_usia']
        return $stmt->fetchAll(); 
    }

    // FUNGSI DASHBOARD STATS TIDAK PERLU DIUBAH KARENA SUDAH RINGAN
    public function getDashboardStats() {
        $stats = [];
        
        // Total pasien
        $query = "SELECT COUNT(*) as total FROM pasien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_pasien'] = $stmt->fetch()['total'];
        
        // Total dokter
        $query = "SELECT COUNT(*) as total FROM dokter";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_dokter'] = $stmt->fetch()['total'];
        
        // Total obat
        $query = "SELECT COUNT(*) as total FROM obat";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_obat'] = $stmt->fetch()['total'];
        
        // Janji hari ini
        $query = "SELECT COUNT(*) as total FROM janji_temu WHERE tanggal = CURRENT_DATE";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['janji_hari_ini'] = $stmt->fetch()['total'];
        
        return $stats;
    }
}
?>