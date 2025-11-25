<?php
require_once '../app/db.php';

class ReportModel {
    private $conn;

    public function __construct() {
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getMatViewData() {
        // Mengambil data dari view laporan_klinik
        $query = "SELECT * FROM laporan_klinik ORDER BY jumlah_kunjungan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLaporanPasien() {
        $query = "SELECT 
                    p.id_pasien,
                    p.nama_pasien,
                    p.jenis_kelamin,
                    p.umur,
                    p.no_hp,
                    COUNT(r.id_rekam_medis) as total_kunjungan,
                    MAX(r.tanggal) as kunjungan_terakhir
                  FROM pasien p
                  LEFT JOIN rekam_medis r ON p.id_pasien = r.id_pasien
                  GROUP BY p.id_pasien, p.nama_pasien, p.jenis_kelamin, p.umur, p.no_hp
                  ORDER BY total_kunjungan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLaporanJanji() {
        $query = "SELECT 
                    DATE(j.tanggal) as tanggal,
                    COUNT(*) as total_janji,
                    COUNT(DISTINCT j.id_pasien) as total_pasien,
                    COUNT(DISTINCT j.id_dokter) as total_dokter
                  FROM janji_temu j
                  GROUP BY DATE(j.tanggal)
                  ORDER BY tanggal DESC
                  LIMIT 30";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLaporanObat() {
        $query = "SELECT 
                    o.id_obat,
                    o.nama_obat,
                    o.harga,
                    o.stok,
                    COUNT(r.id_rekam_medis) as total_penggunaan,
                    o.harga * COUNT(r.id_rekam_medis) as total_nilai
                  FROM obat o
                  LEFT JOIN rekam_medis r ON o.id_obat = r.id_obat
                  GROUP BY o.id_obat, o.nama_obat, o.harga, o.stok
                  ORDER BY total_penggunaan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

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