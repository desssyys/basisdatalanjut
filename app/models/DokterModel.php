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
        $keyword = "%".strtolower($keyword)."%";

        $query = "SELECT d.*, s.nama_spesialisasi 
                  FROM {$this->table} d
                  LEFT JOIN spesialisasi s ON d.id_spesialisasi = s.id_spesialisasi
                  WHERE LOWER(d.nama_dokter) LIKE :kw
                     OR LOWER(s.nama_spesialisasi) LIKE :kw
                     OR LOWER(d.email) LIKE :kw
                     OR LOWER(d.no_hp) LIKE :kw
                  ORDER BY d.id_dokter ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kw', $keyword);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    // ======================================================

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_dokter = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
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
