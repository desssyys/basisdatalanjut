<?php
require_once '../app/db.php';

class RekamModel {
    private $conn;
    private $table = 'rekam_medis';

    public function __construct() {
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT r.*, p.nama_pasien, d.nama_dokter, o.nama_obat
                  FROM " . $this->table . " r
                  LEFT JOIN pasien p ON r.id_pasien = p.id_pasien
                  LEFT JOIN dokter d ON r.id_dokter = d.id_dokter
                  LEFT JOIN obat o ON r.id_obat = o.id_obat
                  ORDER BY r.id_rekam_medis ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_rekam_medis = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (id_pasien, id_dokter, id_obat, diagnosis) 
                  VALUES (:pasien, :dokter, :obat, :diagnosis)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pasien', $data['pasien_id']);
        $stmt->bindParam(':dokter', $data['dokter_id']);
        $stmt->bindParam(':obat', $data['obat_id']);
        $stmt->bindParam(':diagnosis', $data['diagnosis']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET id_pasien = :pasien, 
                      id_dokter = :dokter, 
                      id_obat = :obat, 
                      diagnosis = :diagnosis
                  WHERE id_rekam_medis = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':pasien', $data['pasien_id']);
        $stmt->bindParam(':dokter', $data['dokter_id']);
        $stmt->bindParam(':obat', $data['obat_id']);
        $stmt->bindParam(':diagnosis', $data['diagnosis']);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_rekam_medis = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getByPasien($pasien_id) {
        $query = "SELECT r.*, d.nama_dokter, o.nama_obat
                  FROM " . $this->table . " r
                  LEFT JOIN dokter d ON r.id_dokter = d.id_dokter
                  LEFT JOIN obat o ON r.id_obat = o.id_obat
                  WHERE r.id_pasien = :pasien_id
                  ORDER BY r.id_rekam_medis DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pasien_id', $pasien_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
