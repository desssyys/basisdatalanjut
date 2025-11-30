<?php

require_once '../app/core/Database.php';

class LaporanModel {

    private $db;

    public function __construct()
    {
        // ini menghasilkan PDO instance
        $this->db = db::getInstance()->getConnection();
    }

    /* ---------- LAPORAN PASIEN (VIEW) ---------- */
    public function getLaporanPasien()
    {
        $stmt = $this->db->prepare("SELECT * FROM view_laporan_pasien");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ---------- LAPORAN JANJI (VIEW) ---------- */
    public function getLaporanJanji()
    {
        $sql = "
            SELECT 
                DATE(tanggal) AS tanggal,
                COUNT(*) AS total_janji,
                COUNT(DISTINCT id_pasien) AS total_pasien,
                COUNT(DISTINCT id_dokter) AS total_dokter
            FROM janji_temu
            WHERE tanggal >= (CURRENT_DATE - INTERVAL '30 days')
            GROUP BY DATE(tanggal)
            ORDER BY tanggal ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ---------- LAPORAN OBAT ---------- */
    public function getLaporanObat()
    {
        $sql = "
            SELECT 
                o.nama_obat,
                o.harga,
                o.stok,
                COUNT(po.id_obat) AS total_penggunaan,
                (COUNT(po.id_obat) * o.harga) AS total_nilai
            FROM obat o
            LEFT JOIN pemakaian_obat po ON po.id_obat = o.id_obat
            GROUP BY o.id_obat, o.nama_obat, o.harga, o.stok
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ---------- LAPORAN DOKTER ---------- */
    public function getLaporanDokter()
    {
        $sql = "
            SELECT 
                d.nama_dokter,
                d.spesialisasi,
                COUNT(k.id_kunjungan) AS total_kunjungan,
                MAX(k.tanggal_kunjungan) AS kunjungan_terakhir
            FROM dokter d
            LEFT JOIN kunjungan k ON k.id_dokter = d.id_dokter
            GROUP BY d.id_dokter, d.nama_dokter, d.spesialisasi
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ---------- LAPORAN PENYAKIT ---------- */
    public function getLaporanPenyakit()
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM mv_laporan_penyakit
            ORDER BY total_kasus DESC
            LIMIT 10
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ---------- STATISTIK PASIEN ---------- */
    public function getStatistikPasien()
    {
        // Jenis kelamin
        $stmt = $this->db->prepare("
            SELECT 
                jenis_kelamin,
                COUNT(*) AS jumlah,
                (COUNT(*) * 100.0 / (SELECT COUNT(*) FROM pasien)) AS persentase
            FROM pasien
            GROUP BY jenis_kelamin
        ");
        $stmt->execute();
        $jk = $stmt->fetchAll();

        // Usia
        $sql = "
            SELECT 
                CASE
                    WHEN umur < 18 THEN 'Anak (<18)'
                    WHEN umur BETWEEN 18 AND 39 THEN 'Dewasa Muda (18-39)'
                    WHEN umur BETWEEN 40 AND 59 THEN 'Dewasa (40-59)'
                    ELSE 'Lansia (60+)'
                END AS kelompok,
                COUNT(*) AS jumlah,
                (COUNT(*) * 100.0 / (SELECT COUNT(*) FROM pasien)) AS persentase
            FROM (
                SELECT DATE_PART('year', AGE(CURRENT_DATE, tanggal_lahir)) AS umur
                FROM pasien
            ) u
            GROUP BY kelompok
        ";

        $stmt2 = $this->db->prepare($sql);
        $stmt2->execute();
        $usia = $stmt2->fetchAll();

        return [
            'jenis_kelamin' => $jk,
            'kelompok_usia' => $usia
        ];
    }
}
