<?php
require_once '../app/db.php';

class DokterModel {
    private $conn;
    private $table = 'dokter';

    public function __construct() {
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT d.*, s.nama_spesialisasi 
                  FROM " . $this->table . " d 
                  LEFT JOIN spesialisasi s ON d.id_spesialisasi = s.id_spesialisasi 
                  ORDER BY d.id_dokter ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ======================= SEARCH =======================
    public function search($keyword) {
        $query = "SELECT * FROM " . $this->table . " 
                WHERE LOWER(nama_dokter) LIKE LOWER(:keyword)
                ORDER BY id_dokter ASC";

        $stmt = $this->conn->prepare($query);
        $keyword = "%".$keyword."%"; // agar bisa match sebagian
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (nama_dokter, no_hp, id_spesialisasi, email) 
                  VALUES (:nama, :no_hp, :spesialisasi, :email)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':no_hp', $data['no_hp']);
        $stmt->bindParam(':spesialisasi', $data['spesialisasi']);
        $stmt->bindParam(':email', $data['email']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET nama_dokter = :nama, no_hp = :no_hp, 
                      id_spesialisasi = :spesialisasi, email = :email 
                  WHERE id_dokter = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':no_hp', $data['no_hp']);
        $stmt->bindParam(':spesialisasi', $data['spesialisasi']);
        $stmt->bindParam(':email', $data['email']);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_dokter = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getSpesialisasi() {
        $query = "SELECT * FROM spesialisasi ORDER BY nama_spesialisasi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
