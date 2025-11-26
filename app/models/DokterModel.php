<?php
require_once '../app/db.php';

class DokterModel {
    private $conn;
    private $table = 'dokter';

    public function __construct() {
        // Menggunakan instance koneksi Singleton dari db.php
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    // Mengambil semua data dokter, termasuk nama spesialisasi
    public function getAll() {
        $query = "SELECT d.*, s.nama_spesialisasi 
                  FROM " . $this->table . " d 
                  LEFT JOIN spesialisasi s ON d.id_spesialisasi = s.id_spesialisasi 
                  ORDER BY d.id_dokter ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // ==========================================================
    // ⭐ FUNGSI BARU YANG DITAMBAHKAN (untuk keperluan Edit) ⭐
    // ==========================================================

    /**
     * Mengambil satu data dokter berdasarkan ID.
     * Dipanggil oleh DokterController->edit() untuk mengisi formulir.
     */
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_dokter = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Mengembalikan hanya satu baris data
        return $stmt->fetch();
    }

    // ==========================================================
    // Metode yang Ada
    // ==========================================================
    
    // Mencari dokter berdasarkan nama
    public function search($keyword) {
        $query = "SELECT d.*, s.nama_spesialisasi 
                  FROM " . $this->table . " d 
                  LEFT JOIN spesialisasi s ON d.id_spesialisasi = s.id_spesialisasi 
                  WHERE LOWER(d.nama_dokter) LIKE LOWER(:keyword)
                  ORDER BY d.id_dokter ASC"; // Modifikasi: Tambahkan JOIN untuk spesialisasi
        
        $stmt = $this->conn->prepare($query);
        $keyword = "%".$keyword."%"; // agar bisa match sebagian
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Menambahkan data dokter baru
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (nama_dokter, no_hp, id_spesialisasi, email) 
                  VALUES (:nama, :no_hp, :spesialisasi, :email)";
        
        $stmt = $this->conn->prepare($query);
        // ... (Bind Param seperti kode Anda)
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':no_hp', $data['no_hp']);
        $stmt->bindParam(':spesialisasi', $data['spesialisasi']);
        $stmt->bindParam(':email', $data['email']);
        
        return $stmt->execute();
    }

    // Mengubah data dokter yang sudah ada
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET nama_dokter = :nama, no_hp = :no_hp, 
                      id_spesialisasi = :spesialisasi, email = :email 
                  WHERE id_dokter = :id";
        
        $stmt = $this->conn->prepare($query);
        // ... (Bind Param seperti kode Anda)
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':no_hp', $data['no_hp']);
        $stmt->bindParam(':spesialisasi', $data['spesialisasi']);
        $stmt->bindParam(':email', $data['email']);
        
        return $stmt->execute();
    }

    // Menghapus data dokter
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_dokter = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Mengambil daftar spesialisasi (untuk dropdown di form)
    public function getSpesialisasi() {
        $query = "SELECT * FROM spesialisasi ORDER BY nama_spesialisasi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>