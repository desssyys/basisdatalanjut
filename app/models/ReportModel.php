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

    public function getLaporanDokter() {
    $query = "SELECT 
                d.id_dokter,
                d.nama_dokter,
                d.spesialisasi,
                COUNT(r.id_rekam_medis) AS total_kunjungan,
                MAX(r.tanggal) AS kunjungan_terakhir
              FROM dokter d
              LEFT JOIN rekam_medis r ON d.id_dokter = r.id_dokter
              GROUP BY d.id_dokter, d.nama_dokter, d.spesialisasi
              ORDER BY total_kunjungan DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
    }

    public function getLaporanPenyakit() {
        $query = "SELECT 
                    r.diagnosis AS nama_penyakit,
                    COUNT(*) AS total_kasus,
                    ROUND(
                        (COUNT(*) * 100.0) / (SELECT COUNT(*) FROM rekam_medis),
                        2
                    ) AS persentase
                FROM rekam_medis r
                WHERE r.diagnosis IS NOT NULL AND r.diagnosis <> ''
                GROUP BY r.diagnosis
                ORDER BY total_kasus DESC
                LIMIT 10";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStatistikPasien() {
    $data = [];

    // Statistik jenis kelamin
    $queryJK = "SELECT 
                    jenis_kelamin,
                    COUNT(*) AS jumlah,
                    (COUNT(*) * 100.0 / (SELECT COUNT(*) FROM pasien)) AS persentase
                FROM pasien
                GROUP BY jenis_kelamin";
    $stmt = $this->conn->prepare($queryJK);
    $stmt->execute();
    $data['jenis_kelamin'] = $stmt->fetchAll();

    // Statistik kelompok usia
    $queryUsia = "SELECT
                    CASE
                        WHEN umur < 18 THEN 'Anak (<18)'
                        WHEN umur BETWEEN 18 AND 39 THEN 'Dewasa (18-39)'
                        WHEN umur BETWEEN 40 AND 59 THEN 'Paruh Baya (40-59)'
                        ELSE 'Lansia (60+)'
                    END AS kelompok,
                    COUNT(*) AS jumlah,
                    (COUNT(*) * 100.0 / (SELECT COUNT(*) FROM pasien)) AS persentase
                  FROM pasien
                  GROUP BY kelompok";
    $stmt = $this->conn->prepare($queryUsia);
    $stmt->execute();
    $data['kelompok_usia'] = $stmt->fetchAll();

    return $data;
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